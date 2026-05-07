@extends('layouts.app')

@section('title', 'Financeiro')

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

    .fit-card {
        background: #111827;
        border-radius: 24px;
        padding: 28px;
        border: 1px solid rgba(255,255,255,.06);
        box-shadow: 0 20px 45px rgba(0,0,0,.25);
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
        transition: .2s;
    }

    .fit-table tbody tr:hover {
        transform: scale(1.01);
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
    }

    .fit-table tbody td:last-child {
        border-right: 1px solid rgba(255,255,255,.04);
        border-top-right-radius: 16px;
        border-bottom-right-radius: 16px;
    }

    .student-box {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .student-avatar {
        width: 46px;
        height: 46px;
        border-radius: 15px;
        background: rgba(239,68,68,.14);
        color: #ef4444;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        font-size: 18px;
    }

    .student-info strong {
        display: block;
        color: #fff;
    }

    .student-info small {
        color: #6b7280;
    }

    .price-badge {
        background: rgba(34,197,94,.14);
        color: #22c55e;
        padding: 9px 14px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .date-box {
        color: #fff;
        font-weight: 700;
    }

    .status-badge {
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        display: inline-block;
    }

    .status-paid {
        background: rgba(34,197,94,.14);
        color: #22c55e;
    }

    .status-pending {
        background: rgba(234,179,8,.15);
        color: #eab308;
    }

    .action-group {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .btn-fit-action {
        border: none;
        border-radius: 12px;
        padding: 10px 14px;
        font-size: 13px;
        font-weight: 800;
        transition: .2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-paid {
        background: rgba(34,197,94,.14);
        color: #22c55e;
    }

    .btn-paid:hover {
        background: #22c55e;
        color: #020617;
    }

    .btn-pix {
        background: rgba(239,68,68,.15);
        color: #ef4444;
    }

    .btn-pix:hover {
        background: #ef4444;
        color: #fff;
    }

    .btn-boleto {
        background: rgba(234,179,8,.15);
        color: #eab308;
    }

    .btn-boleto:hover {
        background: #eab308;
        color: #111827;
    }

    .muted-text {
        color: #6b7280;
        font-weight: 600;
    }

    .empty-box {
        text-align: center;
        color: #9ca3af;
        padding: 40px;
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
        margin-top: 24px;
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
        <h1 class="fit-title">Controle Financeiro</h1>
        <p class="fit-subtitle">
            Gerencie mensalidades, vencimentos, pagamentos e transações dos alunos.
        </p>
          @if(auth()->user()->role === 'instrutor')
    <a href="{{ route('cobrancas.create') }}" class="btn-fit-primary">
        <i class="bi bi-plus-circle-fill"></i>
        Nova Cobrança
    </a>
@endif
    </div>
</div>

<div class="fit-card">
    <table class="fit-table">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>


        <tbody>
            @forelse($pagamentos as $pagamento)
                <tr>
                    <td>
                        <div class="student-box">
                            <div class="student-avatar">
                                {{ strtoupper(substr($pagamento->matricula->aluno->user->name ?? 'A', 0, 1)) }}
                            </div>

                            <div class="student-info">
                                <strong>
                                    {{ $pagamento->matricula->aluno->user->name ?? 'Aluno não encontrado' }}
                                </strong>
                                <small>Mensalidade FitCloud</small>
                            </div>
                        </div>
                    </td>

                    <td>
                        <span class="price-badge">
                            R$ {{ number_format($pagamento->valor, 2, ',', '.') }}
                        </span>
                    </td>

                    <td>
                        <div class="date-box">
                            {{ \Carbon\Carbon::parse($pagamento->vencimento)->format('d/m/Y') }}
                        </div>
                    </td>

                    <td>
                        @if($pagamento->status == 'pago')
                            <span class="status-badge status-paid">Pago</span>
                        @else
                            <span class="status-badge status-pending">Pendente</span>
                        @endif
                    </td>

                    <td>
                        @if(auth()->user()->role === 'instrutor')
                            <div class="action-group">
                                @if($pagamento->status != 'pago')
                                    <form action="{{ route('financeiro.pagar', $pagamento->id) }}" method="POST" class="d-inline">
                                        @csrf

                                        <button class="btn-fit-action btn-paid">
                                            <i class="bi bi-check-circle-fill"></i>
                                            Marcar pago
                                        </button>
                                    </form>
                                @endif

                                <form action="{{ route('financeiro.transacao') }}" method="POST" class="d-inline">
                                    @csrf

                                    <input type="hidden" name="pagamento_id" value="{{ $pagamento->id }}">
                                    <input type="hidden" name="metodo" value="pix">

                                    <button class="btn-fit-action btn-pix">
                                        <i class="bi bi-qr-code"></i>
                                        Gerar Pix
                                    </button>
                                </form>

                                <form action="{{ route('financeiro.transacao') }}" method="POST" class="d-inline">
                                    @csrf

                                    <input type="hidden" name="pagamento_id" value="{{ $pagamento->id }}">
                                    <input type="hidden" name="metodo" value="boleto">

                                    <button class="btn-fit-action btn-boleto">
                                        <i class="bi bi-upc-scan"></i>
                                        Gerar Boleto
                                    </button>
                                </form>
                            </div>
                        @else
                            <span class="muted-text">Somente visualização</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">
                        <div class="empty-box">
                            Nenhum pagamento encontrado.
                        </div>
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

<a href="{{ route('home') }}" class="btn-fit-secondary">
    <i class="bi bi-arrow-left"></i>
    Voltar
</a>

@endsection