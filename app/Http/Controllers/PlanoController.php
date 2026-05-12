<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Plano;

class PlanoController extends Controller
{
    public function index()
    {
        $planos = Plano::all();

        return view('planos.index', compact('planos'));
    }

    public function create()
    {
        return view('planos.create');
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:mensal,trimestral,anual',
            'valor' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
        ]);

        $dados['descricao'] = $dados['descricao'] ?? 'Sem descrição';

        $dados['periodo'] = $dados['tipo'];

        Plano::create($dados);

        return redirect()
            ->route('planos.index')
            ->with('success', 'Plano cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $plano = Plano::findOrFail($id);

        return view('planos.edit', compact('plano'));
    }

    public function update(Request $request, $id)
    {
        $dados = $request->validate([
            'nome' => 'required|string|max:255',
            'tipo' => 'required|in:mensal,trimestral,anual',
            'valor' => 'required|numeric|min:0',
            'descricao' => 'nullable|string',
        ]);

        $dados['descricao'] = $dados['descricao'] ?? 'Sem descrição';

        $dados['periodo'] = $dados['tipo'];

        $plano = Plano::findOrFail($id);
        $plano->update($dados);

        return redirect()
            ->route('planos.index')
            ->with('success', 'Plano atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $plano = Plano::findOrFail($id);

        $plano->delete();

        return redirect()
            ->route('planos.index')
            ->with('success', 'Plano excluído com sucesso!');
    }
}