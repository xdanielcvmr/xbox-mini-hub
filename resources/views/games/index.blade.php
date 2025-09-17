<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/games/style.css') }}">
    <title>Catálogo de Jogos Xbox</title>
</head>
<body>

<header class="main-header">
    <!-- Logotipos -->
    <div class="header-left">
        <img src="/images/logomicro.png" alt="Microsoft" class="logo-microsoft">
        <img src="/images/logoxbox.png" alt="Xbox" class="logo-xbox">
    </div>

    <!-- Pesquisa -->
    <div class="header-center">
        <form action="{{ route('games.index') }}" method="GET" class="search-form">
            <input type="text" name="q" placeholder="Pesquisar">
            <button type="submit"></button>
        </form>
    </div>

    <!-- Usuário -->
    <div class="header-right">
        @auth
            <span class="user-name">Bem-vindo, {{ Auth::user()->name }}</span>

            @if(Auth::user()->is_admin)
                <a href="{{ route('admin.games.index') }}" class="btn-admin">Ir para o Painel de Administrador</a>
            @endif

            <form action="/logout" method="POST" class="logout-form">
                @csrf
                <button type="submit">Sair</button>
            </form>
        @else
            <div class="auth-links">
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Registrar</a>
            </div>

        @endauth
    </div>
</header>

<h1>Catálogo de Jogos</h1>

<hr>

<!-- Cards de jogos -->
<div class="games-container" id="games-list">                   
    @include('games.partials.cards', ['games' => $games])     <!-- container onde os cards ficam -->
</div>

@if ($games->hasMorePages())  <!-- verifica se há mais páginas -->
    <div style="text-align:center; margin-top:20px;">
        <button id="load-more" data-url="{{ $games->nextPageUrl() }}">Carregar mais</button>
    </div>
@endif

<script>
document.addEventListener("DOMContentLoaded", () => {
    const loadMoreBtn = document.getElementById("load-more");   // garante que o DOM foi carregado e busca o botão, se não tiver mais páginas, encerra
    if (!loadMoreBtn) return;

    loadMoreBtn.addEventListener("click", () => {
        const url = loadMoreBtn.getAttribute("data-url");   // Recupera a url da próxima página quando o botão é clicado
        if (!url) return;

        fetch(url, { headers: { "X-Requested-With": "XMLHttpRequest" }})    // faz uma requisição ajax, para carregar mais jogos,
            .then(res => res.json())                                        // recebe retorno em json e converte em um objeto para que o front possa usar
            .then(data => {
                document.getElementById("games-list").insertAdjacentHTML("beforeend", data.html); // contém os novos cards, são injetados no final do conntainer
                if (data.next_page) {
                    loadMoreBtn.setAttribute("data-url", data.next_page);   // se existir, atualiza o data-url com a próxima URL
                } else {
                    loadMoreBtn.remove(); // remove o botão se não houver mais páginas
                }
            })
            .catch(err => console.error(err));
    });
});
</script>

</body>
</html>