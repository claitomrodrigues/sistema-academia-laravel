@extends('layouts.app')

@section('title', 'Editar Aluno')

@section('content')

<div class="container mt-4">
    <h2>Editar Aluno</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input 
                type="text" 
                name="nome" 
                value="{{ old('nome', $aluno->user->name ?? $aluno->nome) }}"
                class="form-control @error('nome') is-invalid @enderror" 
                required
            >
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>CPF</label>
            <input 
                type="text" 
                name="cpf" 
                value="{{ old('cpf', $aluno->cpf) }}"
                class="form-control @error('cpf') is-invalid @enderror" 
                required
            >
            @error('cpf')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Data de nascimento</label>
            <input 
                type="date" 
                name="nascimento" 
                value="{{ old('nascimento', $aluno->nascimento) }}"
                class="form-control @error('nascimento') is-invalid @enderror" 
                required
            >
            @error('nascimento')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Objetivo</label>
            <input 
                type="text" 
                name="objetivo" 
                value="{{ old('objetivo', $aluno->objetivo) }}"
                class="form-control @error('objetivo') is-invalid @enderror"
            >
            @error('objetivo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-danger">Atualizar</button>
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

@endsection