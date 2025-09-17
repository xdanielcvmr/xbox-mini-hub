<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $game->name }} - Catálogo Xbox</title>
    <link rel="stylesheet" href="{{ asset('css/games/show.css') }}">
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

<div class="back-link">
    <a href="{{ route('games.index') }}" class="botton-back">⬅ Voltar ao catálogo</a>
    @auth
        @if(Auth::user()->is_admin)
            <a href="{{ route('admin.games.index') }}" class="botton-back">⬅ Voltar ao Painel de Administração</a>
        @endif
    @endauth
</div>

<main class="game-show-container">
    <div class="game-header">
        @if ($game->cover)
            <img src="{{ asset('storage/' . $game->cover) }}" alt="Capa de {{ $game->name }}" class="game-cover">
        @endif

        <div class="game-info">
            <h1>{{ $game->name }}</h1>
            <p><strong>Estúdio:</strong> {{ $game->studio }}</p>
            <p><strong>Gênero:</strong> {{ $game->gender }}</p>
            <p><strong>Lançamento:</strong> {{ \Carbon\Carbon::parse($game->launch)->format('d/m/Y') }}</p>
            <p><strong>Média das avaliações:</strong> {{ $game->average_score }}/5</p>
        </div>
    </div>

    @if ($game->description)
        <div class="game-description">
            <h3>Descrição</h3>
            <p>{{ $game->description }}</p>
        </div>
    @endif

    <hr>

    <h2>Avaliações</h2>

    @auth
        @if(Auth::user()->is_admin)
            <p>Administradores não podem criar ou editar reviews.</p>
        @else
            @php
                $userReview = $game->reviews()->where('user_id', auth()->id())->first();
            @endphp

            <div class="review-form">
                @if ($userReview)
                    <!-- Editar review -->
                    <form action="{{ route('reviews.update', [$game->id, $userReview->id]) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <label for="score">Nota (0-5):</label>
                        <input type="number" name="score" min="0" max="5" value="{{ $userReview->score }}" required>

                        <label for="comment">Comentário:</label>
                        <textarea name="comment" rows="3">{{ $userReview->comment }}</textarea>

                        <button type="submit">Atualizar Review</button>
                    </form>

                    <!-- Excluir review -->
                    <form action="{{ route('reviews.destroy', [$game->id, $userReview->id]) }}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Tem certeza que deseja excluir sua review?')">Excluir Review</button>
                    </form>
                @else
                    <!-- Criar review -->
                    <form action="{{ route('reviews.store', $game->id) }}" method="POST">
                        @csrf

                        <label for="score">Nota (0-5):</label>
                        <input type="number" name="score" min="0" max="5" required>

                        <label for="comment">Comentário:</label>
                        <textarea name="comment" rows="3"></textarea>

                        <button type="submit">Enviar Review</button>
                    </form>
                @endif
            </div>
        @endif
    @else
        <p><a href="{{ route('login') }}">Faça login</a> para avaliar este jogo.</p>
    @endauth

    <hr>

    <div class="reviews-list">
    <h3>Reviews dos jogadores</h3>
    @if ($reviews->isEmpty())
        <p>Este jogo ainda não possui reviews.</p>
    @else
        @foreach ($reviews as $review)
            <div class="review-card">
                <div class="review-content">
                    <strong>{{ $review->user->name }}</strong>  
                    — Nota: {{ $review->score }}  
                    @if ($review->comment)
                        <p>{{ $review->comment }}</p>
                    @endif
                    <small>Postado em {{ $review->created_at->format('d/m/Y H:i') }}</small>
                </div>

                @auth
                    @if(Auth::user()->is_admin)
                        <form action="{{ route('reviews.destroy', [$game->id, $review->id]) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete"
                                onclick="return confirm('Tem certeza que deseja excluir esta review?')">
                                Excluir Review
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        @endforeach
    @endif
    </div>


</main>

</body>
</html>
