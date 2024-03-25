<?php

namespace App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab;

use App\Modules\AsistenteEducacion\Controllers\MvSolicitudEstabController;
use Livewire\Component;
use App\Rules\RutChileno;
use Livewire\Attributes\On;

class FormularioVerificacionLivewire extends Component
{   
    public $rut_establecimiento = '263354516';
    public $rbd_establecimiento = '42773';
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
        $Solicitud = new MvSolicitudEstabController();
        $existeSolicitud = $Solicitud->ExisteSolicitud($this->rbd_establecimiento);
        $existeEstablecimiento = $Solicitud->ExisteEstablecimiento($this->rbd_establecimiento);
        if ($existeSolicitud) {
            $this->dispatch('EmiteAlerta', mensaje: 'Ya existe una solicitud para este establecimiento', estatus: 'error');
        } elseif (!$existeEstablecimiento) {
            $this->dispatch('EmiteAlerta', mensaje: 'El establecimiento no existe', estatus: 'error');
        } elseif ($existeEstablecimiento) {
            $this->dispatch('AlertConsulta', 
            title:"El establecimiento se encuetra registrado" , 
            text:"¿Desea realizar una solicitud de cambio de director? \n Nota: Si Ud. necesita realizar una solicitud para evaluar a su asistente de la educación, debe: \n\n\n (1) autentificarse el Director del Establecimiento o su Delegado autorizado.\n(2) seleccionar la opción “Panel - Asistente de la Educación”.",
        );
        
        }else{
            
            $this->mostrarFormulario = 2;
        }    
    }

    #[On('MostrarFormulario')]
    public function cambiarFormulario($formulario)
    {
        $this->validacionExitosa = true;
        $this->mostrarFormulario = $formulario;
    }

}