<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - CustomPlay</title>
    @vite(['resources/css/login.css'])
</head>
<body class="login-page"> <header>
        <div class="header-left">
            <img src="{{ asset('images/logo.png') }}?v=2" alt="Logo">
        </div>
        <div class="header-center">
            <a href="{{ url('/') }}">Home</a>
        </div>
    </header>

    <main class="main-login">
        <div class="login-container">
            <h2>Login</h2>

            @if($errors->any())
                <div class="error">{{ $errors->first() }}</div>
            @endif

            <form method="POST" action="{{ url('/login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Senha" required>
                <button type="submit" class="btn">Entrar</button>
            </form>
            <p>Não tem conta? <a href="{{ url('/register') }}">Registre-se</a></p>
        </div>
    </main>

</body>
</html>
