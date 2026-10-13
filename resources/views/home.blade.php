@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6">
        <section class="overflow-hidden rounded-2xl bg-gradient-to-br from-slate-900 via-slate-800 to-emerald-950 px-6 py-8 text-white shadow-sm sm:px-10 sm:py-10">
            <p class="mb-3 text-sm font-semibold uppercase tracking-[0.18em] text-emerald-300">FitCloud</p>
            <h1 class="text-3xl font-bold tracking-tight sm:text-4xl">
                <span class="!text-white">Olá, {{ auth()->user()->name }}</span>
            </h1>
            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-300 sm:text-base">
                {{ auth()->user()->hasRole(\App\Models\User::ROLE_MEMBER) ? 'Acompanhe seus treinos e pagamentos em um só lugar.' : 'Acompanhe a operação da sua academia em um só lugar.' }}
            </p>
            <div class="mt-6 flex flex-wrap gap-3">
                @if(auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN_TENANT, \App\Models\User::ROLE_STAFF))
                    <x-button href="{{ route('alunos.index') }}">Gerenciar alunos</x-button>
                    <x-button href="{{ route('presencas.index') }}" variant="inverse">Controle de presenças</x-button>
                @endif
                @if(auth()->user()->hasRole(\App\Models\User::ROLE_MEMBER))
                    @if(auth()->user()->aluno)
                        <x-button href="{{ route('meu.treino', auth()->user()->aluno->id) }}">Meu treino</x-button>
                    @endif
                    <x-button href="{{ route('minhas.faturas') }}" variant="inverse">Minhas faturas</x-button>
                @endif
            </div>
        </section>

        @if(isset($activeMembers, $revenue, $delinquentMembers))
            <section aria-label="Indicadores da academia" class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-3">
                <x-card>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                            <svg aria-hidden="true" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M16 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2m16 0v-2a4 4 0 0 0-3-3.87M14 3.13a4 4 0 0 1 0 7.75M14 11H8a4 4 0 1 1 0-8h4a4 4 0 0 1 2 7.46" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">Alunos ativos</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">{{ $activeMembers }}</p>
                        </div>
                    </div>
                </x-card>
                <x-card>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-blue-50 text-blue-700">
                            <svg aria-hidden="true" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 6v12m-4-9.5h6a2.5 2.5 0 0 1 0 5H9.5a2.5 2.5 0 0 0 0 5H16" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">Faturamento recebido neste mês</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">R$ {{ number_format($revenue, 2, ',', '.') }}</p>
                        </div>
                    </div>
                </x-card>
                <x-card>
                    <div class="flex items-center gap-4">
                        <div class="flex h-12 w-12 items-center justify-center rounded-xl bg-red-50 text-red-700">
                            <svg aria-hidden="true" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 9v4m0 4h.01M10.3 3.86 1.82 18.5A1.8 1.8 0 0 0 3.37 21h17.26a1.8 1.8 0 0 0 1.55-2.5L13.7 3.86a1.96 1.96 0 0 0-3.4 0Z" /></svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-slate-500">Alunos inadimplentes</p>
                            <p class="mt-1 text-2xl font-bold text-slate-900">{{ $delinquentMembers }}</p>
                        </div>
                    </div>
                </x-card>
            </section>
        @endif
    </div>
@endsection
