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
            background: #0f172a;
            font-family: Arial, Helvetica, sans-serif;
            color: #fff;
        }

        /* FUNDO ANIMADO */

        .animated-bg {
            position: fixed;
            inset: 0;
            overflow: hidden;
            z-index: -1;
            background:
                radial-gradient(circle at top left,
                rgba(239, 68, 68, .15),
                transparent 35%),

                radial-gradient(circle at bottom right,
                rgba(239, 68, 68, .08),
                transparent 35%),

                #0f172a;
        }

        .blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(90px);
            opacity: .35;
            animation: moveBlob 15s infinite alternate ease-in-out;
        }

        .blob-1 {
            width: 450px;
            height: 450px;
            background: #ef4444;
            top: -120px;
            left: -120px;
        }

        .blob-2 {
            width: 400px;
            height: 400px;
            background: #991b1b;
            bottom: -150px;
            right: -100px;
            animation-delay: 3s;
        }

        .blob-3 {
            width: 260px;
            height: 260px;
            background: #ffffff;
            opacity: .06;
            bottom: 18%;
            left: 10%;
            animation-delay: 6s;
        }

        @keyframes moveBlob {

            from {
                transform: translate(0, 0) scale(1);
            }

            to {
                transform: translate(80px, 60px) scale(1.2);
            }
        }

        /* LOGIN */

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        .login-card {

            width: 100%;
            max-width: 430px;

            background: rgba(17, 24, 39, .92);

            backdrop-filter: blur(14px);

            border: 1px solid rgba(255,255,255,.06);

            border-radius: 28px;

            padding: 38px;

            box-shadow:
                0 25px 80px rgba(0,0,0,.45),
                0 0 40px rgba(239,68,68,.08);

            position: relative;
            overflow: hidden;
        }

        .login-card::before {

            content: '';

            position: absolute;

            width: 180px;
            height: 180px;

            background: rgba(239,68,68,.08);

            border-radius: 50%;

            top: -60px;
            right: -60px;
        }

        /* LOGO */

        .brand-icon {

            width: 75px;
            height: 75px;

            border-radius: 22px;

            background: linear-gradient(135deg, #ef4444, #991b1b);

            display: flex;
            align-items: center;
            justify-content: center;

            margin: 0 auto 22px;

            box-shadow:
                0 0 35px rgba(239,68,68,.45);
        }

        .brand-icon i {
            font-size: 34px;
            color: #fff;
        }

        .brand-title {

            text-align: center;

            font-size: 34px;
            font-weight: 800;

            margin-bottom: 8px;

            color: #fff;
        }

        .brand-title span {
            color: #ef4444;
        }

        .brand-subtitle {

            text-align: center;

            color: #9ca3af;

            font-size: 14px;

            margin-bottom: 34px;
        }

        /* FORM */

        label {

            color: #d1d5db;

            font-weight: 600;

            margin-bottom: 8px;
        }

        .form-control {

            background: #020617;

            border: 1px solid #1f2937;

            color: #fff;

            border-radius: 14px;

            padding: 13px 15px;

            transition: .2s;
        }

        .form-control:focus {

            background: #020617;

            color: #fff;

            border-color: #ef4444;

            box-shadow: 0 0 0 .25rem rgba(239,68,68,.15);
        }

        .form-control::placeholder {
            color: #6b7280;
        }

        /* BOTÃO */

        .btn-login {

            background: linear-gradient(135deg, #ef4444, #b91c1c);

            border: none;

            color: #fff;

            border-radius: 14px;

            padding: 14px;

            font-weight: 700;

            transition: .25s;
        }

        .btn-login:hover {

            transform: translateY(-2px);

            color: #fff;

            box-shadow:
                0 18px 35px rgba(239,68,68,.35);
        }

        /* ALERTAS */

        .alert {

            border-radius: 14px;

            border: none;

            font-size: 14px;
        }

        /* FOOTER */

        .login-footer {

            text-align: center;

            color: #6b7280;

            font-size: 13px;

            margin-top: 28px;
        }

        @media(max-width: 500px){

            .login-card{
                padding: 28px;
            }

            .brand-title{
                font-size: 28px;
            }
        }

    </style>
</head>

<body>

    <!-- FUNDO ANIMADO -->

    <div class="animated-bg">
        <div class="blob blob-1"></div>
        <div class="blob blob-2"></div>
        <div class="blob blob-3"></div>
    </div>

    <!-- LOGIN -->

    <div class="login-wrapper">

        <div class="login-card">

            <div class="brand-icon">
                <i class="bi bi-cloud-lightning-fill"></i>
            </div>

            <h1 class="brand-title">
                Fit<span>Cloud</span>
            </h1>

            <p class="brand-subtitle">
                Transformando gestão em performance
            </p>

            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">

                @csrf

                <div class="mb-3">

                    <label for="email">
                        E-mail
                    </label>

                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-control"
                        placeholder="Digite seu e-mail"
                        required
                    >
                </div>

                <div class="mb-4">

                    <label for="password">
                        Senha
                    </label>

                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Digite sua senha"
                        required
                    >
                </div>

                <button type="submit" class="btn btn-login w-100">

                    <i class="bi bi-box-arrow-in-right me-2"></i>

                    Entrar no sistema
                </button>

            </form>

            <div class="login-footer">
                © {{ date('Y') }} FitCloud • Todos os direitos reservados
            </div>

        </div>

    </div>

</body>
</html>