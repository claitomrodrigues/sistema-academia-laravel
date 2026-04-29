<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Treino</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Ficha de Treino</h2>

    <div class="card bg-secondary text-light mb-4">
        <div class="card-body">
            <h5>Aluno: {{ $treino->aluno->user->name ?? 'Aluno não encontrado' }}</h5>
            <p>Tipo: {{ $treino->tipo }}</p>
            <p>Status: {{ $treino->status }}</p>
        </div>
    </div>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th>Exercício</th>
                <th>Grupo Muscular</th>
                <th>Séries</th>
                <th>Repetições</th>
                <th>Carga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($treino->itens as $item)
                <tr>
                    <td>{{ $item->exercicio->nome ?? 'Exercício removido' }}</td>
                    <td>{{ $item->exercicio->grupo_muscular ?? '-' }}</td>
                    <td>{{ $item->series }}</td>
                    <td>{{ $item->reps }}</td>
                    <td>{{ $item->carga }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <a href="{{ route('treinos.index') }}" class="btn btn-secondary">Voltar</a>
</div>

</body>
</html>