@extends('layouts.app')

@section('title', 'Planos')

@section('content')

<div class="container mt-4">
    <h2>Planos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- BOTÃO SÓ PARA INSTRUTOR --}}
    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('planos.create') }}" class="btn btn-danger mb-3">
            Novo Plano
        </a>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Valor</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($planos as $plano)
                <tr>
                    <td>{{ $plano->nome }}</td>
                    <td>R$ {{ number_format($plano->valor, 2, ',', '.') }}</td>
                    <td>{{ $plano->periodo }}</td>
                    <td>{{ $plano->descricao }}</td>
                    <td>
                        {{-- VER (opcional pra todos) --}}
                        {{-- <a href="#" class="btn btn-info btn-sm">Ver</a> --}}

                        {{-- AÇÕES SÓ INSTRUTOR --}}
                        @if(auth()->user()->role === 'instrutor')
                            <a href="{{ route('planos.edit', $plano->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('planos.destroy', $plano->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Excluir?')">
                                    Excluir
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Nenhum plano cadastrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection