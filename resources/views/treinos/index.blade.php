<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Treinos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Treinos</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('treinos.create') }}" class="btn btn-danger mb-3">Novo Treino</a>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Aluno</th>
                <th>Tipo</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($treinos as $treino)
                <tr>
                    <td>{{ $treino->aluno->user->name ?? 'Aluno não encontrado' }}</td>
                    <td>{{ $treino->tipo }}</td>
                    <td>{{ $treino->status }}</td>
                    <td>
                        <a href="{{ route('treinos.show', $treino->id) }}" class="btn btn-info btn-sm">Ver</a>

                        <form action="{{ route('treinos.destroy', $treino->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Excluir treino?')">
                                Excluir
                            </button>
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