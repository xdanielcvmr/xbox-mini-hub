<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{

    // Salva uma nova avaliação

    public function store(Request $request, Game $game) {

        $user = auth()->user(); // <- recupera o usuário autenticado (autor da review)

        $request->validate([                               // <- validação
            'score' => 'required|integer|min:0|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        if ($game->reviews()->where('user_id', $user->id)->exists()) {              // <- impede review duplicada
            return redirect()->back()->with('error', 'Você já avaliou este jogo.');
        }

        $game->reviews()->create([  // <- cria uma nova review
            'user_id' => $user->id,
            'score'   => $request->score,
            'comment' => $request->comment,
        ]);

        $game->average_score = round($game->reviews()->avg('score'), 1);    // <- atualiza a média de reviews
        $game->save();

        return redirect()->back()->with('success', 'Review enviada com sucesso.');
    }

    // Editar uma review existente

    public function update(Request $request, Game $game, Review $review) {

        $request->validate([                            // <- validação
            'score' => 'required|integer|min:0|max:5',
            'comment' => 'nullable|string|max:500',
        ]);

        $review->update([                   // <- atualiza a review no banco
            'score'   => $request->score,
            'comment' => $request->comment,
        ]);

        $game->average_score = round($game->reviews()->avg('score'), 1); // <- recalcula a media
        $game->save();

        return redirect()->back()->with('success', 'Review atualizada com sucesso.');
    }

    // Excluir uma review

    public function destroy($gameId, $reviewId) {
    $user = auth()->user(); // recupera o usuário autenticado

    $review = Review::where('game_id', $gameId)->where('id', $reviewId)->firstOrFail(); // <- busca a review

    // regra: admin pode excluir qualquer review, usuário só a sua
    if ($user->is_admin || $review->user_id === $user->id) {
        $review->delete();

        $game = Game::findOrFail($gameId);
        $game->average_score = round($game->reviews()->avg('score'), 1);
        $game->save();

        return redirect()->back()->with('success', 'Review excluída com sucesso.');
    }

    abort(403, 'Ação não autorizada');
}

}
