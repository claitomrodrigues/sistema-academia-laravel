<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Plano</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Editar Plano</h2>

    <form action="{{ route('planos.update', $plano->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $plano->nome }}" required>
        </div>

        <div class="mb-3">
            <label>Valor</label>
            <input type="number" step="0.01" name="valor" class="form-control" value="{{ $plano->valor }}" required>
        </div>

        <div class="mb-3">
            <label>Período</label>
            <input type="text" name="periodo" class="form-control" value="{{ $plano->periodo }}" required>
        </div>

        <div class="mb-3">
            <label>Descrição</label>
            <textarea name="descricao" class="form-control">{{ $plano->descricao }}</textarea>
        </div>

        <button class="btn btn-danger">Atualizar</button>
        <a href="{{ route('planos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>