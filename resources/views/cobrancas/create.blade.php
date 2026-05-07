@extends('layouts.app')

@section('title', 'Nova Cobrança')

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

    .charge-preview{
        background: linear-gradient(
            135deg,
            rgba(239,68,68,.12),
            rgba(239,68,68,.04)
        );

        border: 1px solid rgba(239,68,68,.12);

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

        background: rgba(239,68,68,.15);

        color: #ef4444;

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
        color: #ef4444;
    }

    label{
        color: #d1d5db;
        font-weight: 700;
        margin-bottom: 8px;
    }

    .form-control,
    .form-select{
        background: #020617;
        border: 1px solid #1f2937;
        color: #fff;
        border-radius: 14px;
        padding: 13px 15px;
    }

    .form-control:focus,
    .form-select:focus{
        background: #020617;
        color: #fff;
        border-color: #ef4444;
        box-shadow: 0 0 0 .25rem rgba(239,68,68,.15);
    }

    .form-control::placeholder{
        color: #6b7280;
    }

    .form-select option{
        background: #111827;
        color: #fff;
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

    .form-hint{
        color: #6b7280;
        font-size: 13px;
        margin-top: 6px;
    }

    .payment-methods{
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 18px;
        margin-top: 8px;
    }

    .payment-card{
        background: #020617;
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 18px;
        padding: 20px;
        transition: .2s;
    }

    .payment-card:hover{
        transform: translateY(-2px);
        border-color: rgba(239,68,68,.25);
    }

    .payment-card i{
        font-size: 26px;
        color: #ef4444;
        margin-bottom: 14px;
    }

    .payment-card h5{
        color: #fff;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .payment-card p{
        color: #6b7280;
        font-size: 14px;
        margin: 0;
    }

    .actions{
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 30px;
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
        Nova Cobrança
    </h1>

    <p class="fit-page-subtitle">
        Gere mensalidades e cobranças para os alunos da academia.
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

    <div class="charge-preview">

        <div class="preview-label">
            Financeiro FitCloud
        </div>

        <div class="preview-title">
            Nova cobrança
        </div>

        <div class="preview-badge">

            <i class="bi bi-cash-stack"></i>

            PIX e boleto integrados

        </div>

    </div>

    <form action="{{ route('cobrancas.store') }}" method="POST">

        @csrf

        <div class="section-title">

            <i class="bi bi-person-fill"></i>

            Dados da cobrança

        </div>

        <div class="row g-4">

            <div class="col-md-6">

                <label>
                    Aluno
                </label>

                <select
                    name="matricula_id"
                    class="form-select @error('matricula_id') is-invalid @enderror"
                    required
                >

                    <option value="">
                        Selecione um aluno
                    </option>

                    @foreach($matriculas as $matricula)

                        <option value="{{ $matricula->id }}">

                            {{ $matricula->aluno->user->name }}

                        </option>

                    @endforeach

                </select>

                @error('matricula_id')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="col-md-3">

                <label>
                    Valor
                </label>

                <input
                    type="number"
                    step="0.01"
                    name="valor"
                    class="form-control @error('valor') is-invalid @enderror"
                    placeholder="Ex: 129.90"
                    required
                >

                @error('valor')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

            <div class="col-md-3">

                <label>
                    Vencimento
                </label>

                <input
                    type="date"
                    name="vencimento"
                    class="form-control @error('vencimento') is-invalid @enderror"
                    required
                >

                @error('vencimento')

                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>

                @enderror

            </div>

        </div>

        <div class="section-title mt-5">

            <i class="bi bi-credit-card-fill"></i>

            Métodos de pagamento disponíveis

        </div>

        <div class="payment-methods">

            <div class="payment-card">

                <i class="bi bi-qr-code"></i>

                <h5>
                    PIX Instantâneo
                </h5>

                <p>
                    Gere QR Code PIX automático com integração Asaas.
                </p>

            </div>

            <div class="payment-card">

                <i class="bi bi-upc-scan"></i>

                <h5>
                    Boleto Bancário
                </h5>

                <p>
                    Emissão automática de boletos via API.
                </p>

            </div>

        </div>

        <div class="actions">

            <button type="submit" class="btn btn-fit-primary">

                <i class="bi bi-check-circle-fill"></i>

                Criar Cobrança

            </button>

            <a href="{{ route('financeiro.index') }}" class="btn-fit-secondary">

                <i class="bi bi-arrow-left"></i>

                Voltar

            </a>

        </div>

    </form>

</div>

@endsection