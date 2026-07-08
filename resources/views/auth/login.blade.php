<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Login | FitCloud</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root{
            --primary:#16A34A;
            --primary-hover:#15803D;
            --sidebar:#0F172A;
            --bg:#F8FAFC;
            --card:#FFFFFF;
            --border:#E5E7EB;
            --text:#334155;
            --muted:#64748B;
            --title:#0F172A;
        }
        *{box-sizing:border-box}
        body{min-height:100vh;margin:0;background:var(--bg);font-family:Inter,Arial,Helvetica,sans-serif;color:var(--text)}
        .login-shell{min-height:100vh;display:grid;grid-template-columns:.92fr 1.08fr}
        .login-brand{background:linear-gradient(180deg,#0F172A,#111827);padding:56px;display:flex;flex-direction:column;justify-content:space-between;position:relative;overflow:hidden;border-right:1px solid rgba(255,255,255,.06)}
        .brand-content{position:relative;z-index:2}.brand-logo{width:150px;height:150px;object-fit:contain;margin-bottom:34px}.brand-kicker{display:inline-flex;padding:7px 12px;border-radius:999px;background:rgba(22,163,74,.10);border:1px solid rgba(22,163,74,.18);color:#BBF7D0;font-weight:700;font-size:12px;text-transform:uppercase;letter-spacing:.08em;margin-bottom:18px}.brand-title{color:#fff;font-size:44px;font-weight:800;line-height:1.08;margin:0 0 18px;letter-spacing:-.04em}.brand-title span{color:#4ADE80}.brand-text{color:#CBD5E1;font-size:16px;line-height:1.75;max-width:560px}.brand-footer{position:relative;z-index:2;color:#94A3B8;font-size:13px}.login-panel{display:flex;align-items:center;justify-content:center;padding:48px}.login-card{width:100%;max-width:430px;background:var(--card);border:1px solid var(--border);border-radius:18px;padding:34px;box-shadow:0 14px 34px rgba(15,23,42,.06)}.card-title{font-size:30px;font-weight:800;color:var(--title);margin-bottom:8px;letter-spacing:-.03em}.card-subtitle{color:var(--muted);margin-bottom:28px;line-height:1.6}.form-label{font-weight:700;color:var(--text);margin-bottom:8px}.input-wrap{position:relative}.input-wrap i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--primary)}.form-control{height:48px;border-radius:10px;border:1px solid var(--border);padding-left:42px;color:var(--text);box-shadow:none}.form-control:focus{border-color:var(--primary);box-shadow:0 0 0 .18rem rgba(22,163,74,.10)}.toggle-password{position:absolute;right:12px;top:50%;transform:translateY(-50%);border:0;background:transparent;color:#94A3B8}.btn-login{height:48px;border:1px solid var(--primary);border-radius:10px;background:var(--primary);color:#fff;font-weight:700;box-shadow:none}.btn-login:hover{background:var(--primary-hover);border-color:var(--primary-hover);color:#fff}.alert{border-radius:12px;font-size:14px}.alert-danger{background:#FEF2F2;color:#991B1B;border:1px solid #FECACA}.alert-success{background:#F0FDF4;color:#166534;border:1px solid #BBF7D0}.login-footer{text-align:center;color:var(--muted);font-size:13px;margin-top:24px}@media(max-width:900px){.login-shell{grid-template-columns:1fr}.login-brand{display:none}.login-panel{min-height:100vh;padding:28px}}
    </style>
</head>
<body>
<div class="login-shell">
    <section class="login-brand">
        <div class="brand-content">
            <img src="{{ asset('img/logo.png') }}" alt="FitCloud" class="brand-logo">
            <div class="brand-kicker">Atualização</div>
            <h1 class="brand-title">Uma plataforma completa para <span>simplificar</span> a administração da sua academia e oferecer uma <span>gestão moderna e inteligente.</span></h1>
            <p class="brand-text">Sua academia conectada ao futuro.</p>
        </div>
        <div class="brand-footer">© {{ date('Y') }} FitCloud. Todos os direitos reservados.</div>
    </section>
    <main class="login-panel">
        <div class="login-card">
            <h1 class="card-title">Entrar no sistema</h1>
            <p class="card-subtitle">Informe suas credenciais para acessar o painel.</p>
            @if(session('error'))<div class="alert alert-danger">{{ session('error') }}</div>@endif
            @if(session('success'))<div class="alert alert-success">{{ session('success') }}</div>@endif
            <form method="POST" action="{{ route('login') }}" id="loginForm">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <div class="input-wrap"><i class="bi bi-envelope"></i><input type="email" id="email" name="email" class="form-control" placeholder="Digite seu e-mail" required autofocus></div>
                </div>
                <div class="mb-4">
                    <label for="password" class="form-label">Senha</label>
                    <div class="input-wrap"><i class="bi bi-lock"></i><input type="password" id="password" name="password" class="form-control pe-5" placeholder="Digite sua senha" required><button type="button" class="toggle-password" onclick="togglePassword()"><i class="bi bi-eye" id="eyeIcon"></i></button></div>
                </div>
                <button type="submit" class="btn btn-login w-100" id="loginButton">Entrar</button>
            </form>
            <div class="login-footer">Ambiente seguro de gerenciamento</div>
        </div>
    </main>
</div>
<script>
function togglePassword(){const p=document.getElementById('password');const e=document.getElementById('eyeIcon');if(p.type==='password'){p.type='text';e.classList.remove('bi-eye');e.classList.add('bi-eye-slash')}else{p.type='password';e.classList.remove('bi-eye-slash');e.classList.add('bi-eye')}}
document.getElementById('loginForm').addEventListener('submit',function(){const b=document.getElementById('loginButton');b.innerHTML='<span class="spinner-border spinner-border-sm me-2"></span>Entrando...';b.disabled=true;});
</script>
</body>
</html>
