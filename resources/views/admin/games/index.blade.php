<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Painel de administração - Jogos</title>
    <link rel="stylesheet" href="{{ asset('css/admin/admin.css') }}">
</head>
<body>

    <header class="admin-header">
    <h1>Painel de Administração - Jogos</h1>
    <div class="admin-actions">
        <form action="{{ route('admin.games.index') }}" method="GET" class="search-form">
            <input type="text" name="q" value="{{ request('q') }}" placeholder="Pesquisar">
            <button type="submit"></button>
        </form>

        <a href="{{ route('admin.games.create') }}" class="btn-green">+ Novo Jogo</a>
    </div>
</header>

    <main class="admin-container">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Capa</th>
                    <th>Título</th>
                    <th>Estúdio</th>
                    <th>Gênero</th>
                    <th>Lançamento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($games as $game)
                <tr>
                    <td>
                        @if ($game->cover)
                            <img src="{{ asset('storage/' . $game->cover) }}" alt="Capa" width="80">
                        @else
                            <span class="no-cover">Sem capa</span>
                        @endif
                    </td>
                    <td>{{ $game->name }}</td>
                    <td>{{ $game->studio }}</td>
                    <td>{{ $game->gender }}</td>
                    <td>{{ \Carbon\Carbon::parse($game->launch)->format('d/m/Y') }}</td>
                    <td class="actions">
                        <a href="{{ route('games.show', $game->id ) }}" class="btn-view">Ver</a>
                        <a href="{{ route('admin.games.edit', $game->id ) }}" class="btn-edit">Editar</a>
                        <form action="{{ route('admin.games.destroy', $game->id) }}" method="POST" class="inline-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-delete" onclick="return confirm('Tem certeza que deseja excluir este jogo?')">Excluir</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    <div class="pagination">
        {{ $games->links('vendor.pagination.default') }}

    </div>

    </main>

</body>
</html>
