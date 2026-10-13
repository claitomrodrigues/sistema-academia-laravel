@extends('layouts.app')

@section('title', 'Alunos')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6">
        <header class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Alunos</h1>
                <p class="mt-2 text-sm text-slate-500">Gerencie alunos, matrículas e situação financeira.</p>
            </div>
            @if(auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN_TENANT, \App\Models\User::ROLE_STAFF))
                <x-button href="{{ route('alunos.create') }}">
                    <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 5v14m-7-7h14" /></svg>
                    Novo aluno
                </x-button>
            @endif
        </header>

        @if(session('success'))
            <div role="status" class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
        @endif

        <x-card>
            <x-table>
                <x-slot:head>
                    <th scope="col" class="px-5 py-3">Aluno</th>
                    <th scope="col" class="px-5 py-3">CPF</th>
                    <th scope="col" class="px-5 py-3">Nascimento</th>
                    <th scope="col" class="px-5 py-3">Situação</th>
                    <th scope="col" class="px-5 py-3">Objetivo</th>
                    <th scope="col" class="px-5 py-3 text-right">Ações</th>
                </x-slot:head>

                @forelse($alunos as $aluno)
                    @php
                        $isDelinquent = $aluno->matricula?->pagamentos->contains(
                            fn ($pagamento) => $pagamento->status === 'pendente'
                                && \Illuminate\Support\Carbon::parse($pagamento->vencimento)->isBefore(today())
                        ) ?? false;
                        $isActive = $aluno->matricula?->status === 'ativa';
                    @endphp
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-full bg-emerald-100 font-bold text-emerald-800">
                                    {{ strtoupper(substr($aluno->user->name ?? $aluno->nome ?? 'A', 0, 1)) }}
                                </span>
                                <div>
                                    <p class="font-semibold text-slate-900">{{ $aluno->user->name ?? $aluno->nome }}</p>
                                    <p class="text-xs text-slate-500">{{ $aluno->user->email ?? 'E-mail não informado' }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ $aluno->cpf }}</td>
                        <td class="whitespace-nowrap px-5 py-4 text-slate-600">{{ \Illuminate\Support\Carbon::parse($aluno->nascimento)->format('d/m/Y') }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            @if($isDelinquent)
                                <span class="inline-flex rounded-full bg-red-50 px-2.5 py-1 text-xs font-semibold text-red-700">Inadimplente</span>
                            @elseif($isActive)
                                <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold text-emerald-700">Ativo</span>
                            @else
                                <span class="inline-flex rounded-full bg-slate-100 px-2.5 py-1 text-xs font-semibold text-slate-600">Sem matrícula ativa</span>
                            @endif
                        </td>
                        <td class="max-w-xs px-5 py-4 text-slate-600">{{ $aluno->objetivo ?: 'Não informado' }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('alunos.edit', $aluno->id) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100">Editar</a>
                                <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" onsubmit="return confirm('Deseja excluir este aluno?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-50">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-5 py-12 text-center text-sm text-slate-500">Nenhum aluno cadastrado.</td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>
    </div>
@endsection
