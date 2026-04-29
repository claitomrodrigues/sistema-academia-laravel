<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Novo Treino</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5">
    <h2>Montar Treino</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $erro)
                <p>{{ $erro }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('treinos.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Aluno</label>
            <select name="aluno_id" class="form-control" required>
                <option value="">Selecione o aluno</option>
                @foreach($alunos as $aluno)
                    <option value="{{ $aluno->id }}">
                        {{ $aluno->user->name ?? $aluno->nome }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tipo do treino</label>
            <input type="text" name="tipo" class="form-control" placeholder="Ex: A, B, C, Superior, Inferior" required>
        </div>

        <hr>

        <h4>Exercícios</h4>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Exercício</label>
                <select name="itens[0][exercicio_id]" class="form-control" required>
                    <option value="">Selecione</option>
                    @foreach($exercicios as $exercicio)
                        <option value="{{ $exercicio->id }}">
                            {{ $exercicio->nome }} - {{ $exercicio->grupo_muscular }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label>Séries</label>
                <input type="number" name="itens[0][series]" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label>Repetições</label>
                <input type="number" name="itens[0][reps]" class="form-control" required>
            </div>

            <div class="col-md-2">
                <label>Carga</label>
                <input type="text" name="itens[0][carga]" class="form-control" placeholder="Ex: 20kg">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-md-4">
                <label>Exercício</label>
                <select name="itens[1][exercicio_id]" class="form-control">
                    <option value="">Selecione</option>
                    @foreach($exercicios as $exercicio)
                        <option value="{{ $exercicio->id }}">
                            {{ $exercicio->nome }} - {{ $exercicio->grupo_muscular }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <label>Séries</label>
                <input type="number" name="itens[1][series]" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Repetições</label>
                <input type="number" name="itens[1][reps]" class="form-control">
            </div>

            <div class="col-md-2">
                <label>Carga</label>
                <input type="text" name="itens[1][carga]" class="form-control">
            </div>
        </div>

        <button class="btn btn-danger">Salvar Treino</button>
        <a href="{{ route('treinos.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>

</body>
</html>