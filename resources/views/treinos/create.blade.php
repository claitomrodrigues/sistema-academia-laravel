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

    .fit-page-title {
        color: #fff;
        font-size: 34px;
        font-weight: 900;
        margin-bottom: 8px;
    }

    .fit-page-subtitle {
        color: #94a3b8;
        margin-bottom: 0;
        font-size: 15px;
    }

    .fit-card {
        background: rgba(17, 24, 39, .94);
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 28px;
        padding: 32px;
        box-shadow: 0 25px 60px rgba(0,0,0,.45);
        position: relative;
        overflow: hidden;
        animation: fadeUp .6s ease both;
    }

    .fit-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background:
            radial-gradient(circle at top right, rgba(239,68,68,.15), transparent 25%),
            radial-gradient(circle at bottom left, rgba(59,130,246,.08), transparent 30%);
        pointer-events: none;
    }

    .section-title {
        position: relative;
        z-index: 2;
        color: #fff;
        font-size: 20px;
        font-weight: 900;
        margin-bottom: 22px;
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
        border-radius: 16px;
        padding: 13px 15px;
        transition: .25s;
    }

    .form-control:focus,
    .form-select:focus {
        background: #020617;
        color: #fff;
        border-color: #ef4444;
        box-shadow: 0 0 0 .25rem rgba(239,68,68,.18);
        transform: translateY(-2px);
    }

    .form-control::placeholder {
        color: #6b7280;
    }

    .form-select option {
        background: #111827;
        color: #fff;
    }

    .premium-box {
        background:
            linear-gradient(
                135deg,
                rgba(239,68,68,.18),
                rgba(15,23,42,.95)
            );
        border: 1px solid rgba(239,68,68,.18);
        border-radius: 24px;
        padding: 24px;
        margin-top: 26px;
        position: relative;
        overflow: hidden;
    }

    .premium-box::before {
        content: '';
        position: absolute;
        width: 280px;
        height: 280px;
        background: rgba(239,68,68,.08);
        border-radius: 50%;
        top: -140px;
        right: -140px;
        filter: blur(20px);
    }

    .price-text {
        color: #fca5a5;
        font-size: 14px;
        font-weight: 800;
        margin-bottom: 6px;
        position: relative;
        z-index: 2;
    }

    .price-value {
        color: #fff;
        font-size: 38px;
        font-weight: 900;
        position: relative;
        z-index: 2;
        text-shadow: 0 0 20px rgba(239,68,68,.35);
    }

    .price-extra {
        color: #cbd5e1;
        font-size: 14px;
        margin-top: 8px;
        position: relative;
        z-index: 2;
    }

    .divider {
        height: 1px;
        background: rgba(255,255,255,.08);
        margin: 34px 0;
    }

    .filter-box {
        background: #020617;
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 22px;
        padding: 20px;
        margin-bottom: 24px;
    }

    .filter-label {
        color: #fff;
        font-weight: 800;
        margin-bottom: 12px;
        display: block;
    }

    .exercise-list {
        display: grid;
        gap: 20px;
    }

    .exercise-check-card {
        background: #020617;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 24px;
        padding: 22px;
        transition: .28s;
        position: relative;
        overflow: hidden;
    }

    .exercise-check-card:hover {
        transform: translateY(-4px);
        border-color: rgba(239,68,68,.4);
        box-shadow: 0 18px 40px rgba(239,68,68,.15);
    }

    .exercise-check-card:has(.exercise-checkbox:checked) {
        border-color: #ef4444;
        background:
            linear-gradient(
                135deg,
                rgba(239,68,68,.16),
                #020617
            );
        box-shadow: 0 20px 45px rgba(239,68,68,.22);
    }

    .exercise-check-header {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
    }

    .exercise-checkbox {
        transform: scale(1.2);
        cursor: pointer;
    }

    .exercise-name {
        color: #fff;
        font-size: 17px;
        font-weight: 900;
        cursor: pointer;
    }

    .exercise-muscle {
        background: rgba(239,68,68,.14);
        color: #fca5a5;
        border: 1px solid rgba(239,68,68,.18);
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .exercise-fields {
        display: none;
    }

    .exercise-check-card:has(.exercise-checkbox:checked) .exercise-fields {
        display: flex;
        animation: fadeUp .25s ease both;
    }

    .btn-fit-primary {
        background: linear-gradient(135deg, #ef4444, #991b1b);
        border: none;
        color: #fff;
        border-radius: 16px;
        padding: 13px 24px;
        font-weight: 800;
        box-shadow: 0 14px 35px rgba(239,68,68,.28);
        transition: .25s;
    }

    .btn-fit-primary:hover {
        transform: translateY(-3px);
        color: #fff;
    }

    .btn-fit-secondary {
        background: #111827;
        border: 1px solid rgba(255,255,255,.08);
        color: #d1d5db;
        border-radius: 16px;
        padding: 13px 24px;
        text-decoration: none;
        font-weight: 800;
    }

    .btn-fit-secondary:hover {
        background: #1f2937;
        color: #fff;
    }

    .alert {
        border: none;
        border-radius: 18px;
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

    <h1 class="fit-page-title">
        Criar Treino Premium
    </h1>

    <p class="fit-page-subtitle">
        Monte uma ficha inteligente e associe um plano ao aluno.
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

            <i class="bi bi-person-badge-fill"></i>
            Dados do treino

        </div>

        <div class="row g-4">

            <div class="col-md-4">

                <label>Aluno</label>

                <select name="aluno_id" class="form-select" required>

                    <option value="">
                        Selecione o aluno
                    </option>

                    @foreach($alunos as $aluno)

                        <option value="{{ $aluno->id }}">
                            {{ $aluno->user->name ?? $aluno->nome }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-4">

                <label>Plano</label>

                <select
                    name="plano_id"
                    id="plano_id"
                    class="form-select"
                    required
                >

                    <option value="">
                        Selecione o plano
                    </option>

                    @foreach($planos as $plano)

                        <option
                            value="{{ $plano->id }}"
                            data-tipo="{{ $plano->tipo }}"
                            data-valor="{{ $plano->valor }}"
                        >
                            {{ $plano->nome }}
                            - R$ {{ number_format($plano->valor, 2, ',', '.') }}
                        </option>

                    @endforeach

                </select>

            </div>

            <div class="col-md-4">

                <label>Tipo do treino</label>

                <input
                    type="text"
                    name="tipo"
                    class="form-control"
                    placeholder="Ex: Hipertrofia / ABC / Superior"
                    required
                >

            </div>

            <div
                class="col-md-4"
                id="dias_semana_container"
                style="display:none;"
            >

                <label>Dias por semana</label>

                <select
                    name="dias_semana"
                    id="dias_semana"
                    class="form-select"
                >

                    <option value="">Selecione</option>
                    <option value="2">2x na semana</option>
                    <option value="3">3x na semana</option>
                    <option value="4">4x na semana</option>
                    <option value="5">5x na semana</option>
                    <option value="6">6x na semana</option>
                    <option value="7">Todos os dias</option>

                </select>

            </div>

            <div
                class="col-md-4"
                id="personal_container"
                style="display:none;"
            >

                <label>Personal Trainer</label>

                <select
                    name="personal"
                    id="personal"
                    class="form-select"
                >

                    <option value="0" data-extra="0">
                        Sem personal
                    </option>

                    <option value="1" data-extra="80">
                        Com personal (+R$ 80,00)
                    </option>

                </select>

            </div>

        </div>

        <div class="premium-box">

            <div class="price-text">

                <i class="bi bi-stars me-1"></i>
                Valor do plano selecionado

            </div>

            <div class="price-value" id="valor_plano_preview">
                R$ 0,00
            </div>

            <div class="price-extra" id="descricao_plano">
                Selecione um plano
            </div>

        </div>

        <div class="divider"></div>

        <div class="section-title">

            <i class="bi bi-lightning-charge-fill"></i>
            Exercícios

        </div>

        <div class="filter-box">

            <label class="filter-label">

                <i class="bi bi-funnel-fill text-danger me-1"></i>
                Filtrar grupo muscular

            </label>

            <select id="filtro_grupo" class="form-select">

                <option value="todos">
                    Todos os exercícios
                </option>

                @foreach($exercicios->pluck('grupo_muscular')->unique()->sort() as $grupo)

                    <option value="{{ Str::slug($grupo) }}">
                        {{ $grupo }}
                    </option>

                @endforeach

            </select>

        </div>

        <div class="exercise-list">

            @foreach($exercicios as $exercicio)

                <div
                    class="exercise-check-card"
                    data-grupo="{{ Str::slug($exercicio->grupo_muscular) }}"
                >

                    <div class="exercise-check-header">

                        <input
                            type="checkbox"
                            class="form-check-input exercise-checkbox"
                            name="itens[{{ $exercicio->id }}][exercicio_id]"
                            value="{{ $exercicio->id }}"
                            id="exercicio_{{ $exercicio->id }}"
                        >

                        <label
                            class="exercise-name"
                            for="exercicio_{{ $exercicio->id }}"
                        >
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
                                class="form-control"
                                placeholder="Ex: 4"
                            >

                        </div>

                        <div class="col-md-4">

                            <label>Repetições</label>

                            <input
                                type="number"
                                name="itens[{{ $exercicio->id }}][reps]"
                                class="form-control"
                                placeholder="Ex: 12"
                            >

                        </div>

                        <div class="col-md-4">

                            <label>Carga</label>

                            <input
                                type="text"
                                name="itens[{{ $exercicio->id }}][carga]"
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

                <i class="bi bi-check-circle-fill me-1"></i>
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

            const grupo = card.dataset.grupo;

            if (grupoSelecionado === 'todos' || grupoSelecionado === grupo) {

                card.style.display = 'block';

            } else {

                card.style.display = 'none';

            }

        });

    });

    const planoSelect = document.getElementById('plano_id');

    const diasContainer = document.getElementById('dias_semana_container');
    const personalContainer = document.getElementById('personal_container');

    const diasSemana = document.getElementById('dias_semana');

    const valorPreview = document.getElementById('valor_plano_preview');
    const descricaoPlano = document.getElementById('descricao_plano');

    const personalSelect = document.getElementById('personal');

    function atualizarPlano() {

        const option = planoSelect.options[planoSelect.selectedIndex];

        if (!option.value) {

            valorPreview.textContent = 'R$ 0,00';
            descricaoPlano.textContent = 'Selecione um plano';

            diasContainer.style.display = 'none';
            personalContainer.style.display = 'none';

            diasSemana.required = false;

            return;
        }

        const tipo = option.dataset.tipo;

        let valor = parseFloat(option.dataset.valor);

        if (personalSelect) {

            const personalOption =
                personalSelect.options[personalSelect.selectedIndex];

            const extraPersonal =
                parseFloat(personalOption.dataset.extra || 0);

            valor += extraPersonal;
        }

        valorPreview.textContent = valor.toLocaleString('pt-BR', {
            style: 'currency',
            currency: 'BRL'
        });

        let descricao = `Plano ${tipo.charAt(0).toUpperCase() + tipo.slice(1)}`;

        if (personalSelect.value === '1') {
            descricao += ' • Com personal trainer';
        }

        descricaoPlano.textContent = descricao;

        if (tipo === 'mensal') {

            diasContainer.style.display = 'block';

            diasSemana.required = true;

        } else {

            diasContainer.style.display = 'none';

            diasSemana.required = false;
        }

        personalContainer.style.display = 'block';
    }

    planoSelect.addEventListener('change', atualizarPlano);

    personalSelect.addEventListener('change', atualizarPlano);

    atualizarPlano();

</script>

@endsection