<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema Academia')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
        :root {
            --cg-primary: #16A34A;
            --cg-primary-hover: #15803D;
            --cg-primary-soft: rgba(22, 163, 74, .09);
            --cg-sidebar: #0F172A;
            --cg-sidebar-2: #111827;
            --cg-bg: #F8FAFC;
            --cg-card: #FFFFFF;
            --cg-border: #E5E7EB;
            --cg-border-soft: #F1F5F9;
            --cg-text: #334155;
            --cg-muted: #64748B;
            --cg-title: #0F172A;
            --cg-danger: #DC2626;
        }

        * { box-sizing: border-box; }

        body {
            background: var(--cg-bg);
            color: var(--cg-text);
            font-family: Inter, Arial, Helvetica, sans-serif;
            min-height: 100vh;
        }

        body::before { display: none; }

        .sidebar {
            width: 270px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--cg-sidebar), var(--cg-sidebar-2));
            position: fixed;
            left: 0;
            top: 0;
            padding: 22px 16px;
            border-right: 1px solid rgba(255,255,255,.06);
            box-shadow: none;
            display: flex;
            flex-direction: column;
        }

        .brand {
            text-decoration: none;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 108px;
            margin-bottom: 18px;
        }

        .brand-logo-box { width: 150px; height: 95px; display:flex; align-items:center; justify-content:center; }
        .brand-logo-glow { display:none; }
        .brand-logo { width: 190px; height: 190px; object-fit: contain; filter: none; transition:.2s; }
        .brand-logo:hover { transform: scale(1.02); }

        .menu-link {
            color: #CBD5E1;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 14px;
            border-radius: 12px;
            margin-bottom: 6px;
            font-weight: 600;
            font-size: 14px;
            transition: .18s;
        }

        .menu-link i { font-size: 17px; color: #94A3B8; transition:.18s; }
        .menu-link::before, .menu-link::after { display:none; }
        .menu-link:hover { color: #fff; background: rgba(255,255,255,.07); transform:none; }
        .menu-link:hover i { color:#fff; }
        .menu-link.active {
            color: #fff;
            background: var(--cg-primary);
            box-shadow: none;
            transform:none;
        }
        .menu-link.active i { color:#fff; }

        .logout-box { margin-top:auto; padding-top:18px; border-top:1px solid rgba(255,255,255,.08); }
        .btn-fit-logout {
            background: rgba(255,255,255,.06);
            border: 1px solid rgba(255,255,255,.10);
            color: #E2E8F0;
            border-radius: 12px;
            font-weight: 800;
            padding: 11px 14px;
            transition:.18s;
        }
        .btn-fit-logout:hover { background: rgba(220,38,38,.16); color:#fff; border-color: rgba(220,38,38,.28); }

        .content { margin-left: 270px; padding: 28px; }

        .topbar {
            background: var(--cg-card);
            border: 1px solid var(--cg-border);
            border-radius: 16px;
            padding: 16px 20px;
            box-shadow: 0 8px 22px rgba(15,23,42,.035);
            margin-bottom: 24px;
        }
        .topbar h4 { color: var(--cg-title); font-weight: 900; }
        .topbar small { color: var(--cg-muted) !important; }
        .role-badge {
            background: var(--cg-primary-soft);
            color: var(--cg-primary-hover);
            border: 1px solid rgba(22,163,74,.16);
            border-radius: 999px;
            font-weight: 800;
        }

        .page-card, .fit-card, .feature-card, .stat-card, .form-card, .content-card {
            background: var(--cg-card) !important;
            color: var(--cg-text) !important;
            border: 1px solid var(--cg-border) !important;
            border-radius: 16px !important;
            box-shadow: 0 8px 22px rgba(15,23,42,.04) !important;
        }

        .form-control, .form-select {
            border-radius: 12px;
            padding: 11px 13px;
            background: #fff !important;
            color: var(--cg-text) !important;
            border: 1px solid var(--cg-border) !important;
        }
        .form-control:focus, .form-select:focus {
            border-color: var(--cg-primary) !important;
            box-shadow: 0 0 0 .18rem rgba(22,163,74,.10) !important;
        }

        .fit-toast { position: fixed; top: 25px; right: 25px; min-width: 320px; padding: 16px 20px; border-radius: 16px; pointer-events: none; color: white; font-weight: 700; z-index: 9999; box-shadow: 0 18px 40px rgba(15,23,42,.18); }
        .success-toast { background: linear-gradient(135deg, #16A34A, #15803D); border-left: 5px solid #BBF7D0; }
        .error-toast { background: linear-gradient(135deg, #DC2626, #991B1B); border-left: 5px solid #FECACA; }

        .alert-danger { background:#FEF2F2; color:#991B1B; border:1px solid #FECACA; }
        .alert-success { background:#F0FDF4; color:#166534; border:1px solid #BBF7D0; }

        @media (max-width: 992px) {
            .sidebar { position: relative; width: 100%; min-height: auto; }
            .brand { min-height: 100px; }
            .brand-logo { width: 150px; height: 150px; }
            .content { margin-left: 0; padding: 18px; }
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

        <a class="menu-link {{ request()->routeIs('presencas.*') ? 'active' : '' }}" href="{{ route('presencas.index') }}">
            <i class="bi bi-calendar2-check-fill"></i> Presenças
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

            <button class="btn btn-fit-logout w-100">
                <i class="bi bi-box-arrow-right"></i> Sair
            </button>
        </form>
    </div>
</aside>
@endauth

<main class="content">

    @if(session('success'))
        <div class="fit-toast success-toast">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-check-circle-fill"></i>
                <span>{{ session('success') }}</span>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fit-toast error-toast">
            <div class="d-flex align-items-center gap-2">
                <i class="bi bi-x-circle-fill"></i>
                <span>{{ session('error') }}</span>
            </div>
        </div>
    @endif

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

    @yield('content')

<style>
    /* Padronização visual inspirada em SaaS moderno: interface limpa, branca e com verde apenas em pontos de destaque. */
    .fit-title, .fit-page-title, .feature-title, .student-info strong, .preview-title, .section-title,
    .stat-value, .hero-title, h1, h2, h3, h4, h5 {
        color: var(--cg-title) !important;
        letter-spacing: -.02em;
    }

    .fit-subtitle, .fit-page-subtitle, .feature-text, .muted-text, .student-info small,
    .stat-title, .stat-desc, .form-hint, .preview-label, .empty-box {
        color: var(--cg-muted) !important;
    }

    .fit-header {
        margin-bottom: 28px !important;
        align-items: center !important;
    }

    .fit-title, .fit-page-title {
        font-size: clamp(26px, 2.4vw, 34px) !important;
        font-weight: 800 !important;
        margin-bottom: 6px !important;
    }

    .fit-subtitle, .fit-page-subtitle {
        font-size: 15px !important;
        line-height: 1.6 !important;
        margin: 0 !important;
    }

    .hero-panel, .fit-card, .page-card, .feature-card, .stat-card, .form-card, .content-card,
    .info-card, .empty-treino-card, .payment-card, .exercise-check-card {
        background: var(--cg-card) !important;
        color: var(--cg-text) !important;
        border: 1px solid var(--cg-border) !important;
        border-radius: 16px !important;
        box-shadow: 0 8px 22px rgba(15, 23, 42, .04) !important;
        text-shadow: none !important;
    }

    .fit-card, .page-card, .feature-card, .form-card, .content-card {
        padding: 24px !important;
    }

    .hero-panel {
        padding: 28px !important;
        margin-bottom: 28px !important;
    }

    .hero-panel::before, .hero-panel::after,
    .fit-card::before, .fit-card::after,
    .empty-treino-card::before, .empty-treino-card::after {
        display: none !important;
    }

    .hero-title span {
        color: var(--cg-primary) !important;
        background: none !important;
        -webkit-text-fill-color: initial !important;
    }

    .hero-badge, .preview-badge, .goal-badge, .price-badge, .status-paid {
        background: var(--cg-primary-soft) !important;
        color: var(--cg-primary-hover) !important;
        border: 1px solid rgba(22, 163, 74, .14) !important;
        box-shadow: none !important;
    }

    .status-pending {
        background: #FFFBEB !important;
        color: #92400E !important;
        border: 1px solid #FDE68A !important;
    }

    .hero-btn, .btn-fit-primary, .btn-login, .btn-paid, .btn-pix, .btn-copy-pix {
        background: var(--cg-primary) !important;
        color: #fff !important;
        border: 1px solid var(--cg-primary) !important;
        border-radius: 10px !important;
        box-shadow: none !important;
        font-weight: 700 !important;
        padding: 10px 16px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        text-decoration: none !important;
        transition: .16s ease !important;
    }

    .hero-btn:hover, .btn-fit-primary:hover, .btn-login:hover, .btn-paid:hover, .btn-pix:hover, .btn-copy-pix:hover {
        background: var(--cg-primary-hover) !important;
        border-color: var(--cg-primary-hover) !important;
        color: #fff !important;
        transform: translateY(-1px) !important;
    }

    .hero-btn.secondary, .btn-fit-secondary, .btn-outline-secondary, .btn-boleto, .btn-view, .btn-pdf {
        background: #fff !important;
        color: var(--cg-text) !important;
        border: 1px solid var(--cg-border) !important;
        border-radius: 10px !important;
        box-shadow: none !important;
        font-weight: 700 !important;
        padding: 10px 16px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        text-decoration: none !important;
    }

    .hero-btn.secondary:hover, .btn-fit-secondary:hover, .btn-outline-secondary:hover, .btn-boleto:hover, .btn-view:hover, .btn-pdf:hover {
        background: #F8FAFC !important;
        color: var(--cg-title) !important;
        border-color: #CBD5E1 !important;
        transform: none !important;
    }

    .btn-fit-action {
        border-radius: 10px !important;
        padding: 8px 12px !important;
        font-size: 13px !important;
        font-weight: 700 !important;
        box-shadow: none !important;
    }

    .btn-edit {
        background: #F8FAFC !important;
        color: var(--cg-text) !important;
        border: 1px solid var(--cg-border) !important;
    }
    .btn-edit:hover {
        background: #F1F5F9 !important;
        color: var(--cg-title) !important;
    }

    .btn-delete {
        background: #fff !important;
        color: #B91C1C !important;
        border: 1px solid #FECACA !important;
    }
    .btn-delete:hover {
        background: #FEF2F2 !important;
        color: #991B1B !important;
        border-color: #FCA5A5 !important;
    }

    .stat-card {
        padding: 22px !important;
        height: 100% !important;
    }

    .stat-icon, .student-avatar, .preview-icon, .feature-icon {
        background: var(--cg-primary-soft) !important;
        color: var(--cg-primary) !important;
        border: 1px solid rgba(22, 163, 74, .12) !important;
        box-shadow: none !important;
    }

    .stat-title {
        font-size: 12px !important;
        text-transform: uppercase !important;
        font-weight: 700 !important;
        letter-spacing: .05em !important;
    }

    .stat-value {
        font-size: 32px !important;
        font-weight: 800 !important;
    }

    .fit-table {
        border-collapse: collapse !important;
        border-spacing: 0 !important;
        width: 100% !important;
        background: #fff !important;
    }

    .fit-table thead th {
        color: var(--cg-muted) !important;
        background: #F8FAFC !important;
        padding: 14px 16px !important;
        border: 0 !important;
        border-bottom: 1px solid var(--cg-border) !important;
        font-size: 12px !important;
        font-weight: 700 !important;
        text-transform: uppercase !important;
        letter-spacing: .04em !important;
    }

    .fit-table tbody tr {
        background: #fff !important;
        border-bottom: 1px solid var(--cg-border-soft) !important;
        transition: .16s ease !important;
    }

    .fit-table tbody tr:hover {
        background: #F8FAFC !important;
        transform: none !important;
    }

    .fit-table tbody td {
        color: var(--cg-text) !important;
        background: transparent !important;
        border: 0 !important;
        border-bottom: 1px solid var(--cg-border-soft) !important;
        padding: 15px 16px !important;
        vertical-align: middle !important;
    }

    .fit-table tbody td:first-child, .fit-table tbody td:last-child {
        border-radius: 0 !important;
    }

    .form-control, .form-select, textarea {
        min-height: 44px !important;
        border-radius: 10px !important;
        border: 1px solid var(--cg-border) !important;
        background: #fff !important;
        color: var(--cg-text) !important;
        box-shadow: none !important;
    }

    .form-control:focus, .form-select:focus, textarea:focus {
        border-color: var(--cg-primary) !important;
        box-shadow: 0 0 0 .18rem rgba(22, 163, 74, .10) !important;
    }

    label, .form-label, .date-box, .feature-item strong, .payment-method {
        color: var(--cg-text) !important;
        font-weight: 700 !important;
    }

    .feature-item {
        border-bottom: 1px solid var(--cg-border-soft) !important;
    }

    .feature-item i, .section-title i, .input-icon, .payment-method i {
        color: var(--cg-primary) !important;
    }

    .cpf-badge, .goal-badge, .role-badge {
        background: #F8FAFC !important;
        color: var(--cg-text) !important;
        border: 1px solid var(--cg-border) !important;
    }

    .payment-box, .exercise-fields {
        background: #F8FAFC !important;
        border: 1px solid var(--cg-border) !important;
        border-radius: 14px !important;
    }

    .pix-textarea {
        background: #fff !important;
        color: var(--cg-text) !important;
        border: 1px solid var(--cg-border) !important;
    }

    .action-group, .hero-actions {
        gap: 8px !important;
    }

    .alert-danger {
        background: #FEF2F2 !important;
        color: #991B1B !important;
        border: 1px solid #FECACA !important;
    }

    .alert-success {
        background: #F0FDF4 !important;
        color: #166534 !important;
        border: 1px solid #BBF7D0 !important;
    }

    .is-invalid { border-color: #DC2626 !important; }
    .invalid-feedback { color: #B91C1C !important; }

    .text-danger { color: var(--cg-primary) !important; }
</style>

</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html> 