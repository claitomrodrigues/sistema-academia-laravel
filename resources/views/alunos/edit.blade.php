<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Editar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Editar Aluno</h2>

    <form action="{{ route('alunos.update', $aluno->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ $aluno->user->name ?? $aluno->nome }}" required>
        </div>

        <div class="mb-3">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control" value="{{ $aluno->cpf }}" required>
        </div>

        <div class="mb-3">
            <label>Data de nascimento</label>
            <input type="date" name="nascimento" class="form-control" value="{{ $aluno->nascimento }}" required>
        </div>

        <div class="mb-3">
            <label>Objetivo</label>
            <input type="text" name="objetivo" class="form-control" value="{{ $aluno->objetivo }}">
        </div>

        <button class="btn btn-danger">Atualizar</button>
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>