<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login | FitCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            min-height: 100vh;
            overflow: hidden;
            background: #070b16;
            font-family: Arial, Helvetica, sans-serif;
            color: #fff;
        }

        .animated-bg {
            position: fixed;
            inset: 0;
            z-index: -1;
            background:
                radial-gradient(circle at top left, rgba(239, 68, 68, .28), transparent 32%),
                radial-gradient(circle at bottom right, rgba(127, 29, 29, .25), transparent 34%),
                #070b16;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .45;
            animation: moveBlob 12s infinite alternate ease-in-out;
        }

        .blob-1 {
            width: 460px;
            height: 460px;
            background: #ef4444;
            top: -140px;
            left: -130px;
        }

        .blob-2 {
            width: 420px;
            height: 420px;
            background: #991b1b;
            bottom: -160px;
            right: -130px;
            animation-delay: 3s;
        }

        .blob-3 {
            width: 280px;
            height: 280px;
            background: #fff;
            opacity: .07;
            bottom: 18%;
            left: 12%;
            animation-delay: 5s;
        }

        .grid-effect {
            position: fixed;
            inset: 0;
            z-index: -1;
            background-image:
                linear-gradient(rgba(255,255,255,.035) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,.035) 1px, transparent 1px);
            background-size: 45px 45px;
            mask-image: linear-gradient(to bottom, transparent, black 20%, black 75%, transparent);
            animation: gridMove 18s linear infinite;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 22px;
        }

        .login-card {
            width: 100%;
            max-width: 450px;
            background: rgba(17, 24, 39, .82);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,.08);
            border-radius: 32px;
            padding: 40px;
            box-shadow:
                0 30px 90px rgba(0,0,0,.55),
                0 0 55px rgba(239,68,68,.12);
            position: relative;
            overflow: hidden;
            animation: cardEnter .75s ease both;
        }

        .login-card::before {
            content: '';
            position: absolute;
            width: 220px;
            height: 220px;
            background: rgba(239,68,68,.12);
            border-radius: 50%;
            top: -90px;
            right: -90px;
            filter: blur(8px);
            animation: pulseGlow 3s ease-in-out infinite;
        }

        .brand-logo-wrapper {
            position: relative;
            width: 200px;
            height: 125px;
            margin:0 auto 24px;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: floatLogo 4s ease-in-out infinite;
        }

        .brand-logo-glow {
            position: absolute;
            width: 150px;
            height: 150px;
            border-radius: 50%;
            background: radial-gradient(circle, rgba(239,68,68,.45), transparent 70%);
            filter: blur(18px);
            animation: pulseGlow 3s ease-in-out infinite;
        }

       

        .brand-logo {
            width: 600px;
            height: 600px;
            object-fit: contain;
            filter:
                drop-shadow(0 0 12px rgba(239,68,68,.65))
                drop-shadow(0 0 28px rgba(239,68,68,.38));
        }

        .brand-title {
            text-align: center;
            font-size: 36px;
            font-weight: 900;
            margin-bottom: 8px;
            color: #fff;
            position: relative;
            z-index: 2;
        }

        .brand-title span {
            color: #ef4444;
        }

        .brand-subtitle {
            text-align: center;
            color: #9ca3af;
            font-size: 14px;
            margin-bottom: 32px;
            position: relative;
            z-index: 2;
        }

        label {
            color: #d1d5db;
            font-weight: 700;
            margin-bottom: 8px;
            position: relative;
            z-index: 2;
        }

        .input-group-fit {
            position: relative;
            z-index: 2;
        }

        .input-icon {
            position: absolute;
            left: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #ef4444;
            z-index: 2;
        }

        .form-control {
            background: rgba(2, 6, 23, .88);
            border: 1px solid #1f2937;
            color: #fff;
            border-radius: 16px;
            padding: 14px 46px;
            transition: .25s;
        }

        .form-control:focus {
            background: #020617;
            color: #fff;
            border-color: #ef4444;
            box-shadow: 0 0 0 .25rem rgba(239,68,68,.16);
            transform: translateY(-1px);
        }

        .form-control::placeholder {
            color: #6b7280;
        }

        .toggle-password {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: transparent;
            color: #9ca3af;
            z-index: 2;
        }

        .toggle-password:hover {
            color: #fff;
        }

        .btn-login {
            background: linear-gradient(135deg, #ef4444, #991b1b);
            border: none;
            color: #fff;
            border-radius: 16px;
            padding: 15px;
            font-weight: 900;
            transition: .25s;
            box-shadow: 0 16px 35px rgba(239,68,68,.28);
            position: relative;
            z-index: 2;
        }

        .btn-login:hover {
            transform: translateY(-3px);
            color: #fff;
            box-shadow: 0 22px 45px rgba(239,68,68,.42);
        }

        .btn-login.loading {
            opacity: .85;
            pointer-events: none;
        }

        .alert {
            border-radius: 16px;
            border: none;
            font-size: 14px;
            animation: alertEnter .4s ease both;
            position: relative;
            z-index: 2;
        }

        .login-footer {
            text-align: center;
            color: #6b7280;
            font-size: 13px;
            margin-top: 28px;
            position: relative;
            z-index: 2;
        }

        @keyframes cardEnter {
            from {
                opacity: 0;
                transform: translateY(35px) scale(.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        @keyframes moveBlob {
            from {
                transform: translate(0, 0) scale(1);
            }
            to {
                transform: translate(80px, 65px) scale(1.18);
            }
        }

        @keyframes gridMove {
            from {
                background-position: 0 0;
            }
            to {
                background-position: 90px 90px;
            }
        }

        @keyframes floatLogo {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulseGlow {
            0%, 100% {
                opacity: .6;
                transform: scale(1);
            }
            50% {
                opacity: 1;
                transform: scale(1.12);
            }
        }

        @keyframes alertEnter {
            from {
                opacity: 0;
                transform: translateY(-12px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @media(max-width: 500px) {
            .login-card {
                padding: 30px;
            }

            .brand-title {
                font-size: 30px;
            }

            .brand-logo-wrapper {
                width: 110px;
                height: 110px;
            }

            .brand-logo-circle {
                width: 100px;
                height: 100px;
            }

            .brand-logo {
                width: 80px;
                height: 80px;
            }
        }
    </style>
</head>

<body>

<div class="animated-bg">
    <div class="blob blob-1"></div>
    <div class="blob blob-2"></div>
    <div class="blob blob-3"></div>
</div>

<div class="grid-effect"></div>

<div class="login-wrapper">
    <div class="login-card">

        <div class="brand-logo-wrapper">
            <div class="brand-logo-glow"></div>

            <div class="brand-logo-circle">
                <img
                    src="{{ asset('img/logo.png') }}"
                    alt="FitCloud"
                    class="brand-logo"
                >
            </div>
        </div>

        @if(session('error'))
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <div class="mb-3">
                <label for="email">E-mail</label>

                <div class="input-group-fit">
                    <i class="bi bi-envelope-fill input-icon"></i>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        required
                        autofocus
                    >
                </div>
            </div>

            <div class="mb-4">
                <label for="password">Senha</label>

                <div class="input-group-fit">
                    <i class="bi bi-lock-fill input-icon"></i>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Digite sua senha"
                        required
                    >

                    <button type="button" class="toggle-password" onclick="togglePassword()">
                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="btn btn-login w-100" id="loginButton">
                <i class="bi bi-box-arrow-in-right me-2"></i>
                Entrar no sistema
            </button>
        </form>

        <div class="login-footer">
            © {{ date('Y') }} FitCloud • Todos os direitos reservados
        </div>

    </div>
</div>

<script>
    function togglePassword() {
        const password = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');

        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.remove('bi-eye-fill');
            eyeIcon.classList.add('bi-eye-slash-fill');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('bi-eye-slash-fill');
            eyeIcon.classList.add('bi-eye-fill');
        }
    }

    document.getElementById('loginForm').addEventListener('submit', function () {
        const button = document.getElementById('loginButton');

        button.classList.add('loading');
        button.innerHTML = `
            <span class="spinner-border spinner-border-sm me-2"></span>
            Entrando...
        `;
    });
</script>

</body>
</html>