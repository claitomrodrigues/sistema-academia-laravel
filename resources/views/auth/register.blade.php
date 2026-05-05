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

    {{-- SUCESSO --}}
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ERROS GERAIS --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Erro ao cadastrar:</strong>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- NOME --}}
        <div class="mb-3">
            <label>Nome</label>
            <input 
                type="text" 
                name="name" 
                value="{{ old('name') }}"
                class="form-control @error('name') is-invalid @enderror"
                required
            >
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- EMAIL --}}
        <div class="mb-3">
            <label>Email</label>
            <input 
                type="email" 
                name="email" 
                value="{{ old('email') }}"
                class="form-control @error('email') is-invalid @enderror"
                required
            >
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- SENHA --}}
        <div class="mb-3">
            <label>Senha</label>
            <input 
                type="password" 
                name="password"
                class="form-control @error('password') is-invalid @enderror"
                required
            >
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- CONFIRMAR SENHA --}}
        <div class="mb-3">
            <label>Confirmar senha</label>
            <input 
                type="password" 
                name="password_confirmation"
                class="form-control @error('password') is-invalid @enderror"
                required
            >
        </div>

        {{-- ROLE --}}
        <div class="mb-3">
            <label>Tipo de conta</label>
            <select 
                name="role" 
                class="form-control @error('role') is-invalid @enderror"
                required
            >
                <option value="">Selecione...</option>
                <option value="instrutor" {{ old('role') == 'instrutor' ? 'selected' : '' }}>Instrutor</option>
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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