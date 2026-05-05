@extends('layouts.app')

@section('title', 'Minhas Faturas')

@section('content')

<div class="container mt-4">
    <h2>Minhas Faturas</h2>

    <table class="table table-dark table-striped mt-3">
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
                    <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($pagamento->vencimento)->format('d/m/Y') }}</td>
                    <td>
                        @if($pagamento->status == 'pago')
                            <span class="badge bg-success">Pago</span>
                        @else
                            <span class="badge bg-warning text-dark">Pendente</span>
                        @endif
                    </td>
                    <td>
                        @if($pagamento->transacao)
                            <strong>Método:</strong> {{ ucfirst($pagamento->transacao->metodo) }} <br>

                            @if($pagamento->transacao->metodo == 'pix')
                                <strong>Pix:</strong> {{ $pagamento->transacao->qr_code_pix }}
                            @else
                                <strong>Boleto:</strong> {{ $pagamento->transacao->codigo_barras }}
                            @endif
                        @else
                            <span class="text-muted">Nenhuma transação gerada</span>
                        @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4" class="text-center">
                        Nenhuma fatura encontrada.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
</div>

@endsection