@extends('layouts.app')

@section('title', 'Novo Treino')

@section('content')

<style>
    .fit-page-header {
        margin-bottom: 26px;
    }

    .fit-page-title {
        color: #fff;
        font-size: 32px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .fit-page-subtitle {
        color: #9ca3af;
        margin-bottom: 0;
    }

    .fit-card {
        background: #111827;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 24px;
        padding: 28px;
        box-shadow: 0 18px 45px rgba(0,0,0,.25);
    }

    .section-title {
        color: #fff;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 18px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #ef4444;
    }

    label {
        color: #d1d5db;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select {
        background: #020617;
        border: 1px solid #1f2937;
        color: #fff;
        border-radius: 14px;
        padding: 12px 14px;
    }

    .form-control:focus,
    .form-select:focus {
        background: #020617;
        color: #fff;
        border-color: #ef4444;
        box-shadow: 0 0 0 .25rem rgba(239, 68, 68, .15);
    }

    .form-control::placeholder {
        color: #6b7280;
    }

    .form-select option {
        background: #111827;
        color: #fff;
    }

    .exercise-box {
        background: #020617;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 20px;
        padding: 22px;
        margin-bottom: 18px;
    }

    .exercise-number {
        width: 38px;
        height: 38px;
        border-radius: 12px;
        background: rgba(239, 68, 68, .15);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        margin-bottom: 16px;
    }

    .divider {
        height: 1px;
        background: rgba(255,255,255,.08);
        margin: 28px 0;
    }

    .btn-fit-primary {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        border: none;
        color: #fff;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 700;
        transition: .2s;
    }

    .btn-fit-primary:hover {
        transform: translateY(-1px);
        color: #fff;
        box-shadow: 0 12px 30px rgba(239, 68, 68, .28);
    }

    .btn-fit-secondary {
        background: #1f2937;
        border: 1px solid rgba(255,255,255,.08);
        color: #d1d5db;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 700;
        text-decoration: none;
    }

    .btn-fit-secondary:hover {
        background: #374151;
        color: #fff;
    }

    .alert {
        border-radius: 16px;
        border: none;
    }
</style>

<div class="fit-page-header">
    <h1 class="fit-page-title">
        Montar Treino
    </h1>

    <p class="fit-page-subtitle">
        Crie uma ficha personalizada com exercícios, séries, repetições e cargas.
    </p>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $erro)
            <div>{{ $erro }}</div>
        @endforeach
    </div>
@endif

<div class="fit-card">
    <form action="{{ route('treinos.store') }}" method="POST">
        @csrf

        <div class="section-title">
            <i class="bi bi-person-badge"></i>
            Informações do treino
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label for="aluno_id">Aluno</label>

                <select name="aluno_id" id="aluno_id" class="form-select" required>
                    <option value="">Selecione o aluno</option>

                    @foreach($alunos as $aluno)
                        <option value="{{ $aluno->id }}" {{ old('aluno_id') == $aluno->id ? 'selected' : '' }}>
                            {{ $aluno->user->name ?? $aluno->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="tipo">Tipo do treino</label>

                <input
                    type="text"
                    id="tipo"
                    name="tipo"
                    value="{{ old('tipo') }}"
                    class="form-control"
                    placeholder="Ex: A, B, C, Superior, Inferior"
                    required
                >
            </div>
        </div>

        <div class="divider"></div>

        <div class="section-title">
            <i class="bi bi-lightning-charge-fill"></i>
            Exercícios
        </div>

        @for($i = 0; $i < 2; $i++)
            <div class="exercise-box">
                <div class="exercise-number">
                    {{ $i + 1 }}
                </div>

                <div class="row g-3">
                    <div class="col-md-5">
                        <label>Exercício</label>

                        <select name="itens[{{ $i }}][exercicio_id]" class="form-select" {{ $i == 0 ? 'required' : '' }}>
                            <option value="">Selecione o exercício</option>

                            @foreach($exercicios as $exercicio)
                                <option value="{{ $exercicio->id }}" {{ old("itens.$i.exercicio_id") == $exercicio->id ? 'selected' : '' }}>
                                    {{ $exercicio->nome }} — {{ $exercicio->grupo_muscular }}
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
                            placeholder="Ex: 4"
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
                            placeholder="Ex: 12"
                            {{ $i == 0 ? 'required' : '' }}
                        >
                    </div>

                    <div class="col-md-3">
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
            </div>
        @endfor

        <div class="d-flex gap-3 mt-4">
            <button type="submit" class="btn btn-fit-primary">
                <i class="bi bi-check-circle me-1"></i>
                Salvar Treino
            </button>

            <a href="{{ route('treinos.index') }}" class="btn-fit-secondary">
                <i class="bi bi-arrow-left me-1"></i>
                Voltar
            </a>
        </div>
    </form>
</div>

@endsection