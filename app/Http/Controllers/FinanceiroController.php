<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pagamento;
use App\Models\Transacao;

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
            ->where('status', $request->status)
            ->get();

        return view('financeiro.index', compact('pagamentos'));
    }

    public function pagar($id)
    {
        $pagamento = Pagamento::findOrFail($id);
        $pagamento->status = 'pago';
        $pagamento->save();

        return redirect()->back()->with('success', 'Pagamento confirmado!');
    }

    public function gerarTransacao(Request $request)
    {
        $request->validate([
            'pagamento_id' => 'required|exists:pagamentos,id',
            'metodo' => 'required|in:pix,boleto',
        ]);

        Transacao::updateOrCreate(
            ['pagamento_id' => $request->pagamento_id],
            [
                'metodo' => $request->metodo,
                'codigo_barras' => $request->metodo == 'boleto' ? '123456789' : null,
                'qr_code_pix' => $request->metodo == 'pix' ? 'qrcode_fake' : null,
            ]
        );

        return redirect()->back()->with('success', 'Transação gerada!');
    }
}