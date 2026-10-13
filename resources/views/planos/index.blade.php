@extends('layouts.app')

@section('title', 'Planos')

@section('content')
    <div class="mx-auto max-w-7xl space-y-6" x-data="{ showCreateModal: {{ $errors->any() ? 'true' : 'false' }} }">
        <header class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <h1 class="text-2xl font-bold tracking-tight text-slate-900 sm:text-3xl">Planos</h1>
                <p class="mt-2 text-sm text-slate-500">Configure valores e períodos das mensalidades da academia.</p>
            </div>
            @if(auth()->user()->hasRole(\App\Models\User::ROLE_ADMIN_TENANT, \App\Models\User::ROLE_STAFF))
                <x-button x-on:click="showCreateModal = true">
                    <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 5v14m-7-7h14" /></svg>
                    Cadastro rápido
                </x-button>
            @endif
        </header>

        @if(session('success'))
            <div role="status" class="rounded-lg border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>
        @endif

        <x-card>
            <x-table>
                <x-slot:head>
                    <th scope="col" class="px-5 py-3">Plano</th>
                    <th scope="col" class="px-5 py-3">Valor</th>
                    <th scope="col" class="px-5 py-3">Período</th>
                    <th scope="col" class="px-5 py-3">Descrição</th>
                    <th scope="col" class="px-5 py-3 text-right">Ações</th>
                </x-slot:head>

                @forelse($planos as $plano)
                    <tr class="transition hover:bg-slate-50">
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex items-center gap-3">
                                <span class="flex h-10 w-10 items-center justify-center rounded-xl bg-emerald-50 text-emerald-700">
                                    <svg aria-hidden="true" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M12 3v18m7-14H9a3 3 0 0 0 0 6h6a3 3 0 0 1 0 6H5" /></svg>
                                </span>
                                <span class="font-semibold text-slate-900">{{ $plano->nome }}</span>
                            </div>
                        </td>
                        <td class="whitespace-nowrap px-5 py-4 font-semibold text-slate-800">R$ {{ number_format($plano->valor, 2, ',', '.') }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <span class="inline-flex rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-semibold capitalize text-emerald-700">{{ $plano->periodo }}</span>
                        </td>
                        <td class="max-w-sm px-5 py-4 text-slate-600">{{ $plano->descricao ?: 'Sem descrição cadastrada.' }}</td>
                        <td class="whitespace-nowrap px-5 py-4">
                            <div class="flex justify-end gap-2">
                                <a href="{{ route('planos.edit', $plano->id) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-700 hover:bg-slate-100">Editar</a>
                                <form action="{{ route('planos.destroy', $plano->id) }}" method="POST" onsubmit="return confirm('Excluir plano?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="rounded-lg border border-red-200 px-3 py-2 text-xs font-semibold text-red-700 hover:bg-red-50">Excluir</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-5 py-12 text-center text-sm text-slate-500">Nenhum plano cadastrado.</td>
                    </tr>
                @endforelse
            </x-table>
        </x-card>

        <div x-cloak x-show="showCreateModal" x-transition.opacity class="fixed inset-0 z-[10000] flex items-center justify-center overflow-y-auto bg-slate-950/50 p-4" x-on:keydown.escape.window="showCreateModal = false" x-on:click.self="showCreateModal = false" role="dialog" aria-modal="true" aria-labelledby="quick-plan-title">
            <div x-show="showCreateModal" x-transition class="my-auto w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl sm:p-8">
                <div class="mb-5 flex items-start justify-between gap-4">
                    <div>
                        <h2 id="quick-plan-title" class="text-xl font-bold text-slate-900">Novo plano</h2>
                        <p class="mt-1 text-sm text-slate-500">Cadastre uma opção de matrícula rapidamente.</p>
                    </div>
                    <button type="button" x-on:click="showCreateModal = false" class="rounded-lg p-2 text-slate-500 hover:bg-slate-100" aria-label="Fechar">✕</button>
                </div>

                @if($errors->any())
                    <div class="mb-4 rounded-lg border border-red-200 bg-red-50 p-3 text-sm text-red-700">
                        <ul class="list-inside list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('planos.store') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label for="quick-nome" class="mb-1.5 block text-sm font-semibold text-slate-700">Nome do plano</label>
                        <input id="quick-nome" name="nome" value="{{ old('nome') }}" required maxlength="255" class="w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500" placeholder="Ex.: Plano mensal">
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label for="quick-valor" class="mb-1.5 block text-sm font-semibold text-slate-700">Valor (R$)</label>
                            <input id="quick-valor" name="valor" type="number" min="0" step="0.01" value="{{ old('valor') }}" required class="w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                        </div>
                        <div>
                            <label for="quick-tipo" class="mb-1.5 block text-sm font-semibold text-slate-700">Período</label>
                            <select id="quick-tipo" name="tipo" required class="w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">
                                <option value="">Selecione</option>
                                <option value="mensal" @selected(old('tipo') === 'mensal')>Mensal</option>
                                <option value="trimestral" @selected(old('tipo') === 'trimestral')>Trimestral</option>
                                <option value="anual" @selected(old('tipo') === 'anual')>Anual</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label for="quick-descricao" class="mb-1.5 block text-sm font-semibold text-slate-700">Descrição <span class="font-normal text-slate-400">(opcional)</span></label>
                        <textarea id="quick-descricao" name="descricao" rows="3" class="w-full rounded-lg border-slate-300 text-sm shadow-sm focus:border-emerald-500 focus:ring-emerald-500">{{ old('descricao') }}</textarea>
                    </div>
                    <div class="flex justify-end gap-3 pt-2">
                        <x-button variant="secondary" x-on:click="showCreateModal = false">Cancelar</x-button>
                        <x-button type="submit">Salvar plano</x-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
