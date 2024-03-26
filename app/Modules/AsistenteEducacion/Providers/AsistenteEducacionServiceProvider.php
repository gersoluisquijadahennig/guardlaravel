<?php

namespace App\Modules\AsistenteEducacion\Providers;

use Livewire\Livewire;
use Illuminate\Support\ServiceProvider;
use App\Modules\AsistenteEducacion\Livewire\MvSolicitudCambioDirector\MvSolicitudCambioDirectorLivewire;
use App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab\MvSolicitudEstabLivewire;
use App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab\FormularioVerificacionLivewire;

class AsistenteEducacionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'asistenteEducacuion');
        $this->loadViewsFrom(__DIR__.'/../Views', 'MvSolicitudEstab');
        $this->loadViewsFrom(__DIR__.'/../Views', 'MvSolicitudCambioDirector');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');
        $this->loadMigrationsFrom(__DIR__.'/../Migrations');
        Livewire::component('AsistenteEducacion::Livewire.MvSolicitudEstab.CreateLivewire', MvSolicitudEstabLivewire::class);
        Livewire::component('AsistenteEducacion::Livewire.MvSolicitudEstab.FormularioVerificacionLivewire', FormularioVerificacionLivewire::class);
        Livewire::component('AsistenteEducacion::Livewire.MvSolicitudCambioDirector.createLivewire', MvSolicitudCambioDirectorLivewire::class);
    }

    public function register()
    {
        // Registro de servicios, si es necesario
    }
}
