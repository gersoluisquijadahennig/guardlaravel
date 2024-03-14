<?php 

namespace App\Modules\Documentacion\Livewire;

use App\Modules\Documentacion\Controllers\OficinaPartes\ParteController;
use Livewire\Component;

class ParteCreateLivewire extends Component
{
    public $token;
    public $datos;
    public $origenes;


    public function mount()
    {
        $datos = new ParteController();
        $respuesta = $datos->ListaOrigenes();

        $this->origenes = $datos->ListaOrigenes()->getData();
    }

    
    public function render()
    {
        return view('documentacion::livewire.parte-create'); 
    }
}