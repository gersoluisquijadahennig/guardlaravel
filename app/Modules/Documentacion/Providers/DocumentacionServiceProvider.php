<?php

namespace App\Modules\Documentacion\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Documentacion\Livewire\ParteEditLivewire;
use App\Modules\Documentacion\Livewire\ParteIndexLivewire;
use App\Modules\Documentacion\Livewire\ParteCreateLivewire;
use App\Modules\Documentacion\Livewire\PoliticaFirmaLivewire;

class DocumentacionServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../Views', 'documentacion');
        $this->loadRoutesFrom(__DIR__.'/../Routes/web.php');

        /**
         * Politicas
         */

        \Livewire\Livewire::component('documentacion::politica-firma-livewire', PoliticaFirmaLivewire::class);

        \Livewire\Livewire::component('documentacion::parte-index-livewire', ParteIndexLivewire::class);
        \Livewire\Livewire::component('documentacion::parte-create-livewire', ParteCreateLivewire::class);
        \Livewire\Livewire::component('documentacion::parte-edit-livewire', ParteEditLivewire::class);
        

        /**
         * Oficina de Partes
         */


    }

    public function register()
    {
        // Registro de servicios, si es necesario
    }
}
