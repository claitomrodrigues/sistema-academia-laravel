@extends('layouts.app')

@section('title', 'Novo Plano')

@section('content')

<div class="container mt-4">
    <h2>Cadastrar Plano</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $erro)
                    <li>{{ $erro }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('planos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input 
                type="text" 
                name="nome" 
                value="{{ old('nome') }}"
                class="form-control @error('nome') is-invalid @enderror" 
                required
            >
            @error('nome')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Valor</label>
            <input 
                type="number" 
                step="0.01" 
                name="valor" 
                value="{{ old('valor') }}"
                class="form-control @error('valor') is-invalid @enderror" 
                required
            >
            @error('valor')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Período</label>
            <input 
                type="text" 
                name="periodo" 
                value="{{ old('periodo') }}"
                class="form-control @error('periodo') is-invalid @enderror" 
                placeholder="Ex: mensal, anual"
                required
            >
            @error('periodo')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea 
                name="descricao" 
                class="form-control @error('descricao') is-invalid @enderror"
            >{{ old('descricao') }}</textarea>
            @error('descricao')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button class="btn btn-danger">Salvar</button>
        <a href="{{ route('planos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

@endsection