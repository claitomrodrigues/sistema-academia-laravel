<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Alunos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Alunos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('alunos.create') }}" class="btn btn-danger mb-3">Novo Aluno</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>CPF</th>
                <th>Nascimento</th>
                <th>Objetivo</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($alunos as $aluno)
                <tr>
                    <td>{{ $aluno->user->name ?? $aluno->nome }}</td>
                    <td>{{ $aluno->cpf }}</td>
                    <td>{{ $aluno->nascimento }}</td>
                    <td>{{ $aluno->objetivo }}</td>
                    <td>
                        <a href="{{ route('alunos.edit', $aluno->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('alunos.destroy', $aluno->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir?')">
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