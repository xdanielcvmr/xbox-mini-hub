<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar - Xbox Hub</title>
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
    <h1>Criar Conta</h1>

    <form method="POST" action="{{ route('register') }}" class="auth-form">
        @csrf

        <label for="name">Nome</label>
        <input id="name" type="text" name="name" value="{{ old('name') }}" required>

        <label for="email">E-mail</label>
        <input id="email" type="email" name="email" value="{{ old('email') }}" required>

        <label for="password">Senha</label>
        <input id="password" type="password" name="password" required>

        <label for="password_confirmation">Confirmar Senha</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required>

        <button type="submit" class="btn-green">Registrar</button>
    </form>

    <p class="auth-link">
        Já tem conta? <a href="{{ route('login') }}">Entrar</a>
    </p>
</main>

</body>
</html>
