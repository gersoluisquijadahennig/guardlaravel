<?php

namespace App\Modules\Documentacion\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Documentacion\Livewire\Counter;

class DocumentacionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'documentacion');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        \Livewire\Livewire::component('documentacion::guardar-firma-politica', \App\Modules\Documentacion\Livewire\GuardarFirmaPolitica::class);
        \Livewire\Livewire::component('documentacion::counter', Counter::class);


    }

    public function register()
    {
        // Registro de servicios, si es necesario
    }
}
