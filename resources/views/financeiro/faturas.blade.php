@extends('layouts.app')

@section('title', 'Minhas Faturas')

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
        padding: 20px 18px;
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

    .price-badge{
        background: rgba(34,197,94,.14);
        color: #22c55e;
        padding: 10px 14px;
        border-radius: 999px;
        font-weight: 800;
        display: inline-block;
    }

    .date-box{
        color: #fff;
        font-weight: 700;
    }

    .status-badge{
        padding: 9px 14px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 800;
        display: inline-block;
    }

    .status-paid{
        background: rgba(34,197,94,.14);
        color: #22c55e;
    }

    .status-pending{
        background: rgba(234,179,8,.15);
        color: #eab308;
    }

    .payment-box{
        background: rgba(255,255,255,.03);
        border: 1px solid rgba(255,255,255,.04);
        border-radius: 16px;
        padding: 16px;
    }

    .payment-method{
        color: #fff;
        font-weight: 800;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .payment-code{
        color: #9ca3af;
        font-size: 13px;
        word-break: break-word;
        line-height: 1.6;
    }

    .empty-box{
        text-align: center;
        color: #9ca3af;
        padding: 40px;
    }

    .btn-fit-secondary{
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

    .btn-fit-secondary:hover{
        background: #374151;
        color: #fff;
    }

    .muted-text{
        color: #6b7280;
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
            Minhas Faturas
        </h1>

        <p class="fit-subtitle">
            Acompanhe pagamentos, vencimentos e transações da sua matrícula.
        </p>

    </div>

</div>

<div class="fit-card">

    <table class="fit-table">

        <thead>
            <tr>
                <th>Valor</th>
                <th>Vencimento</th>
                <th>Status</th>
                <th>Pagamento</th>
            </tr>
        </thead>

        <tbody>

            @forelse($pagamentos as $pagamento)

                <tr>

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

                            <span class="status-badge status-paid">
                                Pago
                            </span>

                        @else

                            <span class="status-badge status-pending">
                                Pendente
                            </span>

                        @endif

                    </td>

                    <td>

                        @if($pagamento->transacao)

                            <div class="payment-box">

                                <div class="payment-method">

                                    @if($pagamento->transacao->metodo == 'pix')

                                        <i class="bi bi-qr-code"></i>

                                        PIX

                                    @else

                                        <i class="bi bi-upc-scan"></i>

                                        BOLETO

                                    @endif

                                </div>

                                <div class="payment-code">

                                    @if($pagamento->transacao->metodo == 'pix')

                                        {{ $pagamento->transacao->qr_code_pix }}

                                    @else

                                        {{ $pagamento->transacao->codigo_barras }}

                                    @endif

                                </div>

                            </div>

                        @else

                            <span class="muted-text">
                                Nenhuma transação gerada
                            </span>

                        @endif

                    </td>

                </tr>

            @empty

                <tr>

                    <td colspan="4">

                        <div class="empty-box">
                            Nenhuma fatura encontrada.
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