<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;

use App\Auth\CustomGuard;
use Illuminate\Support\Facades\Auth;
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
        Auth::provider('MyUserProvider', function (Application $app, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\UserProvider...
 
            return new MyUserProvider($app->make('oracle'));
        });

        Auth::extend('custom', function (Application $app, string $name, array $config) {
            // Return an instance of Illuminate\Contracts\Auth\Guard...
 
            return new CustomGuard(Auth::createUserProvider($config['provider'], null));
        });
    }

}
