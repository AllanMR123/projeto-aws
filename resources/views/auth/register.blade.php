<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar - CustomPlay</title>
    @vite(['resources/css/login.css'])
</head>
<body class="auth-page"> <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo">
        </div>
        <div class="header-center">
            <a href="{{ url('/') }}">Home</a>
        </div>
    </header>

    <main class="auth-main">
        <div class="login-container">
            <h2>Criar Conta</h2>

            @if($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ url('/register') }}">
                @csrf
                <input type="text" name="name" placeholder="Nome completo" required>
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Senha" required>
                <input type="password" name="password_confirmation" placeholder="Confirmar senha" required>
                <button type="submit" class="btn">Registrar</button>
            </form>
            <p>Já tem uma conta? <a href="{{ url('/login') }}">Login</a></p>
        </div>
    </main>

</body>
</html>
