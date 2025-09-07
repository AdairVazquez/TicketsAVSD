<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // Gates por rol
        Gate::define('is-admin', function ($user) {
            return $user->rol_id === 1;
        });

        Gate::define('is-soporte', function ($user) {
            return $user->rol_id === 2;
        });

        Gate::define('is-cliente', function ($user) {
            return $user->rol_id === 3;
        });
    }
}
