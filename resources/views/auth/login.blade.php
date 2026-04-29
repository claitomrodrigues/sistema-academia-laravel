<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="card p-4 bg-secondary text-light" style="width: 380px;">
    <h3 class="text-center mb-4">Sistema Academia</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-danger w-100">Entrar</button>
    </form>

    <hr>

    <p class="text-center mb-0">
        Não tem conta?
        <a href="{{ route('register') }}" class="text-light fw-bold">Criar conta</a>
    </p>
</div>

</body>
</html>