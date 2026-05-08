<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Treino;
use App\Models\ItemTreino;
use App\Models\Aluno;
use App\Models\Exercicio;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class TreinoController extends Controller
{
    public function index()
    {
        $treinos = Treino::with(['aluno.user'])->get();

        return view('treinos.index', compact('treinos'));
    }

    public function create()
    {
        $alunos = Aluno::with('user')->get();
        $exercicios = Exercicio::all();

        return view('treinos.create', compact('alunos', 'exercicios'));
    }

   public function store(Request $request)
{
    $request->validate([
        'aluno_id' => 'required|exists:alunos,id',
        'tipo' => 'required|string|max:255',
        'dias_semana' => 'required|integer|min:2|max:7',
        'itens' => 'required|array',
    ]);

    $itensSelecionados = collect($request->itens)
        ->filter(function ($item) {
            return isset($item['exercicio_id']);
        })
        ->values();

    if ($itensSelecionados->isEmpty()) {
        return back()
            ->withErrors(['itens' => 'Selecione pelo menos um exercício para o treino.'])
            ->withInput();
    }

   $diasSemana = (int) $request->dias_semana;

$valorMensal = 100 + (($diasSemana - 2) * 10);

$treino = Treino::create([
    'aluno_id' => $request->aluno_id,
    'tipo' => $request->tipo,
    'dias_semana' => $diasSemana,
    'valor_mensal' => $valorMensal,
    'status' => 'ativo',
]);

    foreach ($itensSelecionados as $item) {
        ItemTreino::create([
            'treino_id' => $treino->id,
            'exercicio_id' => $item['exercicio_id'],
            'series' => $item['series'] ?? null,
            'repeticoes' => $item['reps'] ?? null,
            'carga' => $item['carga'] ?? null,
        ]);
    }

    return redirect()
        ->route('treinos.index')
        ->with('success', 'Treino criado com sucesso!');
}

   public function show($id)
{
    $treino = Treino::with(['aluno.user', 'itens.exercicio'])
        ->where('aluno_id', $id)
        ->where('status', 'ativo')
        ->latest()
        ->first();

    if (!$treino) {
        return view('treinos.sem-treino');
    }

    return view('treinos.show', compact('treino'));
}

public function pdf($id)
{
    $treino = Treino::with(['aluno.user', 'itens.exercicio'])->findOrFail($id);

    $user = Auth::user();

    if ($user->role === 'aluno') {
        if (!$user->aluno || $user->aluno->id != $treino->aluno_id) {
            abort(403, 'Acesso não autorizado.');
        }
    }

    $nomeAluno = $treino->aluno->user->name ?? $treino->aluno->nome ?? 'aluno';

    $pdf = Pdf::loadView('treinos.pdf', compact('treino'));

    return $pdf->download('treino-' . str_replace(' ', '-', strtolower($nomeAluno)) . '.pdf');
}
    public function destroy($id)
    {
        $treino = Treino::findOrFail($id);
        $treino->delete();

        return redirect()->back()->with('success', 'Treino removido!');
    }
}