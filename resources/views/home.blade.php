@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@php
    $totalAlunos = class_exists('App\\Models\\Aluno') ? \App\Models\Aluno::count() : 0;
    $totalPlanos = class_exists('App\\Models\\Plano') ? \App\Models\Plano::count() : 0;
    $totalTreinos = class_exists('App\\Models\\Treino') ? \App\Models\Treino::count() : 0;
    $presencasHoje = class_exists('App\\Models\\Presenca') ? \App\Models\Presenca::whereDate('data_presenca', now()->toDateString())->count() : 0;
@endphp

<style>
    .dashboard-page{animation:fadeUp .7s ease both}.hero-panel{background:linear-gradient(135deg,rgba(15,23,42,.98),rgba(3,7,18,.98));border:1px solid rgba(255,255,255,.08);border-radius:30px;padding:42px;position:relative;overflow:hidden;box-shadow:0 28px 70px rgba(0,0,0,.38);margin-bottom:28px}.hero-panel::before{content:'';position:absolute;width:360px;height:360px;right:-90px;top:-140px;border-radius:50%;background:rgba(34,197,94,.22);filter:blur(70px)}.hero-panel::after{content:'';position:absolute;width:280px;height:280px;left:25%;bottom:-170px;border-radius:50%;background:rgba(59,130,246,.16);filter:blur(75px)}.hero-content{position:relative;z-index:2}.hero-badge{display:inline-flex;align-items:center;gap:8px;background:rgba(34,197,94,.14);color:#86efac;border:1px solid rgba(34,197,94,.22);padding:9px 15px;border-radius:999px;font-size:12px;font-weight:900;letter-spacing:.08em;text-transform:uppercase;margin-bottom:18px}.hero-title{font-size:clamp(34px,4vw,54px);font-weight:900;line-height:1.05;color:#fff;margin-bottom:16px}.hero-title span{background:linear-gradient(135deg,#4ade80,#60a5fa);-webkit-background-clip:text;-webkit-text-fill-color:transparent}.hero-text{color:#cbd5e1;font-size:17px;line-height:1.75;max-width:760px;margin-bottom:26px}.hero-actions{display:flex;gap:13px;flex-wrap:wrap}.hero-btn{background:linear-gradient(135deg,#22c55e,#15803d);color:#fff;border-radius:16px;padding:14px 21px;text-decoration:none;font-weight:900;display:inline-flex;align-items:center;gap:10px;transition:.25s;box-shadow:0 15px 35px rgba(34,197,94,.22)}.hero-btn.secondary{background:rgba(255,255,255,.08);border:1px solid rgba(255,255,255,.12);box-shadow:none}.hero-btn:hover{color:#fff;transform:translateY(-3px)}.stats-grid{margin-bottom:28px}.stat-card{background:linear-gradient(180deg,rgba(17,24,39,.96),rgba(3,7,18,.96));border-radius:24px;padding:24px;border:1px solid rgba(255,255,255,.08);box-shadow:0 20px 45px rgba(0,0,0,.26);height:100%;position:relative;overflow:hidden;transition:.25s}.stat-card:hover{transform:translateY(-5px);border-color:rgba(34,197,94,.28)}.stat-icon{width:58px;height:58px;border-radius:18px;background:rgba(34,197,94,.14);color:#4ade80;display:flex;align-items:center;justify-content:center;font-size:26px;margin-bottom:18px}.stat-title{color:#9ca3af;font-size:12px;font-weight:900;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px}.stat-value{color:#fff;font-size:36px;font-weight:900}.stat-desc{color:#86efac;font-size:13px;font-weight:800;margin-top:6px}.feature-card{background:rgba(17,24,39,.92);border:1px solid rgba(255,255,255,.08);border-radius:24px;padding:28px;box-shadow:0 20px 45px rgba(0,0,0,.24)}.feature-title{color:#fff;font-size:22px;font-weight:900;margin-bottom:10px}.feature-text{color:#9ca3af;line-height:1.7;margin:0}.feature-item{display:flex;gap:14px;align-items:flex-start;padding:16px 0;border-bottom:1px solid rgba(255,255,255,.07)}.feature-item:last-child{border-bottom:none}.feature-item i{color:#4ade80;font-size:24px}.feature-item strong{display:block;color:#fff}.feature-item span{color:#94a3b8;font-size:14px}@keyframes fadeUp{from{opacity:0;transform:translateY(24px)}to{opacity:1;transform:translateY(0)}}
</style>

<div class="dashboard-page">
    <section class="hero-panel">
        <div class="hero-content">
            <div class="hero-badge"><i class="bi bi-stars"></i>Atualização</div>
            <h1 class="hero-title">Fit<span>Cloud</span></h1>
            <p class="hero-text">Sua academia conectada ao futuro.</p>
            <div class="hero-actions">
                @if(auth()->user()->role === 'instrutor')
                    <a href="{{ route('presencas.index') }}" class="hero-btn"><i class="bi bi-calendar2-check-fill"></i> Controle de presenças</a>
                    <a href="{{ route('alunos.index') }}" class="hero-btn secondary"><i class="bi bi-people-fill"></i> Gerenciar alunos</a>
                @endif
                @if(auth()->user()->role === 'aluno')
                    @if(auth()->user()->aluno)
                        <a href="{{ route('meu.treino', auth()->user()->aluno->id) }}" class="hero-btn"><i class="bi bi-clipboard-heart-fill"></i> Meu treino</a>
                    @endif
                    <a href="{{ route('minhas.faturas') }}" class="hero-btn secondary"><i class="bi bi-receipt"></i> Minhas faturas</a>
                @endif
            </div>
        </div>
    </section>

    <div class="row stats-grid g-4">
        <div class="col-md-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-people-fill"></i></div><div class="stat-title">Alunos</div><div class="stat-value">{{ $totalAlunos }}</div><div class="stat-desc">Cadastrados no sistema</div></div></div>
        <div class="col-md-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-card-checklist"></i></div><div class="stat-title">Planos</div><div class="stat-value">{{ $totalPlanos }}</div><div class="stat-desc">Planos disponíveis</div></div></div>
        <div class="col-md-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-clipboard2-pulse-fill"></i></div><div class="stat-title">Treinos</div><div class="stat-value">{{ $totalTreinos }}</div><div class="stat-desc">Fichas cadastradas</div></div></div>
        <div class="col-md-3"><div class="stat-card"><div class="stat-icon"><i class="bi bi-calendar-check-fill"></i></div><div class="stat-title">Presenças hoje</div><div class="stat-value">{{ $presencasHoje }}</div><div class="stat-desc">Nova funcionalidade</div></div></div>
    </div>
</div>
@endsection
