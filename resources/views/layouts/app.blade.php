<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Sistema Academia')</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-dark text-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark border-bottom border-danger">
    <div class="container">
        <a class="navbar-brand text-danger fw-bold" href="{{ route('home') }}">
            Academia
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">

                @auth
                    @if(auth()->user()->role === 'instrutor')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('alunos.index') }}">Alunos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('planos.index') }}">Planos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('exercicios.index') }}">Exercícios</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('treinos.index') }}">Treinos</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('financeiro.index') }}">Financeiro</a>
                        </li>
                    @endif

                    @if(auth()->user()->role === 'aluno')
                        @if(auth()->user()->aluno)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('meu.treino', auth()->user()->aluno->id) }}">
                                    Meu Treino
                                </a>
                            </li>
                        @endif

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('minhas.faturas') }}">
                                Minhas Faturas
                            </a>
                        </li>
                    @endif

                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="btn btn-danger btn-sm ms-3">Sair</button>
                        </form>
                    </li>
                @endauth

            </ul>
        </div>
    </div>
</nav>

<!-- CONTEÚDO -->
<main class="container mt-4">
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>