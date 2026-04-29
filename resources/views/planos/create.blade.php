<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Plano</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Cadastrar Plano</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('planos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Valor</label>
            <input type="number" step="0.01" name="valor" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Período (ex: mensal, anual)</label>
            <input type="text" name="periodo" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control"></textarea>
        </div>

        <button class="btn btn-danger">Salvar</button>
        <a href="{{ route('planos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>