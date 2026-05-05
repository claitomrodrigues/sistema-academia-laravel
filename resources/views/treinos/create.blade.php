@extends('layouts.app')

@section('title', 'Novo Treino')

@section('content')

<div class="container mt-4">
    <h2>Montar Treino</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $erro)
                <div>{{ $erro }}</div>
            @endforeach
        </div>
    @endif

    <form action="{{ route('treinos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Aluno</label>
            <select name="aluno_id" class="form-control" required>
                <option value="">Selecione o aluno</option>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                        {{ $aluno->user->name ?? $aluno->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo do treino</label>
            <input 
                type="text" 
                name="tipo" 
                value="{{ old('tipo') }}"
                class="form-control" 
                placeholder="Ex: A, B, C, Superior, Inferior" 
                required
            >
        </div>

        <hr>

        <h4>Exercícios</h4>

        @for($i = 0; $i < 2; $i++)
            <div class="row mb-3">
                <div class="col-md-4">
                    <label>Exercício</label>
                    <select name="itens[{{ $i }}][exercicio_id]" class="form-control" {{ $i == 0 ? 'required' : '' }}>
                        <option value="">Selecione</option>
                        @foreach($exercicios as $exercicio)
                            <option value="{{ $exercicio->id }}" {{ old("itens.$i.exercicio_id") == $exercicio->id ? 'selected' : '' }}>
                                {{ $exercicio->nome }} - {{ $exercicio->grupo_muscular }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-2">
                    <label>Séries</label>
                    <input 
                        type="number" 
                        name="itens[{{ $i }}][series]" 
                        value="{{ old("itens.$i.series") }}"
                        class="form-control" 
                        {{ $i == 0 ? 'required' : '' }}
                    >
                </div>

                <div class="col-md-2">
                    <label>Repetições</label>
                    <input 
                        type="number" 
                        name="itens[{{ $i }}][reps]" 
                        value="{{ old("itens.$i.reps") }}"
                        class="form-control" 
                        {{ $i == 0 ? 'required' : '' }}
                    >
                </div>

                <div class="col-md-2">
                    <label>Carga</label>
                    <input 
                        type="text" 
                        name="itens[{{ $i }}][carga]" 
                        value="{{ old("itens.$i.carga") }}"
                        class="form-control" 
                        placeholder="Ex: 20kg"
                    >
                </div>
            </div>
        @endfor

        <button class="btn btn-danger">Salvar Treino</button>
        <a href="{{ route('treinos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

@endsection