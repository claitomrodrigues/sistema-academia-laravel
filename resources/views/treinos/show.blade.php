@extends('layouts.app')

@section('title', 'Ficha de Treino')

@section('content')

<div class="container mt-4">
    <h2>Ficha de Treino</h2>

    <div class="card bg-secondary text-light mb-4">
        <div class="card-body">
            <h5>Aluno: {{ $treino->aluno->user->name ?? 'Aluno não encontrado' }}</h5>
            <p>Tipo: {{ $treino->tipo }}</p>
            <p>Status: {{ $treino->status }}</p>
        </div>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Exercício</th>
                <th>Grupo Muscular</th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Carga</th>
            </tr>
        </thead>
        <tbody>
            @forelse($treino->itens as $item)
                <tr>
                    <td>{{ $item->exercicio->nome ?? 'Exercício removido' }}</td>
                    <td>{{ $item->exercicio->grupo_muscular ?? '-' }}</td>
                    <td>{{ $item->series }}</td>
                    <td>{{ $item->reps }}</td>
                    <td>{{ $item->carga }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Nenhum exercício cadastrado neste treino.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('treinos.index') }}" class="btn btn-secondary">Voltar</a>
    @else
        <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
    @endif
</div>

@endsection