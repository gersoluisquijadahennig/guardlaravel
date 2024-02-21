<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Auth\SimpleHasher;
use App\Guards\CustomMD5Auth;
use Illuminate\Support\Facades\Auth;
use App\Auth\CustomEloquentUserProvider;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];
    
    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->app['auth']->provider('CustomEloquent', function ($app, array $config) {
            $model=$app['config']['auth.providers.users.model'];
            return new CustomEloquentUserProvider($app['hash'], $model);
        });
    }
}
