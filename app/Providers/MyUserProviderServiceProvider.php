<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Providers\MyUserProvider;

class MyUserProviderServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->bind('UserPanel', function ($app) {
            return new MyUserProvider(); // Ajusta las dependencias según sea necesario
        });
    }
}
