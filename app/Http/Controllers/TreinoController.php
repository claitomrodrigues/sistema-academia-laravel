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
            'itens' => 'required|array',
            'itens.*.exercicio_id' => 'nullable|exists:exercicios,id',
            'itens.*.series' => 'nullable|integer',
            'itens.*.reps' => 'nullable|integer',
            'itens.*.carga' => 'nullable|string|max:50',
        ]);

        $treino = Treino::create([
            'aluno_id' => $request->aluno_id,
            'tipo' => $request->tipo,
            'status' => 'ativo'
        ]);

        foreach ($request->itens as $item) {
            if (!empty($item['exercicio_id'])) {
                ItemTreino::create([
                    'treino_id' => $treino->id,
                    'exercicio_id' => $item['exercicio_id'],
                    'series' => $item['series'] ?? 0,
                    'reps' => $item['reps'] ?? 0,
                    'carga' => $item['carga'] ?? 'Sem carga',
                ]);
            }
        }

        return redirect()->route('treinos.index')->with('success', 'Treino criado!');
    }

   public function show($id)
{
    $treino = Treino::with(['aluno.user', 'itens.exercicio'])->findOrFail($id);

    $user = Auth::user();

    if ($user->role === 'aluno') {
        if (!$user->aluno || $user->aluno->id != $treino->aluno_id) {
            abort(403, 'Acesso não autorizado.');
        }
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