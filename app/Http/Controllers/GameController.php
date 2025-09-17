<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Listar os jogos, pesquisa e paginação
    public function index(Request $request) {
    $query = Game::query();

    if ($request->filled('q')) {                                    // <- validação
        $query->where('name', 'like', '%' . $request->q . '%')
              ->orWhere('studio', 'like', '%' . $request->q . '%')
              ->orWhere('gender', 'like', '%' . $request->q . '%');
    }

    $games = $query->orderBy('launch', 'desc')      // <- ordena e pagina
                   ->paginate(9);

    if ($request->ajax()) {     // <-verifica se a requisição é do tipo ajax.
        return response()->json([   // <- cria uma resposta JSON
            'html' => view('games.partials.cards', compact('games'))->render(), // <- recebe o html pronto para injetar no dom, sem recriar a logica
            'next_page' => $games->nextPageUrl() // <- carrega mais resultados automaticamente
        ]);
    }

    return view('games.index', compact('games'));
    
    }

    // Exibe a página individual de um jogo

    public function show($id) {

        $game = Game::with(['reviews.user'])->findOrFail($id); // <- procura o jogo pelo ID, carrega as reviews e os usuários donos das reviews

        $reviews = $game->reviews->sortbyDesc('created_at'); // <- ordena as reviews

        $media = round($game->reviews->avg('nota'), 1); // <- media de todas as reviews

        return view('games.show', compact('game', 'reviews', 'media'));
    }

}
