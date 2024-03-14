<?php

namespace App\Modules\Documentacion\Providers;

use Illuminate\Support\ServiceProvider;

class DocumentacionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'documentacion');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        /**
         * Politicas
         */

        \Livewire\Livewire::component('documentacion::politica-firma-livewire', \App\Modules\Documentacion\Livewire\PoliticaFirmaLivewire::class);

        \Livewire\Livewire::component('documentacion::parte-index-livewire', \App\Modules\Documentacion\Livewire\ParteIndexLivewire::class);
        \Livewire\Livewire::component('documentacion::parte-create-livewire', \App\Modules\Documentacion\Livewire\ParteCreateLivewire::class);
        \Livewire\Livewire::component('documentacion::parte-edit-livewire', \App\Modules\Documentacion\Livewire\ParteEditLivewire::class);
        

        /**
         * Oficina de Partes
         */


    }

    public function register()
    {
        // Registro de servicios, si es necesario
    }
}
