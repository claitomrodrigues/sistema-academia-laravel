<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercicio;

class ExercicioController extends Controller
{
    public function index()
    {
        $exercicios = Exercicio::all();
        return view('exercicios.index', compact('exercicios'));
    }

    public function create()
    {
        return view('exercicios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'grupo_muscular' => 'required|string|max:255',
            'video' => 'nullable|string|max:255',
        ]);

        Exercicio::create($request->all());

        return redirect()->route('exercicios.index')->with('success', 'Exercício cadastrado com sucesso!');
    }

    public function edit($id)
    {
        $exercicio = Exercicio::findOrFail($id);
        return view('exercicios.edit', compact('exercicio'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'grupo_muscular' => 'required|string|max:255',
            'video' => 'nullable|string|max:255',
        ]);

        $exercicio = Exercicio::findOrFail($id);
        $exercicio->update($request->all());

        return redirect()->route('exercicios.index')->with('success', 'Exercício atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $exercicio = Exercicio::findOrFail($id);
        $exercicio->delete();

        return redirect()->route('exercicios.index')->with('success', 'Exercício excluído com sucesso!');
    }
}