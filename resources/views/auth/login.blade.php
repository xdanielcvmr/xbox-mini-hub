<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Xbox Hub</title>
    <link rel="stylesheet" href="{{ asset('css/games/loginregister.css') }}">
</head>
<body>

<header class="main-header">
    <!-- Logotipos -->
    <div class="header-left">
        <img src="/images/logomicro.png" alt="Microsoft" class="logo-microsoft">
        <img src="/images/logoxbox.png" alt="Xbox" class="logo-xbox">
    </div>

</header>

<main class="auth-container">
    <h1>Entrar</h1>

    <form method="POST" action="{{ route('login') }}" class="auth-form">
        @csrf

        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus>

        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required>

        <button type="submit" class="btn-green">Login</button>
    </form>

    <p class="auth-link">
        Não tem conta? <a href="{{ route('register') }}">Registrar</a>
    </p>
</main>

</body>
</html>
