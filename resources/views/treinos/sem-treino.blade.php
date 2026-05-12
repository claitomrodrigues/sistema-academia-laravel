    @extends('layouts.app')

@section('title', 'Meu Treino')

@section('content')

<style>
    .empty-treino-card {
        background: linear-gradient(135deg, rgba(17,24,39,.96), rgba(3,7,18,.96));
        border: 1px solid rgba(255,255,255,.08);
        border-radius: 28px;
        padding: 50px 30px;
        text-align: center;
        box-shadow: 0 24px 60px rgba(0,0,0,.35);
        animation: fadeUp .6s ease both;
    }

    .empty-icon {
        width: 90px;
        height: 90px;
        border-radius: 28px;
        background: rgba(239,68,68,.15);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 42px;
        margin: 0 auto 24px;
        box-shadow: 0 18px 45px rgba(239,68,68,.20);
    }

    .empty-title {
        color: #fff;
        font-size: 32px;
        font-weight: 900;
        margin-bottom: 12px;
    }

    .empty-text {
        color: #9ca3af;
        max-width: 560px;
        margin: 0 auto;
        font-size: 16px;
        line-height: 1.7;
    }

    .empty-badge {
        display: inline-flex;
        margin-top: 24px;
        padding: 10px 18px;
        border-radius: 999px;
        background: rgba(239,68,68,.12);
        color: #fca5a5;
        border: 1px solid rgba(248,113,113,.25);
        font-weight: 800;
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
</style>

<div class="empty-treino-card">
    <div class="empty-icon">
        <i class="bi bi-clipboard-x"></i>
    </div>

    <h1 class="empty-title">
        Nenhum treino cadastrado ainda
    </h1>

    <p class="empty-text">
        Você ainda não possui uma ficha de treino ativa.
        Assim que o instrutor montar seu treino, ele aparecerá aqui automaticamente.
    </p>

    <div class="empty-badge">
        <i class="bi bi-hourglass-split me-2"></i>
        Aguardando instrutor
    </div>
</div>

@endsection