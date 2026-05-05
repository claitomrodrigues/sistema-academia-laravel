@extends('layouts.app')

@section('title', 'Editar Exercício')

@section('content')

<div class="container mt-4">
    <h2>Editar Exercício</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('exercicios.update', $exercicio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input 
                type="text" 
                name="nome" 
                value="{{ old('nome', $exercicio->nome) }}"
                class="form-control @error('nome') is-invalid @enderror" 
                required
            >
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Grupo Muscular</label>
            <input 
                type="text" 
                name="grupo_muscular" 
                value="{{ old('grupo_muscular', $exercicio->grupo_muscular) }}"
                class="form-control @error('grupo_muscular') is-invalid @enderror" 
                required
            >
            @error('grupo_muscular')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-danger">Atualizar</button>
        <a href="{{ route('exercicios.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

@endsection