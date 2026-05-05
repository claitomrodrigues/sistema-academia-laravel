@extends('layouts.app')

@section('title', 'Alunos')

@section('content')

<div class="container mt-4">
    <h2>Alunos</h2>

    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('alunos.create') }}" class="btn btn-danger mb-3">
            Novo Aluno
        </a>
    @endif

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Nascimento</th>
                <th>Objetivo</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>
            @forelse($alunos as $aluno)
                <tr>
                    <td>{{ $aluno->user->name ?? $aluno->nome }}</td>
                    <td>{{ $aluno->cpf }}</td>
                    <td>{{ \Carbon\Carbon::parse($aluno->nascimento)->format('d/m/Y') }}</td>
                    <td>{{ $aluno->objetivo }}</td>
                    <td>
                        @if(auth()->user()->role === 'instrutor')
                            <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?')">
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
                    <td colspan="5" class="text-center">
                        Nenhum aluno cadastrado.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection