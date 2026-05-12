<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treino;
use App\Models\ItemTreino;
use App\Models\Aluno;
use App\Models\Exercicio;
use App\Models\Plano;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TreinoController extends Controller
{
    public function index()
    {
        $treinos = Treino::with([
            'aluno.user',
            'plano'
        ])->get();

        return view('treinos.index', compact('treinos'));
    }

    public function create()
    {
        $alunos = Aluno::with('user')->get();
        $exercicios = Exercicio::all();
        $planos = Plano::all();

        return view('treinos.create', compact(
            'alunos',
            'exercicios',
            'planos'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'aluno_id' => 'required|exists:alunos,id',
            'plano_id' => 'required|exists:planos,id',
            'tipo' => 'required|string|max:255',
            'dias_semana' => 'nullable|integer|min:2|max:7',
            'personal' => 'nullable|boolean',
            'itens' => 'required|array',
        ]);

        $plano = Plano::findOrFail($request->plano_id);

        $itensSelecionados = collect($request->itens)
            ->filter(function ($item) {
                return isset($item['exercicio_id']);
            })
            ->values();

        if ($itensSelecionados->isEmpty()) {

            return back()
                ->withErrors([
                    'itens' => 'Selecione pelo menos um exercício para o treino.'
                ])
                ->withInput();
        }

        $treino = Treino::create([

            'aluno_id' => $request->aluno_id,

            'plano_id' => $plano->id,

            'tipo' => $request->tipo,

            'dias_semana' => $plano->tipo === 'mensal'
                ? $request->dias_semana
                : 0,

            'personal' => $request->personal ?? 0,

            'status' => 'ativo',
        ]);

        foreach ($itensSelecionados as $item) {

            ItemTreino::create([

                'treino_id' => $treino->id,

                'exercicio_id' => $item['exercicio_id'],

                'series' => $item['series'] ?? 0,

                'reps' => $item['reps'] ?? 0,

                'carga' => $item['carga'] ?? 0,
            ]);
        }

        return redirect()
            ->route('treinos.index')
            ->with('success', 'Treino criado com sucesso!');
    }

    public function show($id)
{
    $treino = Treino::with([
        'aluno.user',
        'itens.exercicio',
        'plano'
    ])->find($id);

    if (!$treino) {
        return view('treinos.sem-treino');
    }

    return view('treinos.show', compact('treino'));
}

    public function pdf($id)
    {
        $treino = Treino::with([
            'aluno.user',
            'itens.exercicio',
            'plano'
        ])->findOrFail($id);

        $user = Auth::user();

        if ($user->role === 'aluno') {

            if (!$user->aluno || $user->aluno->id != $treino->aluno_id) {
                abort(403, 'Acesso não autorizado.');
            }
        }

        $nomeAluno = $treino->aluno->user->name
            ?? $treino->aluno->nome
            ?? 'aluno';

        $pdf = Pdf::loadView('treinos.pdf', compact('treino'));

        return $pdf->download(
            'treino-' . str_replace(' ', '-', strtolower($nomeAluno)) . '.pdf'
        );
    }

    public function destroy($id)
    {
        $treino = Treino::findOrFail($id);

        $treino->delete();

        return redirect()
            ->back()
            ->with('success', 'Treino removido!');
    }
}