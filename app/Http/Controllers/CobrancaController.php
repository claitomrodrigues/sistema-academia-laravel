<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Matricula;
use App\Models\Pagamento;

class CobrancaController extends Controller
{
    public function create()
    {
        $matriculas = Matricula::with('aluno.user', 'plano')->get();

        return view('cobrancas.create', compact('matriculas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'matricula_id' => 'required|exists:matriculas,id',
            'valor' => 'required|numeric|min:1',
            'vencimento' => 'required|date',
        ]);

        $pagamento = Pagamento::create([
            'matricula_id' => $request->matricula_id,
            'valor' => $request->valor,
            'vencimento' => $request->vencimento,
            'status' => 'pendente',
        ]);

        return redirect()
            ->route('financeiro.index')
            ->with('success', 'Cobrança criada com sucesso!');
    }
}