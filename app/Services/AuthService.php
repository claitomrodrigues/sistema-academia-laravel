<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(array $credenciais): bool
    {
        return Auth::attempt($credenciais);
    }

    public function logout(): void
    {
        Auth::logout();
    }

    public function criarUsuario(array $dados): User
    {
        return User::create([
            'name' => $dados['name'],
            'email' => $dados['email'],
            'password' => Hash::make($dados['password']),
            'role' => $dados['role'],
        ]);
    }
}