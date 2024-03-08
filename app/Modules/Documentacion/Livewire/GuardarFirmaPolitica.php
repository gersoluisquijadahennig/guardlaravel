<?php

namespace App\Modules\Documentacion\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use App\Modules\Documentacion\Controllers\PoliticaFirma;

class GuardarFirmaPolitica extends Component
{
    /**
     * datos desde el controlador
     */
    public $contarPoliticaNoFirmada ;
    public $contarPoliticaFirmada;
    public $rutFuncionario;
    public $nombreFuncionario;
    public $establecimientos;
    public $politicas;
    
    /**
     * datos desde el formulario
     */
    public $cargo;
    public $establecimiento_id;
    public $email;
    public $confirmacion;
    public $politicas_seleccionadas_id = [];

    public $dato;

    public function ObtenerDatosCheckbox($dato)
    {
        $this->dato = $dato;
    }


    public function FirmarPoliticaWebSite()
    {
        dd($this->rutFuncionario,
        $this->nombreFuncionario,
        $this->cargo, 
        $this->establecimiento_id,
        $this->email,
        $this->confirmacion,
        $this->politicas_seleccionadas_id,
        $this->dato,

    );
    }

    #[On('GuardarFirmarPolitica')] 
    public function FirmarPolitica()
    {
        dd($this->rutFuncionario, $this->nombreFuncionario, $this->cargo, $this->establecimiento_id);
    }

    public function mount()
    {
        //
    }

    public function render()
    {
        return view('documentacion::livewire.formulario-firma-politica-web-site');
    }
}
