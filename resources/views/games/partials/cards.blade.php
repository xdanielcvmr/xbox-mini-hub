@foreach ($games as $game)
    <a href="{{ route('games.show', $game->id) }}" class="game-card">    
        <div>
            @if ($game->cover)
                <img src="{{ asset('storage/' . $game->cover) }}" alt="Capa de {{ $game->name }}">
            @else
                <p>Sem capa</p>
            @endif
            <h3>{{ $game->name }}</h3>
        </div>
    </a>
@endforeach
