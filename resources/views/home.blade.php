<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">

<div class="container mt-5 text-center">
    <h1>Sistema Academia</h1>
    <p class="mb-4">Bem-vindo, {{ auth()->user()->name }}</p>

    <div class="d-grid gap-3 col-6 mx-auto">

        <a href="{{ route('alunos.index') }}" class="btn btn-danger">Alunos</a>
        <a href="{{ route('planos.index') }}" class="btn btn-danger">Planos</a>
        <a href="{{ route('exercicios.index') }}" class="btn btn-danger">Exercícios</a>
        <a href="{{ route('treinos.index') }}" class="btn btn-danger">Treinos</a>
        <a href="{{ route('financeiro.index') }}" class="btn btn-danger">Financeiro</a>

        <a href="{{ route('logout') }}" class="btn btn-secondary"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            Sair
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST">
            @csrf
        </form>

    </div>
</div>

</body>
</html>