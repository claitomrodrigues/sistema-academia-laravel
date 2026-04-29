<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastrar Aluno</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Cadastrar Aluno</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('alunos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>CPF</label>
            <input type="text" name="cpf" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Data de nascimento</label>
            <input type="date" name="nascimento" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Objetivo</label>
            <input type="text" name="objetivo" class="form-control">
        </div>

        <div class="mb-3">
            <label>Plano</label>
            <select name="plano_id" class="form-control" required>
                <option value="">Selecione um plano</option>
                @foreach($planos as $plano)
                    <option value="{{ $plano->id }}">
                        {{ $plano->nome }} - R$ {{ number_format($plano->valor, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-danger">Salvar</button>
        <a href="{{ route('alunos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>