@extends('layouts.app')

@section('title', 'Novo Exercício')

@section('content')

<style>

    .fit-page-header{
        margin-bottom: 28px;
    }

    .fit-page-title{
        color: #fff;
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .fit-page-subtitle{
        color: #9ca3af;
        margin: 0;
    }

    .fit-card{
        background: #111827;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 20px 45px rgba(0,0,0,.25);
    }

    .exercise-preview{
        background: linear-gradient(
            135deg,
            rgba(22,163,74,.12),
            rgba(22,163,74,.04)
        );

        border: 1px solid rgba(22,163,74,.12);

        border-radius: 22px;

        padding: 24px;

        margin-bottom: 28px;
    }

    .preview-label{
        color: #9ca3af;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .preview-title{
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .preview-badge{
        display: inline-flex;
        align-items: center;
        gap: 8px;

        background: rgba(22,163,74,.15);

        color: #16A34A;

        padding: 9px 14px;

        border-radius: 999px;

        font-size: 13px;
        font-weight: 800;
    }

    .section-title{
        color: #fff;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 24px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i{
        color: #16A34A;
    }

    label{
        color: #d1d5db;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-control{
        background: #020617;
        border: 1px solid #1f2937;
        color: #fff;
        border-radius: 14px;
        padding: 13px 15px;
    }

    .form-control:focus{
        background: #020617;
        color: #fff;
        border-color: #16A34A;
        box-shadow: 0 0 0 .25rem rgba(22,163,74,.15);
    }

    .form-control::placeholder{
        color: #6b7280;
    }

    .invalid-feedback{
        color: #86EFAC;
        font-weight: 600;
    }

    .is-invalid{
        border-color: #16A34A !important;
    }

    .alert{
        border-radius: 16px;
        border: none;
    }

    .form-hint{
        color: #6b7280;
        font-size: 13px;
        margin-top: 6px;
    }

    .actions{
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 26px;
    }

    .btn-fit-primary{
        background: linear-gradient(135deg, #16A34A, #15803D);
        border: none;
        color: #fff;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 800;
        transition: .2s;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-fit-primary:hover{
        transform: translateY(-1px);
        color: #fff;
        box-shadow: 0 14px 30px rgba(22,163,74,.30);
    }

    .btn-fit-secondary{
        background: #1f2937;
        border: 1px solid rgba(255,255,255,.06);
        color: #d1d5db;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-fit-secondary:hover{
        background: #374151;
        color: #fff;
    }

</style>

<div class="fit-page-header">

    <h1 class="fit-page-title">
        Novo Exercício
    </h1>

    <p class="fit-page-subtitle">
        Cadastre exercícios para utilização nas fichas de treino dos alunos.
    </p>

</div>

@if ($errors->any())

    <div class="alert alert-danger">

        <strong>
            Ops! Verifique os campos abaixo:
        </strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>

    </div>

@endif

<div class="fit-card">

    <div class="exercise-preview">

        <div class="preview-label">
            Novo exercício
        </div>

        <div class="preview-title">
            Cadastro FitCloud
        </div>

        <div class="preview-badge">

            <i class="bi bi-lightning-charge-fill"></i>

            Banco de exercícios da academia

        </div>

    </div>

    <form action="{{ route('exercicios.store') }}" method="POST">

        @csrf

        <div class="section-title">

            <i class="bi bi-plus-circle-fill"></i>

            Informações do exercício

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label for="nome">
                    Nome do exercício
                </label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="{{ old('nome') }}"
                    class="form-control @error('nome') is-invalid @enderror"
                    placeholder="Ex: Supino reto"
                    required
                >

                <div class="form-hint">
                    Informe o nome principal do exercício.
                </div>

                @error('nome')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="col-md-6">

                <label for="grupo_muscular">
                    Grupo muscular
                </label>

                <input
                    type="text"
                    id="grupo_muscular"
                    name="grupo_muscular"
                    value="{{ old('grupo_muscular') }}"
                    class="form-control @error('grupo_muscular') is-invalid @enderror"
                    placeholder="Ex: Peito, Costas, Bíceps..."
                    required
                >

                <div class="form-hint">
                    Defina o grupo muscular trabalhado.
                </div>

                @error('grupo_muscular')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

        <div class="actions">

            <button type="submit" class="btn btn-fit-primary">

                <i class="bi bi-check-circle-fill"></i>

                Salvar Exercício

            </button>

            <a href="{{ route('exercicios.index') }}" class="btn-fit-secondary">

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

        </div>

    </form>

</div>

@endsection