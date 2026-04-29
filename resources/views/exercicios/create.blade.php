<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Exercício</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Novo Exercício</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('exercicios.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Grupo Muscular</label>
            <input type="text" name="grupo_muscular" class="form-control" required>
        </div>

        <button class="btn btn-danger">Salvar</button>
        <a href="{{ route('exercicios.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>