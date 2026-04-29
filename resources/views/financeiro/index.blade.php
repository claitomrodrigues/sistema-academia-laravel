<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Financeiro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Controle Financeiro</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-dark table-striped mt-3">
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
            @foreach($pagamentos as $pagamento)
                <tr>
                    <td>{{ $pagamento->matricula->aluno->user->name ?? 'Aluno não encontrado' }}</td>
                    <td>R$ {{ number_format($pagamento->valor, 2, ',', '.') }}</td>
                    <td>{{ $pagamento->vencimento }}</td>
                    <td>{{ $pagamento->status }}</td>
                    <td>
                        @if($pagamento->status != 'pago')
                            <form action="{{ route('financeiro.pagar', $pagamento->id) }}" method="POST" class="d-inline">
                                @csrf
                                <button class="btn btn-success btn-sm">Marcar como pago</button>
                            </form>
                        @else
                            <span class="badge bg-success">Pago</span>
                        @endif

                        <form action="{{ route('financeiro.transacao') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="pagamento_id" value="{{ $pagamento->id }}">
                            <input type="hidden" name="metodo" value="pix">
                            <button class="btn btn-danger btn-sm">Gerar Pix</button>
                        </form>

                        <form action="{{ route('financeiro.transacao') }}" method="POST" class="d-inline">
                            @csrf
                            <input type="hidden" name="pagamento_id" value="{{ $pagamento->id }}">
                            <input type="hidden" name="metodo" value="boleto">
                            <button class="btn btn-warning btn-sm">Gerar Boleto</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('home') }}" class="btn btn-secondary">Voltar</a>
</div>

</body>
</html>