@extends('layouts.app')

@section('title', 'Exercícios')

@section('content')

<div class="container mt-4">
    <h2>Exercícios</h2>

    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('exercicios.create') }}" class="btn btn-danger mb-3">
            Novo Exercício
        </a>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Grupo Muscular</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($exercicios as $exercicio)
                <tr>
                    <td>{{ $exercicio->nome }}</td>
                    <td>{{ $exercicio->grupo_muscular }}</td>
                    <td>
                        @if(auth()->user()->role === 'instrutor')
                            <a href="{{ route('exercicios.edit', $exercicio->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('exercicios.destroy', $exercicio->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Excluir?')">
                                    Excluir
                                </button>
                            </form>
                        @else
                            <span class="text-muted">Somente visualização</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">
                        Nenhum exercício cadastrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection