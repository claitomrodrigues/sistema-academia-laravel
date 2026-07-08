@extends('layouts.app')

@section('title', 'Controle de Presenças')

@section('content')

<style>
    .fit-header{
        display:flex;
        justify-content:space-between;
        align-items:center;
        gap:18px;
        flex-wrap:wrap;
        margin-bottom:28px;
    }

    .fit-title{
        color:#0F172A;
        font-size:32px;
        font-weight:800;
        margin-bottom:6px;
        letter-spacing:-.03em;
    }

    .fit-subtitle{
        color:#64748B;
        margin:0;
        font-size:15px;
    }

    .fit-card{
        background:#FFFFFF;
        border:1px solid #E5E7EB;
        border-radius:18px;
        padding:24px;
        box-shadow:0 2px 10px rgba(15,23,42,.04);
    }

    .filter-card{
        margin-bottom:24px;
    }

    .btn-fit-primary{
        background:#16A34A;
        border:1px solid #16A34A;
        color:#fff;
        border-radius:10px;
        padding:10px 16px;
        font-weight:700;
        transition:.16s;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        gap:8px;
        box-shadow:none;
    }

    .btn-fit-primary:hover{
        background:#15803D;
        border-color:#15803D;
        color:#fff;
        transform:translateY(-1px);
    }

    .btn-fit-secondary{
        background:#fff;
        border:1px solid #E5E7EB;
        color:#334155;
        border-radius:10px;
        padding:10px 16px;
        font-weight:700;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        box-shadow:none;
    }

    .btn-fit-secondary:hover{
        background:#F8FAFC;
        color:#0F172A;
        border-color:#CBD5E1;
    }

    .form-control,
    .form-select{
        background:#fff;
        border:1px solid #E5E7EB;
        color:#334155;
        border-radius:10px;
        padding:11px 13px;
        min-height:44px;
        box-shadow:none;
    }

    .form-control:focus,
    .form-select:focus{
        background:#fff;
        color:#334155;
        border-color:#16A34A;
        box-shadow:0 0 0 .18rem rgba(22,163,74,.10);
    }

    label{
        color:#334155;
        font-weight:700;
        margin-bottom:8px;
        font-size:14px;
    }

    .summary-grid{
        display:grid;
        grid-template-columns:repeat(3,minmax(0,1fr));
        gap:18px;
        margin-bottom:24px;
    }

    .summary-card{
        background:#fff;
        border:1px solid #E5E7EB;
        border-radius:16px;
        padding:22px;
        box-shadow:0 2px 10px rgba(15,23,42,.04);
        transition:.16s;
    }

    .summary-card:hover{
        border-color:rgba(22,163,74,.35);
        box-shadow:0 8px 22px rgba(22,163,74,.08);
        transform:translateY(-2px);
    }

    .summary-label{
        color:#64748B;
        font-weight:700;
        text-transform:uppercase;
        font-size:12px;
        letter-spacing:.05em;
        margin-bottom:8px;
    }

    .summary-value{
        color:#0F172A;
        font-size:28px;
        font-weight:800;
        letter-spacing:-.03em;
    }

    .summary-icon{
        width:52px;
        height:52px;
        border-radius:14px;
        background:rgba(22,163,74,.10);
        color:#16A34A;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:23px;
        border:1px solid rgba(22,163,74,.14);
    }

    .fit-table{
        width:100%;
        border-collapse:collapse;
        background:#fff;
    }

    .fit-table thead th{
        color:#64748B;
        background:#F8FAFC;
        font-size:12px;
        font-weight:700;
        text-transform:uppercase;
        letter-spacing:.04em;
        border-bottom:1px solid #E5E7EB;
        padding:14px 16px;
        white-space:nowrap;
    }

    .fit-table tbody tr{
        background:#fff;
        border-bottom:1px solid #F1F5F9;
        transition:.16s;
    }

    .fit-table tbody tr:hover{
        background:#F8FAFC;
    }

    .fit-table tbody td{
        padding:16px;
        color:#334155;
        vertical-align:middle;
        border-bottom:1px solid #F1F5F9;
    }

    .student-box{
        display:flex;
        align-items:center;
        gap:14px;
    }

    .student-avatar{
        width:44px;
        height:44px;
        border-radius:14px;
        background:rgba(22,163,74,.10);
        color:#16A34A;
        display:flex;
        align-items:center;
        justify-content:center;
        font-weight:800;
        border:1px solid rgba(22,163,74,.14);
        flex-shrink:0;
    }

    .student-info strong{
        display:block;
        color:#0F172A;
        font-weight:800;
    }

    .student-info small{
        color:#64748B;
    }

    .date-badge,
    .time-badge{
        background:#F8FAFC;
        color:#334155;
        border:1px solid #E5E7EB;
        padding:7px 11px;
        border-radius:999px;
        font-weight:700;
        display:inline-flex;
        align-items:center;
        gap:7px;
        font-size:13px;
        white-space:nowrap;
    }

    .date-badge i,
    .time-badge i{
        color:#16A34A;
    }

    .obs-text{
        color:#475569;
    }

    .action-group{
        display:flex;
        gap:8px;
        flex-wrap:wrap;
    }

    .btn-fit-action{
        border-radius:10px;
        padding:8px 12px;
        font-size:13px;
        font-weight:700;
        transition:.16s;
        text-decoration:none;
        display:inline-flex;
        align-items:center;
        gap:6px;
        box-shadow:none;
    }

    .btn-edit{
        background:#fff;
        color:#334155;
        border:1px solid #E5E7EB;
    }

    .btn-edit:hover{
        background:#F8FAFC;
        color:#0F172A;
        border-color:#CBD5E1;
    }

    .btn-delete{
        background:#fff;
        color:#B91C1C;
        border:1px solid #FECACA;
    }

    .btn-delete:hover{
        background:#FEF2F2;
        color:#991B1B;
        border-color:#FCA5A5;
    }

    .empty-box{
        text-align:center;
        color:#64748B;
        padding:44px;
    }

    .empty-box i{
        color:#16A34A;
    }

    @media(max-width:992px){
        .fit-table{
            display:block;
            overflow-x:auto;
        }

        .summary-grid{
            grid-template-columns:1fr;
        }
    }
</style>

<div class="fit-header">
    <div>
        <h1 class="fit-title">Controle de Presenças</h1>
        <p class="fit-subtitle">Registre, filtre e acompanhe a frequência dos alunos.</p>
    </div>

    <a href="{{ route('presencas.create') }}" class="btn-fit-primary">
        <i class="bi bi-plus-circle"></i> Registrar presença
    </a>
</div>

<div class="summary-grid">
    <div class="summary-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="summary-label">Registros listados</div>
                <div class="summary-value">{{ $presencas->total() ?? 0 }}</div>
            </div>

            <div class="summary-icon">
                <i class="bi bi-calendar-check"></i>
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="summary-label">Alunos disponíveis</div>
                <div class="summary-value">{{ $alunos->count() ?? 0 }}</div>
            </div>

            <div class="summary-icon">
                <i class="bi bi-people"></i>
            </div>
        </div>
    </div>

    <div class="summary-card">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <div class="summary-label">Módulo</div>
                <div class="summary-value">Presenças</div>
            </div>

            <div class="summary-icon">
                <i class="bi bi-check2-square"></i>
            </div>
        </div>
    </div>
</div>

<div class="fit-card filter-card">
    <form method="GET" action="{{ route('presencas.index') }}" class="row g-3 align-items-end">
        <div class="col-md-5">
            <label for="aluno_id">Aluno</label>
            <select id="aluno_id" name="aluno_id" class="form-select">
                <option value="">Todos os alunos</option>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}" @selected(request('aluno_id') == $aluno->id)>
                        {{ $aluno->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="data_presenca">Data</label>
            <input
                id="data_presenca"
                type="date"
                name="data_presenca"
                value="{{ request('data_presenca') }}"
                class="form-control"
            >
        </div>

        <div class="col-md-3 d-flex gap-2">
            <button class="btn-fit-primary flex-fill" type="submit">
                <i class="bi bi-search"></i> Filtrar
            </button>

            <a href="{{ route('presencas.index') }}" class="btn-fit-secondary">
                Limpar
            </a>
        </div>
    </form>
</div>

<div class="fit-card">
    <div class="table-responsive">
        <table class="fit-table">
            <thead>
                <tr>
                    <th>Aluno</th>
                    <th>Data</th>
                    <th>Horário</th>
                    <th>Observação</th>
                    <th>Ações</th>
                </tr>
            </thead>

            <tbody>
                @forelse($presencas as $presenca)
                    <tr>
                        <td>
                            <div class="student-box">
                                <div class="student-avatar">
                                    {{ strtoupper(substr($presenca->aluno->nome ?? 'A', 0, 1)) }}
                                </div>

                                <div class="student-info">
                                    <strong>{{ $presenca->aluno->nome ?? 'Aluno removido' }}</strong>
                                    <small>{{ $presenca->aluno->cpf ?? 'Sem CPF' }}</small>
                                </div>
                            </div>
                        </td>

                        <td>
                            <span class="date-badge">
                                <i class="bi bi-calendar-event"></i>
                                {{ optional($presenca->data_presenca)->format('d/m/Y') }}
                            </span>
                        </td>

                        <td>
                            <span class="time-badge">
                                <i class="bi bi-clock"></i>
                                {{ substr($presenca->horario, 0, 5) }}
                            </span>
                        </td>

                        <td class="obs-text">
                            {{ $presenca->observacao ?: 'Sem observação' }}
                        </td>

                        <td>
                            <div class="action-group">
                                <a href="{{ route('presencas.edit', $presenca->id) }}" class="btn-fit-action btn-edit">
                                    <i class="bi bi-pencil-square"></i> Editar
                                </a>

                                <form
                                    action="{{ route('presencas.destroy', $presenca->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Remover este registro de presença?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button class="btn-fit-action btn-delete" type="submit">
                                        <i class="bi bi-trash3"></i> Excluir
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">
                            <div class="empty-box">
                                <i class="bi bi-calendar-x fs-1 d-block mb-3"></i>
                                Nenhuma presença encontrada.
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $presencas->links() }}
    </div>
</div>

@endsection
