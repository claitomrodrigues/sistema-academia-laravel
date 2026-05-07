@extends('layouts.app')

@section('title', 'Treinos')

@section('content')

<style>

    .fit-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 28px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .fit-title{
        color: #fff;
        font-size: 34px;
        font-weight: 800;
        margin-bottom: 6px;
    }

    .fit-subtitle{
        color: #9ca3af;
        margin: 0;
    }

    .fit-card{
        background: #111827;
        border-radius: 24px;
        padding: 28px;
        border: 1px solid rgba(255,255,255,.06);
        box-shadow: 0 20px 45px rgba(0,0,0,.25);
    }

    .btn-fit-primary{
        background: linear-gradient(135deg, #ef4444, #b91c1c);
        border: none;
        color: #fff;
        border-radius: 14px;
        padding: 12px 20px;
        font-weight: 700;
        transition: .2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }

    .btn-fit-primary:hover{
        transform: translateY(-1px);
        color: #fff;
        box-shadow: 0 14px 30px rgba(239,68,68,.30);
    }

    .fit-table{
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 14px;
    }

    .fit-table thead th{
        color: #9ca3af;
        font-size: 13px;
        font-weight: 700;
        text-transform: uppercase;
        border: none;
        padding-bottom: 14px;
    }

    .fit-table tbody tr{
        background: #020617;
        transition: .2s;
    }

    .fit-table tbody tr:hover{
        transform: scale(1.01);
    }

    .fit-table tbody td{
        padding: 20px 18px;
        border-top: 1px solid rgba(255,255,255,.04);
        border-bottom: 1px solid rgba(255,255,255,.04);
        color: #e5e7eb;
        vertical-align: middle;
    }

    .fit-table tbody td:first-child{
        border-left: 1px solid rgba(255,255,255,.04);
        border-top-left-radius: 16px;
        border-bottom-left-radius: 16px;
    }

    .fit-table tbody td:last-child{
        border-right: 1px solid rgba(255,255,255,.04);
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .student-name{
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .student-avatar{
        width: 45px;
        height: 45px;
        border-radius: 14px;
        background: rgba(239,68,68,.12);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
    }

    .student-info strong{
        display: block;
        color: #fff;
    }

    .student-info small{
        color: #6b7280;
    }

    .badge-fit{
        padding: 8px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        display: inline-block;
    }

    .badge-active{
        background: rgba(34,197,94,.15);
        color: #22c55e;
    }

    .badge-inactive{
        background: rgba(239,68,68,.15);
        color: #ef4444;
    }

    .action-group{
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-fit-action{
        border: none;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 700;
        transition: .2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-view{
        background: rgba(59,130,246,.15);
        color: #3b82f6;
    }

    .btn-view:hover{
        background: #3b82f6;
        color: #fff;
    }

    .btn-pdf{
        background: rgba(239,68,68,.15);
        color: #ef4444;
    }

    .btn-pdf:hover{
        background: #ef4444;
        color: #fff;
    }

    .btn-delete{
        background: rgba(249,115,22,.15);
        color: #f97316;
    }

    .btn-delete:hover{
        background: #f97316;
        color: #fff;
    }

    .btn-fit-secondary{
        background: #1f2937;
        border: 1px solid rgba(255,255,255,.06);
        color: #d1d5db;
        border-radius: 14px;
        padding: 12px 22px;
        font-weight: 700;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        margin-top: 24px;
    }

    .btn-fit-secondary:hover{
        background: #374151;
        color: #fff;
    }

    @media(max-width: 992px){

        .fit-table{
            display: block;
            overflow-x: auto;
        }
    }

</style>

<div class="fit-header">

    <div>
        <h1 class="fit-title">
            Treinos
        </h1>

        <p class="fit-subtitle">
            Gerencie fichas de treino e acompanhe os alunos da academia.
        </p>
    </div>

    @if(auth()->user()->role === 'instrutor')
        <a href="{{ route('treinos.create') }}" class="btn-fit-primary">
            <i class="bi bi-plus-circle-fill"></i>
            Novo Treino
        </a>
    @endif

</div>

<div class="fit-card">

    <table class="fit-table">

        <thead>
            <tr>
                <th>Aluno</th>
                <th>Treino</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>

        <tbody>

            @foreach($treinos as $treino)

                <tr>

                    <td>

                        <div class="student-name">

                            <div class="student-avatar">
                                {{ strtoupper(substr($treino->aluno->user->name ?? 'A', 0, 1)) }}
                            </div>

                            <div class="student-info">
                                <strong>
                                    {{ $treino->aluno->user->name ?? 'Aluno não encontrado' }}
                                </strong>

                                <small>
                                    FitCloud Academy
                                </small>
                            </div>

                        </div>

                    </td>

                    <td>
                        <span class="badge-fit badge-active">
                            Treino {{ $treino->tipo }}
                        </span>
                    </td>

                    <td>

                        @if($treino->status == 'ativo')

                            <span class="badge-fit badge-active">
                                Ativo
                            </span>

                        @else

                            <span class="badge-fit badge-inactive">
                                {{ ucfirst($treino->status) }}
                            </span>

                        @endif

                    </td>

                    <td>

                        <div class="action-group">

                            <a href="{{ route('treinos.show', $treino->id) }}"
                               class="btn-fit-action btn-view">

                                <i class="bi bi-eye-fill"></i>
                                Ver
                            </a>

                            <a href="{{ route('treinos.pdf', $treino->id) }}"
                               class="btn-fit-action btn-pdf">

                                <i class="bi bi-file-earmark-pdf-fill"></i>
                                PDF
                            </a>

                            @if(auth()->user()->role === 'instrutor')

                                <form action="{{ route('treinos.destroy', $treino->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        class="btn-fit-action btn-delete"
                                        onclick="return confirm('Excluir treino?')">

                                        <i class="bi bi-trash-fill"></i>
                                        Excluir
                                    </button>

                                </form>

                            @endif

                        </div>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

<a href="{{ route('home') }}" class="btn-fit-secondary">

    <i class="bi bi-arrow-left"></i>

    Voltar

</a>

@endsection