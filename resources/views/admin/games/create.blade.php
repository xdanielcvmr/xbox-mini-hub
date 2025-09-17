<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Jogo</title>
    <link rel="stylesheet" href="{{ asset('css/admin/create.css') }}">
</head>
<body>
    <div class="form-container">
        <h1>Cadastrar Novo Jogo</h1>

        <form action="{{ route('admin.games.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Nome:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="studio">Estúdio:</label>
                <input type="text" name="studio" id="studio" required>
            </div>

            <div class="form-group">
                <label for="gender">Gênero:</label>
                <input type="text" name="gender" id="gender" required>
            </div>

            <div class="form-group">
                <label for="launch">Lançamento:</label>
                <input type="date" name="launch" id="launch" required>
            </div>

            <div class="form-group">
                <label for="description">Descrição:</label>
                <textarea name="description" id="description" rows="5"></textarea>
            </div>

            <div class="form-group">
                <label for="cover">Capa:</label>
                <input type="file" name="cover" id="cover" accept="image/*">
            </div>

            <div class="form-actions">
                <button type="submit" class="btn-primary">Salvar</button>
                <a href="{{ route('admin.games.index') }}" class="btn-secondary">⬅ Voltar ao Painel</a>
            </div>
        </form>
    </div>
</body>
</html>
