@extends('layouts.app')

@section('title', 'Novo Treino')

@section('content')

@php
    use Illuminate\Support\Str;
@endphp

<style>
    .fit-page-header {
        margin-bottom: 26px;
        animation: fadeUp .5s ease both;
    }

    .filter-box,
    .price-box {
        background: #020617;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 20px;
        padding: 18px;
        margin-bottom: 24px;
    }

    .price-box {
        border-color: rgba(239,68,68,.25);
        background: linear-gradient(135deg, rgba(239,68,68,.12), #020617);
    }

    .price-value {
        color: #fff;
        font-size: 28px;
        font-weight: 900;
    }

    .price-text {
        color: #fca5a5;
        font-weight: 700;
        margin: 0;
    }

    .fit-page-title {
        color: #fff;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 6px;
    }

    .fit-page-subtitle {
        color: #9ca3af;
        margin-bottom: 0;
    }

    .fit-card {
        background: rgba(17, 24, 39, .92);
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 28px;
        padding: 30px;
        box-shadow: 0 22px 55px rgba(0,0,0,.35);
        animation: fadeUp .6s ease both;
    }

    .section-title {
        color: #fff;
        font-size: 20px;
        font-weight: 900;
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
        font-weight: 700;
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

    .divider {
        height: 1px;
        background: rgba(255,255,255,.08);
        margin: 30px 0;
    }

    .exercise-list {
        display: grid;
        gap: 18px;
    }

    .exercise-check-card {
        background: #020617;
        border: 1px solid rgba(255,255,255,.07);
        border-radius: 22px;
        padding: 20px;
        transition: .25s;
        position: relative;
        overflow: hidden;
    }

    .exercise-check-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(239,68,68,.22), transparent 35%);
        opacity: 0;
        transition: .25s;
    }

    .exercise-check-card:hover {
        transform: translateY(-3px);
        border-color: rgba(239,68,68,.45);
        box-shadow: 0 14px 35px rgba(239,68,68,.16);
    }

    .exercise-check-card:has(.exercise-checkbox:checked) {
        border-color: #ef4444;
        background: linear-gradient(135deg, rgba(239,68,68,.16), #020617);
        box-shadow: 0 16px 40px rgba(239,68,68,.22);
    }

    .exercise-check-card:has(.exercise-checkbox:checked)::before {
        opacity: 1;
    }

    .exercise-check-header,
    .exercise-fields {
        position: relative;
        z-index: 2;
    }

    .exercise-checkbox {
        margin-right: 10px;
        cursor: pointer;
        transform: scale(1.2);
    }

    .exercise-checkbox:checked {
        background-color: #ef4444;
        border-color: #ef4444;
    }

    .exercise-name {
        color: #fff;
        font-weight: 900;
        cursor: pointer;
        font-size: 16px;
    }

    .exercise-muscle {
        margin-left: 10px;
        color: #fca5a5;
        font-size: 13px;
        font-weight: 800;
        background: rgba(239,68,68,.15);
        padding: 5px 10px;
        border-radius: 999px;
    }

    .exercise-fields {
        display: none;
    }

    .exercise-check-card:has(.exercise-checkbox:checked) .exercise-fields {
        display: flex;
        animation: fadeUp .25s ease both;
    }

    .btn-fit-primary {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        border: none;
        color: #fff;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 800;
        transition: .2s;
        box-shadow: 0 12px 30px rgba(239, 68, 68, .25);
    }

    .btn-fit-primary:hover {
        transform: translateY(-2px);
        color: #fff;
        box-shadow: 0 16px 38px rgba(239, 68, 68, .38);
    }

    .btn-fit-secondary {
        background: #1f2937;
        border: 1px solid rgba(255,255,255,.08);
        color: #d1d5db;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 800;
        text-decoration: none;
        transition: .2s;
    }

    .btn-fit-secondary:hover {
        background: #374151;
        color: #fff;
        transform: translateY(-2px);
    }

    .alert {
        border-radius: 16px;
        border: none;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<div class="fit-page-header">
    <h1 class="fit-page-title">Montar Treino</h1>

    <p class="fit-page-subtitle">
        Crie uma ficha personalizada com vários exercícios, séries, repetições e cargas.
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
            <div class="col-md-4">
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

            <div class="col-md-4">
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

            <div class="col-md-4">
                <label for="dias_semana">Dias por semana</label>

                <select name="dias_semana" id="dias_semana" class="form-select" required>
                    <option value="">Selecione</option>
                    <option value="2" {{ old('dias_semana') == 2 ? 'selected' : '' }}>2x na semana</option>
                    <option value="3" {{ old('dias_semana') == 3 ? 'selected' : '' }}>3x na semana</option>
                    <option value="4" {{ old('dias_semana') == 4 ? 'selected' : '' }}>4x na semana</option>
                    <option value="5" {{ old('dias_semana') == 5 ? 'selected' : '' }}>5x na semana</option>
                    <option value="6" {{ old('dias_semana') == 6 ? 'selected' : '' }}>6x na semana</option>
                    <option value="7" {{ old('dias_semana') == 7 ? 'selected' : '' }}>Todos os dias</option>
                </select>
            </div>
        </div>

        <div class="price-box mt-4">
            <p class="price-text">
                <i class="bi bi-cash-coin me-1"></i>
                Valor mensal calculado automaticamente
            </p>

            <div class="price-value" id="valor_mensal_preview">
                R$ 100,00
            </div>
        </div>

        <div class="divider"></div>

        <div class="section-title">
            <i class="bi bi-lightning-charge-fill"></i>
            Exercícios
        </div>

        <div class="filter-box">
            <label for="filtro_grupo">
                <i class="bi bi-funnel-fill text-danger me-1"></i>
                Filtrar por grupo muscular
            </label>

            <select id="filtro_grupo" class="form-select">
                <option value="todos">Todos os exercícios</option>

                @foreach($exercicios->pluck('grupo_muscular')->unique()->sort() as $grupo)
                    <option value="{{ Str::slug($grupo) }}">
                        {{ $grupo }}
                    </option>
                @endforeach
            </select>

            <small class="text-secondary d-block mt-2">
                Escolha um grupo muscular para facilitar a montagem do treino.
            </small>
        </div>

        <div class="exercise-list">
            @foreach($exercicios as $exercicio)
                <div
                    class="exercise-check-card"
                    data-grupo="{{ Str::slug($exercicio->grupo_muscular) }}"
                >
                    <div class="exercise-check-header">
                        <input
                            class="form-check-input exercise-checkbox"
                            type="checkbox"
                            name="itens[{{ $exercicio->id }}][exercicio_id]"
                            value="{{ $exercicio->id }}"
                            id="exercicio_{{ $exercicio->id }}"
                            {{ old("itens.{$exercicio->id}.exercicio_id") ? 'checked' : '' }}
                        >

                        <label for="exercicio_{{ $exercicio->id }}" class="exercise-name">
                            {{ $exercicio->nome }}
                        </label>

                        <span class="exercise-muscle">
                            {{ $exercicio->grupo_muscular }}
                        </span>
                    </div>

                    <div class="exercise-fields row g-3 mt-2">
                        <div class="col-md-4">
                            <label>Séries</label>

                            <input
                                type="number"
                                name="itens[{{ $exercicio->id }}][series]"
                                value="{{ old("itens.{$exercicio->id}.series") }}"
                                class="form-control"
                                placeholder="Ex: 4"
                            >
                        </div>

                        <div class="col-md-4">
                            <label>Repetições</label>

                            <input
                                type="number"
                                name="itens[{{ $exercicio->id }}][reps]"
                                value="{{ old("itens.{$exercicio->id}.reps") }}"
                                class="form-control"
                                placeholder="Ex: 12"
                            >
                        </div>

                        <div class="col-md-4">
                            <label>Carga</label>

                            <input
                                type="text"
                                name="itens[{{ $exercicio->id }}][carga]"
                                value="{{ old("itens.{$exercicio->id}.carga") }}"
                                class="form-control"
                                placeholder="Ex: 20kg"
                            >
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

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

<script>
    const filtroGrupo = document.getElementById('filtro_grupo');
    const cards = document.querySelectorAll('.exercise-check-card');

    filtroGrupo.addEventListener('change', function () {
        const grupoSelecionado = this.value;

        cards.forEach(card => {
            const grupoCard = card.dataset.grupo;

            if (grupoSelecionado === 'todos' || grupoSelecionado === grupoCard) {
                card.style.display = 'block';

                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, 20);
            } else {
                card.style.opacity = '0';
                card.style.transform = 'translateY(12px)';

                setTimeout(() => {
                    card.style.display = 'none';
                }, 180);
            }
        });
    });

    const diasSemana = document.getElementById('dias_semana');
    const valorPreview = document.getElementById('valor_mensal_preview');

    function atualizarValorMensal() {
        const dias = parseInt(diasSemana.value || 2);
        const valor = 100 + ((dias - 2) * 10);

        valorPreview.textContent = valor.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });
    }

    diasSemana.addEventListener('change', atualizarValorMensal);
    atualizarValorMensal();
</script>

@endsection