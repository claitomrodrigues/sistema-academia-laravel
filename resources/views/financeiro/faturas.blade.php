<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Minhas Faturas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
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
            @foreach($pagamentos as $pagamento)
                <tr>
                    <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                    <td>{{ $pagamento->vencimento }}</td>
                    <td>{{ $pagamento->status }}</td>
                    <td>
                        @if($pagamento->transacao)
                            Método: {{ $pagamento->transacao->metodo }} <br>

                            @if($pagamento->transacao->metodo == 'pix')
                                Pix: {{ $pagamento->transacao->qr_code_pix }}
                            @else
                                Boleto: {{ $pagamento->transacao->codigo_barras }}
                            @endif
                        @else
                            Nenhuma transação gerada
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
</div>

</body>
</html>