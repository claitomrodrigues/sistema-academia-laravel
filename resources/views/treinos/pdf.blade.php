<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ficha de Treino</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            color: #222;
            margin: 20px;
        }

        h1 {
            text-align: center;
            color: #dc3545;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 5px 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            background-color: #dc3545;
            color: #fff;
            padding: 8px;
            border: 1px solid #000;
        }

        td {
            padding: 8px;
            border: 1px solid #000;
            text-align: center;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            text-align: center;
            color: #555;
        }
    </style>
</head>
<body>

    <h1>Ficha de Treino</h1>

    <div class="info">
        <p><strong>Aluno:</strong> {{ $treino->aluno->user->name ?? $treino->aluno->nome }}</p>
        <p><strong>Tipo:</strong> {{ $treino->tipo }}</p>
        <p><strong>Status:</strong> {{ $treino->status }}</p>
        <p><strong>Data:</strong> {{ now()->format('d/m/Y') }}</p>
    </div>

    <table>
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
                    <td>{{ $item->exercicio->nome ?? '-' }}</td>
                    <td>{{ $item->exercicio->grupo_muscular ?? '-' }}</td>
                    <td>{{ $item->series }}</td>
                    <td>{{ $item->reps }}</td>
                    <td>{{ $item->carga ?? '-' }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Sistema Academia • {{ now()->format('Y') }}
    </div>

</body>
</html>