@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<style>
    .dashboard-page {
        animation: fadeUp .7s ease both;
    }

    .dashboard-banner {
    background:
        linear-gradient(
            90deg,
            rgba(7, 11, 22, .88) 0%,
            rgba(7, 11, 22, .72) 42%,
            rgba(7, 11, 22, .28) 100%
        ),
        url("{{ asset('img/logo.png') }}");
    background-size: contain;
    background-repeat: no-repeat;
    background-position: 150% center;
    background-color: #070b16;
    border-radius: 32px;
    padding: 70px;
    min-height: 420px;
    display: flex;
    align-items: center;
    position: relative;
    overflow: hidden;
    border: 1px solid rgba(255,255,255,.08);
    box-shadow: 0 30px 80px rgba(0,0,0,.45);
}

.dashboard-banner::after {
    content: '';
    position: relative;
    inset: 0;
    background: linear-gradient(
        90deg,
        rgba(0,0,0,.70) 0%,
        rgba(0,0,0,.35) 45%,
        rgba(0,0,0,.05) 100%
    );
    pointer-events: none;
}

    .dashboard-banner::before {
        content: '';
        position: absolute;
        width: 320px;
        height: 320px;
        right: -90px;
        top: -90px;
        background: rgba(239, 68, 68, .35);
        filter: blur(80px);
        border-radius: 50%;
        animation: pulseGlow 4s ease-in-out infinite;
    }

    .dashboard-banner::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(90deg, rgba(0,0,0,.75), rgba(0,0,0,.20));
    }

    .banner-content {
        position: relative;
        z-index: 2;
        max-width: 720px;
        animation: slideRight .8s ease both;
    }

    .banner-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(239, 68, 68, .18);
        color: #fecaca;
        padding: 9px 16px;
        border-radius: 999px;
        font-size: 13px;
        font-weight: 800;
        margin-bottom: 22px;
        border: 1px solid rgba(248, 113, 113, .35);
        letter-spacing: .08em;
    }

    .banner-title {
        font-size: clamp(38px, 5vw, 64px);
        font-weight: 900;
        color: #fff;
        margin-bottom: 20px;
        line-height: 1.05;
    }

    .banner-title span {
        background: linear-gradient(135deg, #f87171, #fb923c);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .banner-text {
        color: #e5e7eb;
        font-size: 18px;
        line-height: 1.8;
        margin-bottom: 32px;
    }

    .banner-actions {
        display: flex;
        gap: 14px;
        flex-wrap: wrap;
    }

    .banner-button {
        background: linear-gradient(135deg, #ef4444, #991b1b);
        color: #fff;
        padding: 15px 25px;
        border-radius: 16px;
        text-decoration: none;
        font-weight: 800;
        transition: .25s;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        box-shadow: 0 15px 35px rgba(239, 68, 68, .35);
    }

    .banner-button.secondary {
        background: rgba(255,255,255,.10);
        border: 1px solid rgba(255,255,255,.12);
        box-shadow: none;
        backdrop-filter: blur(10px);
    }

    .banner-button:hover {
        transform: translateY(-4px) scale(1.02);
        color: #fff;
    }

    .stats-grid {
        margin-top: 30px;
    }

    .stat-card {
        background: linear-gradient(180deg, rgba(17, 24, 39, .96), rgba(3, 7, 18, .96));
        border-radius: 28px;
        padding: 28px;
        border: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 20px 50px rgba(0,0,0,.35);
        height: 100%;
        position: relative;
        overflow: hidden;
        transition: .3s;
        animation: fadeUp .7s ease both;
    }

    .stat-card:nth-child(1) { animation-delay: .1s; }
    .stat-card:nth-child(2) { animation-delay: .2s; }
    .stat-card:nth-child(3) { animation-delay: .3s; }

    .stat-card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: radial-gradient(circle at top right, rgba(239, 68, 68, .22), transparent 35%);
        opacity: 0;
        transition: .3s;
    }

    .stat-card:hover {
        transform: translateY(-8px);
        border-color: rgba(248, 113, 113, .35);
    }

    .stat-card:hover::before {
        opacity: 1;
    }

    .stat-icon {
        width: 62px;
        height: 62px;
        border-radius: 20px;
        background: rgba(239, 68, 68, .15);
        color: #f87171;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 27px;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }

    .stat-title {
        color: #9ca3af;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: 8px;
        position: relative;
        z-index: 1;
    }

    .stat-value {
        color: #fff;
        font-size: 38px;
        font-weight: 900;
        position: relative;
        z-index: 1;
    }

    .stat-desc {
        color: #fca5a5;
        font-size: 14px;
        font-weight: 700;
        margin-top: 8px;
        position: relative;
        z-index: 1;
    }

    @keyframes fadeUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes slideRight {
        from {
            opacity: 0;
            transform: translateX(-30px);
        }
        to {
            opacity: 1;
            transform: translateX(0);
        }
    }

    @keyframes pulseGlow {
        0%, 100% {
            transform: scale(1);
            opacity: .7;
        }
        50% {
            transform: scale(1.15);
            opacity: 1;
        }
    }

    @media (max-width: 768px) {
    .dashboard-banner {
        padding: 36px 24px;
        min-height: 460px;
        background-size: 85%;
        background-position: center bottom;
    }

    .dashboard-banner::after {
        background: rgba(0,0,0,.68);
    }

    .banner-actions {
        flex-direction: column;
    }

    .banner-button {
        justify-content: center;
    }
}
</style>

<div class="dashboard-page">

    <div class="dashboard-banner">
        <div class="banner-content">

            <div class="banner-badge">
                <i class="bi bi-stars"></i>
                FITCLOUD • SISTEMA PREMIUM
            </div>

            <h1 class="banner-title">
                Transformando gestão em <span>performance</span>
            </h1>

            <p class="banner-text">
                Gerencie alunos, treinos, planos e pagamentos em uma plataforma moderna,
                inteligente e eficiente para academias de alta performance.
            </p>

           <div class="banner-actions">
    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('alunos.index') }}" class="banner-button">
            <i class="bi bi-people-fill"></i>
            Gerenciar alunos
        </a>

        <a href="{{ route('treinos.index') }}" class="banner-button secondary">
            <i class="bi bi-clipboard2-pulse-fill"></i>
            Ver treinos
        </a>
    @endif

    @if(auth()->user()->role === 'aluno')
        @if(auth()->user()->aluno)
            <a href="{{ route('meu.treino', auth()->user()->aluno->id) }}" class="banner-button">
                <i class="bi bi-clipboard-heart-fill"></i>
                Meu treino
            </a>
        @endif

        <a href="{{ route('minhas.faturas') }}" class="banner-button secondary">
            <i class="bi bi-receipt"></i>
            Minhas faturas
        </a>
    @endif
</div>

        </div>
    </div>

    <div class="row stats-grid g-4">

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-people-fill"></i>
                </div>

                <div class="stat-title">Alunos ativos</div>
                <div class="stat-value">120</div>
                <div class="stat-desc">+18% este mês</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-cash-stack"></i>
                </div>

                <div class="stat-title">Receita mensal</div>
                <div class="stat-value">R$ 12k</div>
                <div class="stat-desc">Pagamentos em dia</div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="stat-card">
                <div class="stat-icon">
                    <i class="bi bi-clipboard2-pulse-fill"></i>
                </div>

                <div class="stat-title">Treinos cadastrados</div>
                <div class="stat-value">86</div>
                <div class="stat-desc">Fichas ativas</div>
            </div>
        </div>

    </div>

</div>

@endsection