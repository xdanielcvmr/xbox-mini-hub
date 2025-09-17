<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Auth;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * O mapeamento da política para os modelos da aplicação.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Registra quaisquer serviços de autenticação / autorização.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Gate::define('isAdmin', fn($user) => (bool) $user->is_admin);

    }
}
