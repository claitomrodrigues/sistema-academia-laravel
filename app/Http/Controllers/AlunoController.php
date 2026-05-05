<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Plano;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{
    public function index()
    {
        $alunos = Aluno::with(['user', 'matricula.plano'])->get();

        return view('alunos.index', compact('alunos'));
    }

    public function create()
    {
        $planos = Plano::all();

        return view('alunos.create', compact('planos'));
    }

    public function store(Request $request) 
    {
        $request->validate([
            'nome'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'cpf'        => 'required|string|unique:alunos,cpf',
            'nascimento' => 'required|date',
            'objetivo'   => 'nullable|string|max:255',
            'plano_id'   => 'required|exists:planos,id',
        ]);

        DB::transaction(function () use ($request) {
            $cpf = preg_replace('/[^0-9]/', '', $request->cpf);

            $user = User::create([
                'name'     => $request->nome,
                'email'    => $request->email,
                'password' => Hash::make($cpf),
                'role'     => 'aluno'
            ]);

            $aluno = Aluno::create([
                'user_id'    => $user->id,
                'nome'       => $request->nome,
                'cpf'        => $cpf,
                'nascimento' => $request->nascimento,
                'objetivo'   => $request->objetivo,
            ]);

            Matricula::create([
                'aluno_id'    => $aluno->id,
                'plano_id'    => $request->plano_id,
                'data_inicio' => now(),
                'status'      => 'ativa'
            ]);
        });

        return redirect()->route('alunos.index')->with('success', 'Aluno matriculado com sucesso!');
    }

    public function edit($id)
    {
        $aluno = Aluno::with('user')->findOrFail($id);

        return view('alunos.edit', compact('aluno'));
    }

    public function update(Request $request, $id)
    {
        $aluno = Aluno::findOrFail($id);

        $request->validate([
            'nome'       => 'required|string|max:255',
            'cpf'        => 'required|string|unique:alunos,cpf,' . $aluno->id,
            'nascimento' => 'required|date',
            'objetivo'   => 'nullable|string|max:255',
        ]);

        DB::transaction(function () use ($request, $aluno) {
            $cpf = preg_replace('/[^0-9]/', '', $request->cpf);

            $aluno->update([
                'nome'       => $request->nome,
                'cpf'        => $cpf,
                'nascimento' => $request->nascimento,
                'objetivo'   => $request->objetivo,
            ]);

            if ($aluno->user) {
                $aluno->user->update([
                    'name' => $request->nome,
                ]);
            }
        });

        return redirect()->route('alunos.index')->with('success', 'Aluno atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $aluno = Aluno::with('user')->findOrFail($id);

        DB::transaction(function () use ($aluno) {
            if ($aluno->user) {
                $aluno->user->delete();
            }

            $aluno->delete();
        });

        return redirect()->route('alunos.index')->with('success', 'Aluno excluído com sucesso!');
    }
}