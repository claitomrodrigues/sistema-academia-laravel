<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credenciais = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credenciais)) {
            $request->session()->regenerate();

            $dashboard = Auth::user()->dashboardRoute();
            abort_if($dashboard === null, 403, 'Perfil de acesso não configurado.');

            return redirect()->route($dashboard);
        }

        return back()->with('error', 'Email ou senha inválidos.');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $request->merge([
            'tenant_slug' => strtolower((string) $request->input('tenant_slug')),
            'document' => preg_replace('/\D/', '', (string) $request->input('document')) ?: null,
        ]);

        $dados = $request->validate([
            'tenant_name' => 'required|string|max:255',
            'tenant_slug' => ['required', 'string', 'max:255', 'alpha_dash:ascii', 'unique:tenants,slug'],
            'document' => ['nullable', 'digits:14', 'unique:tenants,document'],
            'admin_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $user = DB::transaction(function () use ($dados): User {
            $tenant = Tenant::create([
                'name' => $dados['tenant_name'],
                'slug' => $dados['tenant_slug'],
                'document' => $dados['document'] ?? null,
            ]);

            $user = new User([
                'name' => $dados['admin_name'],
                'email' => $dados['email'],
                'password' => $dados['password'],
                'role' => User::ROLE_ADMIN_TENANT,
            ]);
            $user->tenant_id = $tenant->id;
            $user->save();

            return $user;
        });

        Auth::login($user);
        $request->session()->regenerate();

        $dashboard = $user->dashboardRoute();
        abort_if($dashboard === null, 403, 'Perfil de acesso não configurado.');

        return redirect()->route($dashboard);
    }
}
