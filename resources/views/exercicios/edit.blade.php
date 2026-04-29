<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Exercício</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Editar Exercício</h2>

    <form action="{{ route('exercicios.update', $exercicio->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $exercicio->nome }}" required>
        </div>

        <div class="mb-3">
            <label>Grupo Muscular</label>
            <input type="text" name="grupo_muscular" class="form-control" value="{{ $exercicio->grupo_muscular }}" required>
        </div>

        <button class="btn btn-danger">Atualizar</button>
        <a href="{{ route('exercicios.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>