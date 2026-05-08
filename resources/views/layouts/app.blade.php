<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema Academia')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: #070b16;
            color: #e5e7eb;
            font-family: Arial, Helvetica, sans-serif;
        }

        body::before {
            content: '';
            position: fixed;
            inset: 0;
            z-index: -1;
            background:
                radial-gradient(circle at top left, rgba(239,68,68,.18), transparent 35%),
                radial-gradient(circle at bottom right, rgba(37,99,235,.14), transparent 30%);
        }

        .sidebar {
            width: 270px;
            min-height: 100vh;
            background: rgba(15, 23, 42, .88);
            backdrop-filter: blur(18px);
            position: fixed;
            left: 0;
            top: 0;
            padding: 8px 18px 24px;
            border-right: 1px solid rgba(255,255,255,.08);
            box-shadow: 20px 0 60px rgba(0,0,0,.35);
            animation: slideSidebar .6s ease both;
            display: flex;
            flex-direction: column;
        }

        .brand {
            text-decoration: none;
            display: flex;
            justify-content: center;
            height: 145px;
            margin-bottom: 4px;
            overflow: visible;
        }

        .brand-logo-box {
            position: relative;
            width: 270px;
            height: 145px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: visible;
        }

        .brand-logo-glow {
            position: absolute;
            width: 190px;
            height: 120px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(239,68,68,.35), transparent 70%);
            filter: blur(24px);
            animation: logoPulse 3s ease-in-out infinite;
        }

        .brand-logo {
            position: relative;
            z-index: 2;
            width: 270px;
            height: 270px;
            object-fit: contain;
            animation: logoFloat 4s ease-in-out infinite;
            filter:
                drop-shadow(0 0 12px rgba(239,68,68,.65))
                drop-shadow(0 0 26px rgba(239,68,68,.35));
            transition: .3s;
        }

        .brand-logo:hover {
            transform: scale(1.03);
        }

        .menu-link {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 13px;
            padding: 13px 15px;
            border-radius: 16px;
            margin-bottom: 9px;
            font-weight: 700;
            position: relative;
            overflow: hidden;
            transition: .25s;
        }

        .menu-link i {
            font-size: 18px;
            color: #f87171;
            transition: .25s;
        }

        .menu-link::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, #ef4444, #991b1b);
            opacity: 0;
            transition: .25s;
            z-index: -1;
        }

        .menu-link:hover {
            color: #fff;
            transform: translateX(6px);
        }

        .menu-link:hover::before,
        .menu-link.active::before {
            opacity: 1;
        }

        .menu-link:hover i,
        .menu-link.active i {
            color: #fff;
        }

        .menu-link.active {
            color: #fff;
            box-shadow: 0 14px 35px rgba(239,68,68,.35);
            transform: translateX(6px);
        }

        .menu-link.active::after {
            content: '';
            position: absolute;
            right: 12px;
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #fff;
            box-shadow: 0 0 14px #fff;
        }

        .logout-box {
            margin-top: 30px;
            padding-top: 18px;
            border-top: 1px solid rgba(255,255,255,.08);
        }

        .btn-danger {
            background: linear-gradient(135deg, #ef4444, #991b1b);
            border: none;
            border-radius: 14px;
            font-weight: 800;
            padding: 12px;
            box-shadow: 0 12px 30px rgba(239,68,68,.25);
            transition: .25s;
        }

        .btn-danger:hover {
            transform: translateY(-3px);
            box-shadow: 0 18px 40px rgba(239,68,68,.38);
        }

        .content {
            margin-left: 270px;
            padding: 30px;
            animation: fadeUp .55s ease both;
        }

        .topbar {
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 24px;
            padding: 20px 24px;
            box-shadow: 0 18px 50px rgba(0,0,0,.28);
            margin-bottom: 26px;
            animation: fadeDown .6s ease both;
        }

        .topbar h4 {
            color: #fff;
            font-weight: 900;
        }

        .topbar small {
            color: #94a3b8 !important;
        }

        .role-badge {
            background: rgba(239,68,68,.15);
            color: #fca5a5;
            border: 1px solid rgba(248,113,113,.28);
            border-radius: 999px;
            font-weight: 800;
        }

        .page-card {
            background: rgba(255,255,255,.08);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 24px;
            padding: 24px;
            box-shadow: 0 18px 50px rgba(0,0,0,.28);
        }

        .alert {
            border: 0;
            animation: fadeDown .4s ease both;
        }

        .table {
            vertical-align: middle;
        }

        .form-control,
        .form-select {
            border-radius: 12px;
            padding: 11px 13px;
        }

        @keyframes slideSidebar {
            from {
                opacity: 0;
                transform: translateX(-35px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes fadeUp {
            from {
                opacity: 0;
                transform: translateY(22px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeDown {
            from {
                opacity: 0;
                transform: translateY(-18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-6px);
            }
        }

        @keyframes logoPulse {
            0%, 100% {
                opacity: .5;
                transform: scale(1);
            }

            50% {
                opacity: .9;
                transform: scale(1.08);
            }
        }

        @media (max-width: 992px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .brand {
                height: 120px;
            }

            .brand-logo-box {
                height: 120px;
            }

            .brand-logo {
                width: 200px;
                height: 200px;
            }

            .content {
                margin-left: 0;
                padding: 18px;
            }
        }
    </style>
</head>

<body>

@auth
<aside class="sidebar">
    <a href="{{ route('home') }}" class="brand">
        <div class="brand-logo-box">
            <div class="brand-logo-glow"></div>
            <img src="{{ asset('img/logo.png') }}" alt="FitCloud" class="brand-logo">
        </div>
    </a>

    <a class="menu-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">
        <i class="bi bi-grid-1x2-fill"></i> Dashboard
    </a>

    @if(auth()->user()->role === 'instrutor')
        <a class="menu-link {{ request()->routeIs('alunos.*') ? 'active' : '' }}" href="{{ route('alunos.index') }}">
            <i class="bi bi-people-fill"></i> Alunos
        </a>

        <a class="menu-link {{ request()->routeIs('planos.*') ? 'active' : '' }}" href="{{ route('planos.index') }}">
            <i class="bi bi-card-checklist"></i> Planos
        </a>

        <a class="menu-link {{ request()->routeIs('exercicios.*') ? 'active' : '' }}" href="{{ route('exercicios.index') }}">
            <i class="bi bi-lightning-charge-fill"></i> Exercícios
        </a>

        <a class="menu-link {{ request()->routeIs('treinos.*') ? 'active' : '' }}" href="{{ route('treinos.index') }}">
            <i class="bi bi-clipboard2-pulse-fill"></i> Treinos
        </a>

        <a class="menu-link {{ request()->routeIs('financeiro.*') ? 'active' : '' }}" href="{{ route('financeiro.index') }}">
            <i class="bi bi-cash-coin"></i> Financeiro
        </a>
    @endif

    @if(auth()->user()->role === 'aluno')
        @if(auth()->user()->aluno)
            <a class="menu-link {{ request()->routeIs('meu.treino') ? 'active' : '' }}" href="{{ route('meu.treino', auth()->user()->aluno->id) }}">
                <i class="bi bi-clipboard-heart-fill"></i> Meu Treino
            </a>
        @endif

        <a class="menu-link {{ request()->routeIs('minhas.faturas') ? 'active' : '' }}" href="{{ route('minhas.faturas') }}">
            <i class="bi bi-receipt"></i> Minhas Faturas
        </a>
    @endif

    <div class="logout-box">
        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button class="btn btn-danger w-100">
                <i class="bi bi-box-arrow-right"></i> Sair
            </button>
        </form>
    </div>
</aside>
@endauth

<main class="content">
    @auth
        <div class="topbar d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0">@yield('title', 'Dashboard')</h4>
                <small>Bem-vindo ao painel do sistema</small>
            </div>

            <span class="role-badge px-3 py-2">
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </div>
    @endauth

    @if(session('success'))
        <div class="alert alert-success rounded-4">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-4">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>