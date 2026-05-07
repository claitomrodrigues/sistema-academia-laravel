@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-banner {
        background:
            linear-gradient(
                135deg,
                rgba(239, 68, 68, .15),
                rgba(15, 23, 42, .95)
            ),
            url("{{ asset('img/logo.png') }}");
        background-size: cover;
        background-position: center;
        border-radius: 24px;
        padding: 60px;
        min-height: 320px;
        display: flex;
        align-items: center;
        position: relative;
        overflow: hidden;
        border: 1px solid rgba(255,255,255,.05);
    }

    .dashboard-banner::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0,0,0,.55);
    }

    .banner-content {
        position: relative;
        z-index: 2;
        max-width: 650px;
    }

    .banner-badge {
        display: inline-block;
        background: rgba(239, 68, 68, .18);
        color: #ef4444;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 20px;
        border: 1px solid rgba(239, 68, 68, .25);
    }

    .banner-title {
        font-size: 48px;
        font-weight: 800;
        color: #fff;
        margin-bottom: 18px;
        line-height: 1.1;
    }

    .banner-title span {
        color: #ef4444;
    }

    .banner-text {
        color: #d1d5db;
        font-size: 17px;
        line-height: 1.7;
        margin-bottom: 28px;
    }

    .banner-button {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        border: none;
        color: #fff;
        padding: 14px 24px;
        border-radius: 14px;
        text-decoration: none;
        font-weight: 700;
        transition: .2s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
    }

    .banner-button:hover {
        transform: translateY(-2px);
        box-shadow: 0 15px 35px rgba(239, 68, 68, .35);
        color: #fff;
    }

    .stats-grid {
        margin-top: 28px;
    }

    .stat-card {
        background: #111827;
        border-radius: 22px;
        padding: 24px;
        border: 1px solid rgba(255,255,255,.05);
        box-shadow: 0 15px 40px rgba(0,0,0,.25);
        height: 100%;
    }

    .stat-icon {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        background: rgba(239, 68, 68, .15);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-bottom: 18px;
    }

    .stat-title {
        color: #9ca3af;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-value {
        color: #fff;
        font-size: 32px;
        font-weight: 800;
    }
</style>

<div class="dashboard-banner">
    <div class="banner-content">

        <div class="banner-badge">
            FITCLOUD • SISTEMA PREMIUM
        </div>

        <h1 class="banner-title">
            Transformando gestão em <span>performance</span>
        </h1>

        <p class="banner-text">
            Gerencie alunos, treinos, planos e pagamentos
            em uma plataforma moderna, inteligente e eficiente
            para academias de alta performance.
        </p>

        <a href="{{ route('alunos.index') }}" class="banner-button">
            <i class="bi bi-people-fill"></i>
            Gerenciar alunos
        </a>

    </div>
</div>

<div class="row stats-grid g-4">

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-people-fill"></i>
            </div>

            <div class="stat-title">
                Alunos ativos
            </div>

            <div class="stat-value">
                120
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-cash-stack"></i>
            </div>

            <div class="stat-title">
                Receita mensal
            </div>

            <div class="stat-value">
                R$ 12k
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="stat-card">
            <div class="stat-icon">
                <i class="bi bi-clipboard2-pulse-fill"></i>
            </div>

            <div class="stat-title">
                Treinos cadastrados
            </div>

            <div class="stat-value">
                86
            </div>
        </div>
    </div>

</div>

@endsection