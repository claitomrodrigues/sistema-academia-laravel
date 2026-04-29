<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Criar Conta</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark d-flex align-items-center justify-content-center" style="height:100vh;">

<div class="card p-4 bg-secondary text-light" style="width: 420px;">
    <h3 class="text-center mb-4">Criar Conta</h3>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label>Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Confirmar senha</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Tipo de conta</label>
            <select name="role" class="form-control" required>
                <option value="aluno">Aluno</option>
                <option value="instrutor">Instrutor</option>
            </select>
        </div>

        <button class="btn btn-danger w-100">Cadastrar</button>
    </form>

    <hr>

    <p class="text-center mb-0">
        Já tem conta?
        <a href="{{ route('login') }}" class="text-light fw-bold">Entrar</a>
    </p>
</div>

</body>
</html>