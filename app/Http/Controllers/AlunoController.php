<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Aluno;
use App\Models\Matricula;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AlunoController extends Controller
{
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
            $user = User::create([
                'name'     => $request->nome,
                'email'    => $request->email,
                'password' => Hash::make($request->cpf),
                'role'     => 'aluno'
            ]);

            $aluno = Aluno::create([
                'user_id'    => $user->id,
                'cpf'        => $request->cpf,
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

        return redirect()->back()->with('success', 'Aluno matriculado com sucesso!');
    }
}