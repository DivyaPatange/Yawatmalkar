<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('manage-users', function($user){
            return $user->hasAnyRoles(['doctor','lawyer']);
        });

        Gate::define('manage-roles', function($user){
            return $user->hasAnyRoles(['doctor','lawyer', 'beautician']);
        });

        Gate::define('manage-beauty', function($user){
            return $user->hasRole(['beautician']);
        });

        Gate::define('manage-provider', function($user){
            return $user->hasRole(['provider']);
        });
    }
}
