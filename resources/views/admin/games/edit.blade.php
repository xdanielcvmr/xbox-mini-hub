<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Editar Jogo</title>
    <link rel="stylesheet" href="{{ asset('css/admin/edit.css') }}">
</head>
<body>
    <div class="admin-container">
        <h1>Editar Jogo</h1>

        <form action="{{ route('admin.games.update', $game->id) }}" method="POST" enctype="multipart/form-data" class="form-admin">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" value="{{ old('name', $game->name) }}" required>
            </div>

            <div class="form-group">
                <label for="studio">Estúdio:</label>
                <input type="text" name="studio" value="{{ old('studio', $game->studio) }}" required>
            </div>

            <div class="form-group">
                <label for="gender">Gênero:</label>
                <input type="text" name="gender" value="{{ old('gender', $game->gender) }}" required>
            </div>

            <div class="form-group">
                <label for="launch">Lançamento:</label>
                <input type="date" name="launch" value="{{ old('launch', $game->launch) }}" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" rows="5" required>{{ old('description', $game->description) }}</textarea>
            </div>

            <div class="form-group">
                <label>Capa atual:</label><br>
                @if ($game->cover)
                    <img src="{{ asset('storage/' . $game->cover) }}" alt="Capa atual do jogo" class="cover-preview" style="width:250px;">
                @else
                    <p>Sem capa</p>
                @endif
            </div>

            <div class="form-group">
                <label for="cover">Alterar capa:</label>
                <input type="file" name="cover" accept="image/*">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Atualizar</button>
                <a href="{{ route('admin.games.index') }}" class="btn-secondary">⬅ Voltar</a>
            </div>
        </form>
    </div>
</body>
</html>
