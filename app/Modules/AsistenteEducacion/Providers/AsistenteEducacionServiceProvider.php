<?php

namespace App\Modules\AsistenteEducacion\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab\CreateLivewire;

class AsistenteEducacionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'MvSolicitudEstab');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        \Livewire\Livewire::component('AsistenteEducacion::Livewire.MvSolicitudEstab.CreateLivewire', CreateLivewire::class);
    }

    public function register()
    {
        // Registro de servicios, si es necesario
    }
}
