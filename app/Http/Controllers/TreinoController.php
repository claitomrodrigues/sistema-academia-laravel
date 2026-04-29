<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treino;
use App\Models\ItemTreino;
use App\Models\Exercicio;

class TreinoController extends Controller
{
    public function index()
    {
        $treinos = Treino::with('aluno')->get();
        return view('treinos.index', compact('treinos'));
    }

    public function create()
    {
    $alunos = \App\Models\Aluno::with('user')->get();
    $exercicios = \App\Models\Exercicio::all();

    return view('treinos.create', compact('alunos', 'exercicios'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'tipo' => 'required|string',
        ]);

        $treino = Treino::create([
            'aluno_id' => $request->aluno_id,
            'tipo' => $request->tipo,
            'status' => 'ativo'
        ]);

        if ($request->itens) {
            foreach ($request->itens as $item) {
                ItemTreino::create([
                    'treino_id' => $treino->id,
                    'exercicio_id' => $item['exercicio_id'],
                    'series' => $item['series'],
                    'reps' => $item['reps'],
                    'carga' => $item['carga'],
                ]);
            }
        }

        return redirect()->route('treinos.index')->with('success', 'Treino criado!');
    }

    public function show($id)
    {
        $treino = Treino::with('itens.exercicio')->findOrFail($id);
        return view('treinos.show', compact('treino'));
    }

    public function destroy($id)
    {
        Treino::destroy($id);
        return redirect()->back()->with('success', 'Treino removido!');
    }
}