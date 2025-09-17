<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{

    // Proteje as rotas que só admins podem acessar

    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->is_admin) {  // verifica se o usuário e está logado e se is_admin é true
            return $next($request);
        }

        abort(403, 'This action is unauthorized.');
    }
}
