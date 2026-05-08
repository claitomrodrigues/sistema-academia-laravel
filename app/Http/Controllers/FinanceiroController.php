<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Transacao;
use App\Models\Matricula;
use App\Services\AsaasService;

class FinanceiroController extends Controller
{
    public function index()
    {
        $pagamentos = Pagamento::with('matricula.aluno.user', 'transacao')->get();

        return view('financeiro.index', compact('pagamentos'));
    }

    public function faturas()
    {
        $pagamentos = Pagamento::with('matricula.aluno.user', 'transacao')->get();

        return view('financeiro.faturas', compact('pagamentos'));
    }

    public function filtro(Request $request)
    {
        $pagamentos = Pagamento::with('matricula.aluno.user', 'transacao')
            ->when($request->status, function ($query) use ($request) {
                $query->where('status', $request->status);
            })
            ->get();

        return view('financeiro.index', compact('pagamentos'));
    }

    public function createCobranca()
    {
        $matriculas = Matricula::with('aluno.user', 'plano')->get();

        return view('cobrancas.create', compact('matriculas'));
    }

    public function storeCobranca(Request $request)
    {
        $request->validate([
            'matricula_id' => 'required|exists:matriculas,id',
            'valor' => 'required|numeric|min:1',
            'vencimento' => 'required|date',
        ]);

        Pagamento::create([
            'matricula_id' => $request->matricula_id,
            'valor' => $request->valor,
            'vencimento' => $request->vencimento,
            'status' => 'pendente',
        ]);

        return redirect()
            ->route('financeiro.index')
            ->with('success', 'Cobrança criada com sucesso!');
    }

    public function pagar($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->update(['status' => 'pago']);

        return redirect()->back()->with('success', 'Pagamento confirmado!');
    }

    public function gerarTransacao(Request $request, AsaasService $asaas)
    {
        $request->validate([
            'pagamento_id' => 'required|exists:pagamentos,id',
            'metodo' => 'required|in:pix,boleto',
        ]);

        $pagamento = Pagamento::with('matricula.aluno.user')->findOrFail($request->pagamento_id);
        $aluno = $pagamento->matricula->aluno;

        try {
            if (empty($aluno->asaas_customer_id)) {
                $cliente = $asaas->criarCliente($aluno);

                $aluno->update([
                    'asaas_customer_id' => $cliente['id'],
                ]);
            }

            $cobranca = $asaas->criarCobranca(
                $aluno->asaas_customer_id,
                $pagamento,
                $request->metodo
            );

            $qrCodePix = null;

            if ($request->metodo === 'pix') {
                $pix = $asaas->buscarQrCodePix($cobranca['id']);
                $qrCodePix = $pix['payload'] ?? null;
            }

            Transacao::updateOrCreate(
                ['pagamento_id' => $pagamento->id],
                [
                    'metodo' => $request->metodo,
                    'asaas_payment_id' => $cobranca['id'] ?? null,
                    'codigo_barras' => $request->metodo === 'boleto'
                        ? ($cobranca['bankSlipUrl'] ?? $cobranca['invoiceUrl'] ?? null)
                        : null,
                    'qr_code_pix' => $qrCodePix,
                    'status' => $cobranca['status'] ?? 'PENDING',
                ]
            );

            return redirect()
                ->back()
                ->with('success', 'Cobrança gerada com sucesso no Asaas!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', $e->getMessage());
        }
    }
}