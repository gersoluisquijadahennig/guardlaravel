<?php

namespace App\Modules\Documentacion\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentacionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'documentacion');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
    }

    public function register()
    {
        // Registro de servicios, si es necesario
    }
}
