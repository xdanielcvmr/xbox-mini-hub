<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Game;


class AdminController extends Controller
{
    // É executado toda vez que o controller é chamado, garantindo o acesso só para admins

    public function __construct() {                                             // <- é instaciado antes de qualquer método
        $this->middleware(function ($request, $next) {        
            if (!auth()->check() || !auth()->user()->is_admin) {                // <-  usuario logado || usuário admin
                abort(403, 'Acesso não autorizado');
            }
            return $next($request);
        });
    }

    // Exibe a listagem de jogos no painel do admin

    public function index(Request $request)
{
    $query = Game::query();

    if ($request->filled('q')) {
        $search = $request->q;  // <- armazena o valor de busca na variável search

        $query->where('name', 'like', "%{$search}%")
              ->orWhere('studio', 'like', "%{$search}%")
              ->orWhere('gender', 'like', "%{$search}%");
    }

    $games = $query->orderBy('created_at', 'desc')->paginate(10);

    return view('admin.games.index', compact('games'));
}

    // Salva um jogo no banco de dados

    public function store(Request $request) {

        $data = $request->validate([                    // <- validação dos campos
        'name'   => 'required|string|max:200',
        'studio' => 'required|string|max:200',
        'gender' => 'required|string|max:200',
        'launch' => 'required|date',
        'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'description' => 'nullable|string',
    ]);

    if ($request->hasFile('cover')) {                                   // <- verifica se foi enviado 'cover', direciona o arquivo para o caminho correto e salva no banco
        $path = $request->file('cover')->store('covers', 'public');
        $data['cover'] = $path;
    }

    Game::create($data);        // <- cria um nobo registro na tabela com os dados validados

    return redirect()->route('admin.games.index');

    }
    
    // Carrega o formulário de edição de um jogo

    public function edit($game) {

        $game = Game::findOrFail($game);                    // <- tenta encontrar o jogo pelo ID
        return view('admin.games.edit', compact('game'));
    }

    // Atualiza um jogo existente no bando de dados

    public function update(Request $request, Game $game) {
    $data = $request->validate([                // <- validação
        'name'   => 'required|string|max:200',
        'studio' => 'required|string|max:200',
        'gender' => 'required|string|max:200',
        'launch' => 'required|date',
        'cover'  => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        'description' => 'nullable|string',
    ]);

    if ($request->hasFile('cover')) {                                            // <- verifica se foi enviado um novo cover
        if ($game->cover && \Storage::disk('public')->exists($game->cover)) {   // <- confirma se o jogo já tinha um cover, e apaga o arquivo antigo, caso um novo seja enviado
            \Storage::disk('public')->delete($game->cover);
        }

        $path = $request->file('cover')->store('covers', 'public');     // <- salva o novo cover
        $data['cover'] = $path;
    }

    $game->update($data);   // <- atualiza os registros

    return redirect()->route('admin.games.index')->with('success', 'Jogo atualizado com sucesso!');
}

    // Deleta um jogo

    public function destroy($game) {
        $game = Game::findOrFail($game);  // <- acha um jogo pelo ID
        $game->delete();   // <- remove o jogo

        if ($game->cover && \Storage::disk('public')->exists($game->cover)) {   // <- verifica se havia um cover e remove
        \Storage::disk('public')->delete($game->cover);
        }

        return redirect()->route('admin.games.index')->with('success', 'Jogo excluído com sucesso.');
    }

    // Formulário de criação de jogo

    public function create() {
        return view('admin.games.create');
    }
}
