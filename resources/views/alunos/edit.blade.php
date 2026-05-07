@extends('layouts.app')

@section('title', 'Editar Aluno')

@section('content')

<style>
    .fit-page-header {
        margin-bottom: 28px;
    }

    .fit-page-title {
        color: #fff;
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .fit-page-subtitle {
        color: #9ca3af;
        margin: 0;
    }

    .fit-card {
        background: #111827;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 24px;
        padding: 30px;
        box-shadow: 0 20px 45px rgba(0,0,0,.25);
    }

    .student-preview {
        background: linear-gradient(135deg, rgba(239,68,68,.12), rgba(239,68,68,.04));
        border: 1px solid rgba(239,68,68,.12);
        border-radius: 22px;
        padding: 24px;
        margin-bottom: 28px;
    }

    .preview-label {
        color: #9ca3af;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .preview-title {
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 10px;
    }

    .preview-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(239,68,68,.15);
        color: #ef4444;
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
    }

    .section-title {
        color: #fff;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 24px;
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

    .form-control {
        background: #020617;
        border: 1px solid #1f2937;
        color: #fff;
        border-radius: 14px;
        padding: 13px 15px;
    }

    .form-control:focus {
        background: #020617;
        color: #fff;
        border-color: #ef4444;
        box-shadow: 0 0 0 .25rem rgba(239,68,68,.15);
    }

    .form-control::placeholder {
        color: #6b7280;
    }

    .invalid-feedback {
        color: #fca5a5;
        font-weight: 600;
    }

    .is-invalid {
        border-color: #ef4444 !important;
    }

    .alert {
        border-radius: 16px;
        border: none;
    }

    .form-hint {
        color: #6b7280;
        font-size: 13px;
        margin-top: 6px;
    }

    .actions {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 26px;
    }

    .btn-fit-primary {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
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

    .btn-fit-primary:hover {
        transform: translateY(-1px);
        color: #fff;
        box-shadow: 0 14px 30px rgba(239,68,68,.30);
    }

    .btn-fit-secondary {
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

    .btn-fit-secondary:hover {
        background: #374151;
        color: #fff;
    }
</style>

<div class="fit-page-header">
    <h1 class="fit-page-title">Editar Aluno</h1>
    <p class="fit-page-subtitle">
        Atualize os dados pessoais e o objetivo do aluno cadastrado.
    </p>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Ops! Verifique os campos abaixo:</strong>

        <ul class="mb-0 mt-2">
            @foreach ($errors->all() as $erro)
                <li>{{ $erro }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="fit-card">
    <div class="student-preview">
        <div class="preview-label">Aluno atual</div>

        <div class="preview-title">
            {{ $aluno->user->name ?? $aluno->nome }}
        </div>

        <div class="preview-badge">
            <i class="bi bi-person-badge-fill"></i>
            {{ $aluno->objetivo ?? 'Objetivo não informado' }}
        </div>
    </div>

    <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="section-title">
            <i class="bi bi-pencil-square"></i>
            Editar informações do aluno
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label for="nome">Nome completo</label>

                <input
                    type="text"
                    id="nome"
                    name="nome"
                    value="{{ old('nome', $aluno->user->name ?? $aluno->nome) }}"
                    class="form-control @error('nome') is-invalid @enderror"
                    placeholder="Ex: João Silva"
                    required
                >

                @error('nome')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="cpf">CPF</label>

                <input
                    type="text"
                    id="cpf"
                    name="cpf"
                    value="{{ old('cpf', $aluno->cpf) }}"
                    class="form-control @error('cpf') is-invalid @enderror"
                    placeholder="Ex: 000.000.000-00"
                    required
                >

                @error('cpf')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="nascimento">Data de nascimento</label>

                <input
                    type="date"
                    id="nascimento"
                    name="nascimento"
                    value="{{ old('nascimento', $aluno->nascimento) }}"
                    class="form-control @error('nascimento') is-invalid @enderror"
                    required
                >

                @error('nascimento')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="objetivo">Objetivo</label>

                <input
                    type="text"
                    id="objetivo"
                    name="objetivo"
                    value="{{ old('objetivo', $aluno->objetivo) }}"
                    class="form-control @error('objetivo') is-invalid @enderror"
                    placeholder="Ex: Emagrecimento, hipertrofia, condicionamento físico..."
                >

                <div class="form-hint">
                    Informe o principal objetivo do aluno na academia.
                </div>

                @error('objetivo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="actions">
            <button type="submit" class="btn btn-fit-primary">
                <i class="bi bi-check-circle-fill"></i>
                Atualizar Aluno
            </button>

            <a href="{{ route('alunos.index') }}" class="btn-fit-secondary">
                <i class="bi bi-arrow-left"></i>
                Voltar
            </a>
        </div>
    </form>
</div>

@endsection