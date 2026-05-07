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
            background: #f4f6f9;
            color: #1f2937;
            font-family: Arial, Helvetica, sans-serif;
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: #111827;
            position: fixed;
            left: 0;
            top: 0;
            padding: 24px 18px;
        }

        .brand {
            color: #fff;
            font-size: 22px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 35px;
        }

        .brand span {
            color: #ef4444;
        }

        .menu-link {
            color: #cbd5e1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 8px;
            transition: 0.2s;
        }

        .menu-link:hover,
        .menu-link.active {
            background: #ef4444;
            color: #fff;
        }

        .content {
            margin-left: 260px;
            padding: 28px;
        }

        .topbar {
            background: #fff;
            border-radius: 18px;
            padding: 18px 22px;
            box-shadow: 0 10px 25px rgba(0,0,0,.06);
            margin-bottom: 24px;
        }

        .page-card {
            background: #fff;
            border-radius: 18px;
            padding: 24px;
            box-shadow: 0 10px 25px rgba(0,0,0,.06);
        }

        .btn-danger {
            background: #ef4444;
            border: none;
            border-radius: 10px;
            font-weight: 600;
        }

        .btn-danger:hover {
            background: #dc2626;
        }

        .table {
            vertical-align: middle;
        }

        .table thead {
            background: #f1f5f9;
        }

        .form-control,
        .form-select {
            border-radius: 10px;
            padding: 10px 12px;
        }

        @media (max-width: 992px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
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
        <i class="bi bi-activity"></i>
        Sistema <span>Academia</span>
    </a>

    @if(auth()->user()->role === 'instrutor')
        <a class="menu-link" href="{{ route('alunos.index') }}">
            <i class="bi bi-people"></i> Alunos
        </a>

        <a class="menu-link" href="{{ route('planos.index') }}">
            <i class="bi bi-card-checklist"></i> Planos
        </a>

        <a class="menu-link" href="{{ route('exercicios.index') }}">
            <i class="bi bi-lightning-charge"></i> Exercícios
        </a>

        <a class="menu-link" href="{{ route('treinos.index') }}">
            <i class="bi bi-clipboard2-pulse"></i> Treinos
        </a>

        <a class="menu-link" href="{{ route('financeiro.index') }}">
            <i class="bi bi-cash-coin"></i> Financeiro
        </a>
    @endif

    @if(auth()->user()->role === 'aluno')
        @if(auth()->user()->aluno)
            <a class="menu-link" href="{{ route('meu.treino', auth()->user()->aluno->id) }}">
                <i class="bi bi-clipboard-heart"></i> Meu Treino
            </a>
        @endif

        <a class="menu-link" href="{{ route('minhas.faturas') }}">
            <i class="bi bi-receipt"></i> Minhas Faturas
        </a>
    @endif

    <form method="POST" action="{{ route('logout') }}" class="mt-4">
        @csrf
        <button class="btn btn-danger w-100">
            <i class="bi bi-box-arrow-right"></i> Sair
        </button>
    </form>
</aside>
@endauth

<main class="content">
    @auth
        <div class="topbar d-flex justify-content-between align-items-center">
            <div>
                <h4 class="mb-0">@yield('title', 'Dashboard')</h4>
                <small class="text-muted">Bem-vindo ao painel do sistema</small>
            </div>

            <span class="badge bg-danger-subtle text-danger px-3 py-2">
                {{ ucfirst(auth()->user()->role) }}
            </span>
        </div>
    @endauth

    @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>