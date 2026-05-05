@extends('layouts.app')

@section('title', 'Treinos')

@section('content')

<div class="container mt-4">
    <h2>Treinos</h2>

    {{-- BOTÃO SÓ PARA INSTRUTOR --}}
    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('treinos.create') }}" class="btn btn-danger mb-3">
            Novo Treino
        </a>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($treinos as $treino)
                <tr>
                    <td>{{ $treino->aluno->user->name ?? 'Aluno não encontrado' }}</td>
                    <td>{{ $treino->tipo }}</td>
                    <td>{{ $treino->status }}</td>
                    <td>
                        <a href="{{ route('treinos.show', $treino->id) }}" class="btn btn-info btn-sm">
                            Ver
                        </a>

                        {{-- EXCLUIR SÓ INSTRUTOR --}}
                        @if(auth()->user()->role === 'instrutor')
                            <form action="{{ route('treinos.destroy', $treino->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Excluir treino?')">
                                    Excluir
                                </button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
</div>

@endsection