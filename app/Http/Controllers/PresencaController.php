<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Presenca;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PresencaController extends Controller
{
    public function index(Request $request)
    {
        $presencas = Presenca::with('aluno.user')
            ->when($request->aluno_id, function ($query) use ($request) {
                $query->where('aluno_id', $request->aluno_id);
            })
            ->when($request->data_presenca, function ($query) use ($request) {
                $query->whereDate('data_presenca', $request->data_presenca);
            })
            ->latest('data_presenca')
            ->latest('horario')
            ->paginate(10)
            ->withQueryString();

        $alunos = Aluno::with('user')->orderBy('nome')->get();

        return view('presencas.index', compact('presencas', 'alunos'));
    }

    public function create()
    {
        $alunos = Aluno::with('user')->orderBy('nome')->get();

        return view('presencas.create', compact('alunos'));
    }

    public function store(Request $request)
    {
        $dados = $request->validate([
            'aluno_id' => [
                'required',
                'exists:alunos,id',
                Rule::unique('presencas')->where(function ($query) use ($request) {
                    return $query->where('data_presenca', $request->data_presenca);
                }),
            ],
            'data_presenca' => 'required|date',
            'horario' => 'required|date_format:H:i',
            'observacao' => 'nullable|string|max:255',
        ], [
            'aluno_id.unique' => 'Este aluno já possui presença registrada nesta data.',
        ]);

        Presenca::create($dados);

        return redirect()
            ->route('presencas.index')
            ->with('success', 'Presença registrada com sucesso!');
    }

    public function edit($id)
    {
        $presenca = Presenca::findOrFail($id);
        $alunos = Aluno::with('user')->orderBy('nome')->get();

        return view('presencas.edit', compact('presenca', 'alunos'));
    }

    public function update(Request $request, $id)
    {
        $presenca = Presenca::findOrFail($id);

        $dados = $request->validate([
            'aluno_id' => [
                'required',
                'exists:alunos,id',
                Rule::unique('presencas')->ignore($presenca->id)->where(function ($query) use ($request) {
                    return $query->where('data_presenca', $request->data_presenca);
                }),
            ],
            'data_presenca' => 'required|date',
            'horario' => 'required|date_format:H:i',
            'observacao' => 'nullable|string|max:255',
        ], [
            'aluno_id.unique' => 'Este aluno já possui presença registrada nesta data.',
        ]);

        $presenca->update($dados);

        return redirect()
            ->route('presencas.index')
            ->with('success', 'Presença atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $presenca = Presenca::findOrFail($id);
        $presenca->delete();

        return redirect()
            ->back()
            ->with('success', 'Presença removida com sucesso!');
    }
}
