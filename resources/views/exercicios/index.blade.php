@extends('layouts.app')

@section('title', 'Exercícios')

@section('content')

<style>

    .fit-header{
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 18px;
        flex-wrap: wrap;
        margin-bottom: 28px;
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
        font-weight: 800;
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
        font-weight: 800;
        text-transform: uppercase;
        border: none;
        padding-bottom: 12px;
    }

    .fit-table tbody tr{
        background: #020617;
        transition: .2s;
    }

    .fit-table tbody tr:hover{
        transform: scale(1.01);
    }

    .fit-table tbody td{
        padding: 18px;
        color: #e5e7eb;
        border-top: 1px solid rgba(255,255,255,.04);
        border-bottom: 1px solid rgba(255,255,255,.04);
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

    .exercise-box{
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .exercise-icon{
        width: 48px;
        height: 48px;
        border-radius: 15px;
        background: rgba(239,68,68,.14);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
    }

    .exercise-info strong{
        display: block;
        color: #fff;
        font-size: 15px;
    }

    .exercise-info small{
        color: #6b7280;
    }

    .muscle-badge{
        display: inline-flex;
        align-items: center;
        gap: 8px;

        background: rgba(239,68,68,.13);

        color: #ef4444;

        padding: 9px 14px;

        border-radius: 999px;

        font-size: 13px;
        font-weight: 800;
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
        font-weight: 800;
        transition: .2s;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-edit{
        background: rgba(234,179,8,.15);
        color: #eab308;
    }

    .btn-edit:hover{
        background: #eab308;
        color: #111827;
    }

    .btn-delete{
        background: rgba(239,68,68,.15);
        color: #ef4444;
    }

    .btn-delete:hover{
        background: #ef4444;
        color: #fff;
    }

    .muted-text{
        color: #6b7280;
        font-weight: 600;
    }

    .empty-box{
        text-align: center;
        color: #9ca3af;
        padding: 40px;
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
            Exercícios
        </h1>

        <p class="fit-subtitle">
            Gerencie o banco de exercícios disponíveis para os treinos dos alunos.
        </p>

    </div>

    @if(auth()->user()->role === 'instrutor')

        <a href="{{ route('exercicios.create') }}" class="btn-fit-primary">

            <i class="bi bi-plus-circle-fill"></i>

            Novo Exercício

        </a>

    @endif

</div>

<div class="fit-card">

    <table class="fit-table">

        <thead>

            <tr>
                <th>Exercício</th>
                <th>Grupo Muscular</th>
                <th>Ações</th>
            </tr>

        </thead>

        <tbody>

            @forelse($exercicios as $exercicio)

                <tr>

                    <td>

                        <div class="exercise-box">

                            <div class="exercise-icon">

                                <i class="bi bi-lightning-charge-fill"></i>

                            </div>

                            <div class="exercise-info">

                                <strong>
                                    {{ $exercicio->nome }}
                                </strong>

                                <small>
                                    FitCloud Academy
                                </small>

                            </div>

                        </div>

                    </td>

                    <td>

                        <span class="muscle-badge">

                            <i class="bi bi-fire"></i>

                            {{ $exercicio->grupo_muscular }}

                        </span>

                    </td>

                    <td>

                        @if(auth()->user()->role === 'instrutor')

                            <div class="action-group">

                                <a href="{{ route('exercicios.edit', $exercicio->id) }}"
                                   class="btn-fit-action btn-edit">

                                    <i class="bi bi-pencil-square"></i>

                                    Editar

                                </a>

                                <form action="{{ route('exercicios.destroy', $exercicio->id) }}"
                                      method="POST"
                                      class="d-inline">

                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-fit-action btn-delete"
                                            onclick="return confirm('Excluir exercício?')">

                                        <i class="bi bi-trash-fill"></i>

                                        Excluir

                                    </button>

                                </form>

                            </div>

                        @else

                            <span class="muted-text">
                                Somente visualização
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="3">

                        <div class="empty-box">
                            Nenhum exercício cadastrado.
                        </div>

                    </td>

                </tr>

            @endforelse

        </tbody>

    </table>

</div>

@endsection