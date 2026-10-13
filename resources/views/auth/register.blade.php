<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de academia | FitCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite('resources/js/app.js')
    <style>
        body { min-height: 100vh; background: #f8fafc; color: #334155; }
        .register-card { max-width: 720px; margin: 48px auto; padding: 36px; border: 1px solid #e5e7eb; border-radius: 18px; background: #fff; box-shadow: 0 14px 34px rgba(15,23,42,.06); }
        .form-label { font-weight: 700; }
        .form-control { min-height: 46px; }
    </style>
</head>
<body>
    <main class="container">
        <div class="register-card">
            <div class="mb-4">
                <h1 class="h2 fw-bold text-dark">Cadastre sua academia</h1>
                <p class="text-secondary mb-0">Crie sua academia e o acesso de administrador em uma única etapa.</p>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger" role="alert">
                    <p class="fw-bold mb-1">Revise os dados informados:</p>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <h2 class="h5 fw-bold mt-4 mb-3">Dados da academia</h2>
                <div class="row g-3">
                    <div class="col-md-7">
                        <label for="tenant_name" class="form-label">Nome da academia</label>
                        <input id="tenant_name" name="tenant_name" type="text" class="form-control" value="{{ old('tenant_name') }}" maxlength="255" required autofocus>
                    </div>
                    <div class="col-md-5">
                        <label for="tenant_slug" class="form-label">Identificador (slug)</label>
                        <input id="tenant_slug" name="tenant_slug" type="text" class="form-control" value="{{ old('tenant_slug') }}" pattern="[A-Za-z0-9_-]+" maxlength="255" required>
                        <div class="form-text">Use letras, números, hífens ou sublinhados.</div>
                    </div>
                    <div class="col-12">
                        <label for="document" class="form-label">CNPJ <span class="text-secondary">(opcional)</span></label>
                        <input id="document" name="document" type="text" class="form-control" value="{{ old('document') }}" inputmode="numeric" maxlength="18" placeholder="00.000.000/0000-00">
                    </div>
                </div>

                <h2 class="h5 fw-bold mt-4 mb-3">Administrador da academia</h2>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label for="admin_name" class="form-label">Seu nome</label>
                        <input id="admin_name" name="admin_name" type="text" class="form-control" value="{{ old('admin_name') }}" maxlength="255" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email" class="form-label">E-mail</label>
                        <input id="email" name="email" type="email" class="form-control" value="{{ old('email') }}" maxlength="255" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password" class="form-label">Senha</label>
                        <input id="password" name="password" type="password" class="form-control" minlength="8" required>
                    </div>
                    <div class="col-md-6">
                        <label for="password_confirmation" class="form-label">Confirme a senha</label>
                        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" minlength="8" required>
                    </div>
                </div>

                <button type="submit" class="btn btn-success w-100 mt-4 py-2 fw-bold">Criar academia e acessar</button>
            </form>

            <p class="text-center text-secondary mt-4 mb-0">
                Já tem uma conta? <a href="{{ route('login') }}">Entrar</a>
            </p>
        </div>
    </main>
</body>
</html>
