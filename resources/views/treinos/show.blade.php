@extends('layouts.app')

@section('title', 'Ficha de Treino')

@section('content')

<style>
    .fit-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 28px;
    }

    .fit-title {
        color: #fff;
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .fit-subtitle {
        color: #9ca3af;
        margin: 0;
    }

    .info-card {
        background: linear-gradient(135deg, #111827, #020617);
        border: 1px solid rgba(255,255,255,.06);
        border-radius: 24px;
        padding: 28px;
        margin-bottom: 24px;
        box-shadow: 0 18px 45px rgba(0,0,0,.25);
    }

    .student-box {
        display: flex;
        align-items: center;
        gap: 18px;
    }

    .student-avatar {
        width: 70px;
        height: 70px;
        border-radius: 20px;
        background: rgba(239,68,68,.15);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 30px;
        font-weight: 800;
    }

    .student-name {
        color: #fff;
        font-size: 24px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .student-meta {
        color: #9ca3af;
        margin: 0;
    }

    .badge-fit {
        display: inline-block;
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        margin-top: 12px;
    }

    .badge-active {
        background: rgba(34,197,94,.15);
        color: #22c55e;
    }

    .badge-inactive {
        background: rgba(239,68,68,.15);
        color: #ef4444;
    }

    .fit-card {
        background: #111827;
        border-radius: 24px;
        padding: 28px;
        border: 1px solid rgba(255,255,255,.06);
        box-shadow: 0 20px 45px rgba(0,0,0,.25);
    }

    .section-title {
        color: #fff;
        font-size: 20px;
        font-weight: 800;
        margin-bottom: 20px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .section-title i {
        color: #ef4444;
    }

    .fit-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .fit-table thead th {
        color: #9ca3af;
        font-size: 13px;
        font-weight: 800;
        text-transform: uppercase;
        border: none;
        padding-bottom: 12px;
    }

    .fit-table tbody tr {
        background: #020617;
    }

    .fit-table tbody td {
        padding: 18px;
        color: #e5e7eb;
        border-top: 1px solid rgba(255,255,255,.04);
        border-bottom: 1px solid rgba(255,255,255,.04);
        vertical-align: middle;
    }

    .fit-table tbody td:first-child {
        border-left: 1px solid rgba(255,255,255,.04);
        border-top-left-radius: 16px;
        border-bottom-left-radius: 16px;
        font-weight: 800;
        color: #fff;
    }

    .fit-table tbody td:last-child {
        border-right: 1px solid rgba(255,255,255,.04);
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .muscle-badge {
        background: rgba(239,68,68,.13);
        color: #ef4444;
        padding: 7px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
    }

    .empty-box {
        text-align: center;
        color: #9ca3af;
        padding: 30px;
    }

    .action-buttons {
        display: flex;
        gap: 12px;
        flex-wrap: wrap;
        margin-top: 24px;
    }

    .btn-fit-primary {
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        border: none;
        color: #fff;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 800;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: .2s;
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

    @media(max-width: 992px) {
        .fit-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>

<div class="fit-header">
    <div>
        <h1 class="fit-title">Ficha de Treino</h1>
        <p class="fit-subtitle">
            Visualize os exercícios, séries, repetições e cargas do aluno.
        </p>
    </div>

    <a href="{{ route('treinos.pdf', $treino->id) }}" class="btn-fit-primary">
        <i class="bi bi-file-earmark-pdf-fill"></i>
        Baixar PDF
    </a>
</div>

<div class="info-card">
    <div class="student-box">
        <div class="student-avatar">
            {{ strtoupper(substr($treino->aluno->user->name ?? 'A', 0, 1)) }}
        </div>

        <div>
            <div class="student-name">
                {{ $treino->aluno->user->name ?? 'Aluno não encontrado' }}
            </div>

            <p class="student-meta">
                Treino {{ $treino->tipo }}
            </p>

            @if($treino->status == 'ativo')
                <span class="badge-fit badge-active">Ativo</span>
            @else
                <span class="badge-fit badge-inactive">{{ ucfirst($treino->status) }}</span>
            @endif
        </div>
    </div>
</div>

<div class="fit-card">
    <div class="section-title">
        <i class="bi bi-clipboard2-pulse-fill"></i>
        Exercícios cadastrados
    </div>

    <table class="fit-table">
        <thead>
            <tr>
                <th>Exercício</th>
                <th>Grupo Muscular</th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Carga</th>
            </tr>
        </thead>

        <tbody>
            @forelse($treino->itens as $item)
                <tr>
                    <td>{{ $item->exercicio->nome ?? 'Exercício removido' }}</td>
                    <td>
                        <span class="muscle-badge">
                            {{ $item->exercicio->grupo_muscular ?? '-' }}
                        </span>
                    </td>
                    <td>{{ $item->series }}</td>
                    <td>{{ $item->reps }}</td>
                    <td>{{ $item->carga ?? '-' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-box">
                            Nenhum exercício cadastrado neste treino.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<div class="action-buttons">
    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('treinos.index') }}" class="btn-fit-secondary">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    @else
        <a href="{{ route('home') }}" class="btn-fit-secondary">
            <i class="bi bi-arrow-left"></i>
            Voltar
        </a>
    @endif
</div>

@endsection