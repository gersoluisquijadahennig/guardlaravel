<?php

namespace App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Rules\RutChileno;
use Livewire\Attributes\On;

class MvSolicitudEstabLivewire extends Component
{

    /**
     * agregar layout
     */
    //protected $layout = 'layouts.dashboard.app';

    public $correo = '';
    public $nombre_establecimiento = '';
    public $telefono_establecimiento = '';
    public $rut_establecimiento = '';
    public $direccion_establecimiento = '';
    public $ValidationState = false;
    public $rbd_establecimiento = '';
    public $rut_director = '';
    public $nombre_director = '';
    public $apellido_paterno = '';
    public $apellido_materno = '';
    public $email_director = '';
    public $mostrarFormularioExistente = false;
    public $verificacion = '';
    public $disabled = false;
    public $validacionExitosa = false;
    public $mostrarFormularioSolicitudCambioDirector = false;
    public $visible = false;
    public $mensajes = [
        'nombre_establecimiento.required' => 'El nombre del establecimiento es requerido',
        'telefono_establecimiento.required' => 'El teléfono del establecimiento es requerido',
        'rut_establecimiento.required' => 'El rut del establecimiento es requerido',
        'direccion_establecimiento.required' => 'La dirección del establecimiento es requerida',
        'rbd_establecimiento.required' => 'El rbd del establecimiento es requerido',
        'rut_director.required' => 'El rut del director es requerido',
        'nombre_director.required' => 'El nombre del director es requerido',
        'apellido_paterno.required' => 'El apellido paterno del director es requerido',
        'apellido_materno.required' => 'El apellido materno del director es requerido',
        'email_director.required' => 'El email del director es requerido',
    ];
    public function render()
    {
        return view('MvSolicitudEstab::Livewire.MvSolicitudEstab.create-livewire');
    }
    public function mount()
    {
        $this->validarDatos();
    }
    protected function validarDatos()
    {
        $this->ValidationState = "is-valid";
        $this->validate([
            'nombre_establecimiento' => 'required|string|max:255',
            'telefono_establecimiento' => 'required|digits_between:7,15',
            'rut_establecimiento' => ['required','string','regex:/^[A-Za-z0-9-.]+$/','max:12',new RutChileno],
            'direccion_establecimiento' => 'required|string|max:255',
            'rbd_establecimiento' => ['required','string','regex:/^[A-Za-z0-9-.]+$/','max:12',new RutChileno],
            'rut_director' => ['required','string','regex:/^[A-Za-z0-9-.]+$/','max:12',new RutChileno],
            'nombre_director' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email_director' => 'required|email|max:255',
        ], $this->mensajes);    
    }
    public function updated($propertyName)
    {
        $this->validarDatos();
    }
    public function updateRutEstablecimiento($value)
    {
        $this->rut_establecimiento = $value;
    }
    public function updateRbdEstablecimiento($value)
    {
        $this->rbd_establecimiento = $value;
    }

}
