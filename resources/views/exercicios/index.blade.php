<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Exercícios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Exercícios</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('exercicios.create') }}" class="btn btn-danger mb-3">Novo Exercício</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Grupo Muscular</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($exercicios as $exercicio)
                <tr>
                    <td>{{ $exercicio->nome }}</td>
                    <td>{{ $exercicio->grupo_muscular }}</td>
                    <td>
                        <a href="{{ route('exercicios.edit', $exercicio->id) }}" class="btn btn-warning btn-sm">Editar</a>

                        <form action="{{ route('exercicios.destroy', $exercicio->id) }}" method="POST" class="d-inline">
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