<?php

namespace App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab;

use Livewire\Component;
use App\Rules\RutChileno;
use Livewire\Attributes\On;

class FormularioVerificacionLivewire extends Component
{
    public $rut_establecimiento = '263354516';
    public $rbd_establecimiento = '263354516';
    public $ValidationState = false;
    
    public $disabled = false;
    public $validacionExitosa = false;

    public $mostrarFormulario = 0;
    public $visible = false;

    public $mensajes = [
        'rut_establecimiento.required' => 'El rut del establecimiento es requerido',
        'rbd_establecimiento.required' => 'El rbd del establecimiento es requerido',
    ];
    public function mount()
    {
        $this->validarDatos();
    }

    public function render()
    {
        return view('MvSolicitudEstab::Livewire.formulario-verificacion-livewire');
    }
    public function updated($propertyName)
    {
        $this->validarDatos();
    }


    public function validarDatos()
    {
        $this->ValidationState = "is-valid";
        $this->validate([
            'rut_establecimiento' => ['required','string','regex:/^[A-Za-z0-9-.]+$/','max:12',new RutChileno],
            'rbd_establecimiento' => ['required','string','regex:/^[A-Za-z0-9-.]+$/','max:12',new RutChileno],
        ], $this->mensajes);
    }
    public function verificarSolicitud()
    {
        // Aquí puedes verificar los datos del usuario
        // Por ejemplo, puedes comprobar si los valores de $rut_establecimiento y $rbd_establecimiento cumplen ciertas condiciones
        if (($this->rut_establecimiento === '263354516') && ($this->rbd_establecimiento === '263354516')) {
            $this->mostrarFormulario = 1;
            $this->dispatch('EmiteAlerta', mensaje: 'Validacion Exitosa', estatus: 'success');
        } else {
            $this->mostrarFormulario = 2;
            //$this->dispatch('EmiteAlerta', mensaje: 'Los datos ingresados no son válidos', estatus: 'error');
        }   
    }


}