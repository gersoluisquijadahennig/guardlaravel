<?php 

namespace App\Modules\Documentacion\Livewire;

use Livewire\Component;

class ParteIndexLivewire extends Component
{
    public $partes;
    public $token;
    public function render()
    {
        return view('documentacion::livewire.parte-index');
    }
}