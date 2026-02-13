<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('order.view', function ($user) {
            return $user->role->role_orders >= 1;
        });

        Gate::define('order.create', function ($user) {
            return $user->role->role_orders >= 2;
        });

        Gate::define('order.edit', function ($user) {
            return $user->role->role_orders >= 2;
        });

        Gate::define('order.delete', function ($user) {
            return $user->role->role_orders >= 3;
        });
    }
}
