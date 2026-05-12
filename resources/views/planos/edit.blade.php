@extends('layouts.app')

@section('title', 'Editar Plano')

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
        color: #ef4444;
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
        border-color: #ef4444;
        box-shadow: 0 0 0 .25rem rgba(239,68,68,.15);
    }

    .form-control::placeholder{
        color: #6b7280;
    }

    textarea.form-control{
        min-height: 130px;
        resize: vertical;
    }

    .input-group-text{
        background: #1f2937;
        border: 1px solid #1f2937;
        color: #ef4444;
        border-radius: 14px 0 0 14px;
        font-weight: 800;
    }

    .input-group .form-control{
        border-radius: 0 14px 14px 0;
    }

    .invalid-feedback{
        color: #fca5a5;
        font-weight: 600;
    }

    .is-invalid{
        border-color: #ef4444 !important;
    }

    .alert{
        border-radius: 16px;
        border: none;
    }

    .plan-preview{
        background: linear-gradient(135deg, rgba(239,68,68,.12), rgba(239,68,68,.04));
        border: 1px solid rgba(239,68,68,.12);
        border-radius: 20px;
        padding: 22px;
        margin-bottom: 28px;
    }

    .preview-label{
        color: #9ca3af;
        font-size: 12px;
        text-transform: uppercase;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .preview-name{
        color: #fff;
        font-size: 28px;
        font-weight: 800;
        margin-bottom: 8px;
    }

    .preview-price{
        color: #ef4444;
        font-size: 24px;
        font-weight: 800;
    }

    .preview-period{
        color: #d1d5db;
        margin-top: 4px;
    }

    .actions{
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 26px;
    }

    .btn-fit-primary{
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

    .btn-fit-primary:hover{
        transform: translateY(-1px);
        color: #fff;
        box-shadow: 0 14px 30px rgba(239,68,68,.30);
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
        Editar Plano
    </h1>

    <p class="fit-page-subtitle">
        Atualize as informações do plano da academia.
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

    <div class="plan-preview">  

        <div class="preview-label">
            Plano atual
        </div>

        <div class="preview-name">
            {{ $plano->nome }}
        </div>

        <div class="preview-price">
            R$ {{ number_format($plano->valor, 2, ',', '.') }}
        </div>

            <div class="preview-period">
                {{ ucfirst($plano->periodo) }}
            </div>

    </div>

    <form action="{{ route('planos.update', $plano->id) }}" method="POST">

        @csrf
        @method('PUT')

        <div class="section-title">

            <i class="bi bi-pencil-square"></i>

            Editar informações do plano

        </div>

        <div class="row g-4">

           <div class="col-md-6">

    <label for="tipo">
        Tipo do plano
    </label>

    <select
        id="tipo"
        name="tipo"
        class="form-control @error('tipo') is-invalid @enderror"
        required
    >

        <option value="mensal"
            {{ old('tipo', $plano->tipo) == 'mensal' ? 'selected' : '' }}>
            Mensal
        </option>

        <option value="trimestral"
            {{ old('tipo', $plano->tipo) == 'trimestral' ? 'selected' : '' }}>
            Trimestral
        </option>

        <option value="anual"
            {{ old('tipo', $plano->tipo) == 'anual' ? 'selected' : '' }}>
            Anual
        </option>

    </select>

    @error('tipo')
        <div class="invalid-feedback">
            {{ $message }}
        </div>
    @enderror

</div>
            <div class="col-md-6">

                <label for="valor">
                    Valor
                </label>

                <div class="input-group">

                    <span class="input-group-text">
                        R$
                    </span>

                    <input
                        type="number"
                        step="0.01"
                        id="valor"
                        name="valor"
                        value="{{ old('valor', $plano->valor) }}"
                        class="form-control @error('valor') is-invalid @enderror"
                        placeholder="Ex: 99.90"
                        required
                    >

                </div>

                @error('valor')
                    <div class="invalid-feedback d-block">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="col-md-6">

                <label for="periodo">
                    Período
                </label>

                <input
                    type="text"
                    id="periodo"
                    name="periodo"
                    value="{{ old('periodo', $plano->periodo) }}"
                    class="form-control @error('periodo') is-invalid @enderror"
                    placeholder="Ex: mensal, trimestral, anual"
                    required
                >

                @error('periodo')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

            <div class="col-md-12">

                <label for="descricao">
                    Descrição
                </label>

                <textarea
                    id="descricao"
                    name="descricao"
                    class="form-control @error('descricao') is-invalid @enderror"
                    placeholder="Descreva os benefícios do plano..."
                >{{ old('descricao', $plano->descricao) }}</textarea>

                @error('descricao')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror

            </div>

        </div>

        <div class="actions">

            <button type="submit" class="btn btn-fit-primary">

                <i class="bi bi-check-circle-fill"></i>

                Atualizar Plano

            </button>

            <a href="{{ route('planos.index') }}" class="btn-fit-secondary">

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

        </div>

    </form>

</div>

@endsection