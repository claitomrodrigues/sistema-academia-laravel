<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Planos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Planos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('planos.create') }}" class="btn btn-danger mb-3">Novo Plano</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Valor</th>
                <th>Período</th>
                <th>Descrição</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($planos as $plano)
                <tr>
                    <td>{{ $plano->nome }}</td>
                    <td>R$ {{ number_format($plano->valor, 2, ',', '.') }}</td>
                    <td>{{ $plano->periodo }}</td>
                    <td>{{ $plano->descricao }}</td>
                    <td>
                        <a href="{{ route('planos.edit', $plano->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('planos.destroy', $plano->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Excluir?')">
                                Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</body>
</html>