<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $user = request()->user();
        $dashboard = $user->dashboardRoute();
        abort_if($dashboard === null, 403, 'Perfil de acesso não configurado.');

        return redirect()->route($dashboard);
    }

    public function admin()
    {
        $tenantId = request()->user()->tenant_id;

        $activeMembers = Aluno::query()
            ->whereHas('matricula', fn ($query) => $query->where('status', 'ativa'))
            ->count();

        $tenantPayments = DB::table('pagamentos')
            ->join('matriculas', 'matriculas.id', '=', 'pagamentos.matricula_id')
            ->join('alunos', 'alunos.id', '=', 'matriculas.aluno_id')
            ->when(
                $tenantId === null,
                fn ($query) => $query->whereNull('alunos.tenant_id'),
                fn ($query) => $query->where('alunos.tenant_id', $tenantId),
            );

        $revenue = (clone $tenantPayments)
            ->where('pagamentos.status', 'pago')
            ->whereMonth('pagamentos.updated_at', now()->month)
            ->whereYear('pagamentos.updated_at', now()->year)
            ->sum('pagamentos.valor');

        $delinquentMembers = (clone $tenantPayments)
            ->where('pagamentos.status', 'pendente')
            ->whereDate('pagamentos.vencimento', '<', today())
            ->distinct()
            ->count('alunos.id');

        return view('home', compact('activeMembers', 'revenue', 'delinquentMembers'));
    }

    public function member()
    {
        return view('home');
    }

    public function superAdmin()
    {
        abort_unless(request()->user()->hasRole(User::ROLE_SUPER_ADMIN), 403);

        return view('superadmin.dashboard', [
            'tenants' => Tenant::query()->orderBy('name')->get(),
            'totalUsers' => User::query()->count(),
        ]);
    }
}
