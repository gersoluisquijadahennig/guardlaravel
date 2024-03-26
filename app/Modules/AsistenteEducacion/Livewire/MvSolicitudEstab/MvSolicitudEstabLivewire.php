<?php

namespace App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab;

use Livewire\Component;
use App\Rules\RutChileno;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use Livewire\Attributes\Reactive;
use App\Modules\AsistenteEducacion\Controllers\MvSolicitudEstabController;

class MvSolicitudEstabLivewire extends Component
{

    /**
     * agregar layout
     */
    //protected $layout = 'layouts.dashboard.app';

    public $correo = 'gerso@gmail.com';
    public $nombre_establecimiento = 'escuela de prueba';
    public $telefono_establecimiento = '79797979';
    public $rut_establecimiento = '263354516';
    public $direccion_establecimiento = 'direccion de prueba';
    public $ValidationState = false;
    public $rbd_establecimiento = '263354516';
    public $rut_director = '263354516';
    public $nombre_director = 'nombre de prueba';
    public $apellido_paterno = 'apellido paterno de prueba';
    public $apellido_materno = 'apellido materno de prueba';
    public $email_director = 'email@gmail.com';
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
    public function getFormData()
    {
        return [
            'nombre_establecimiento' => $this->nombre_establecimiento,
            'telefono_establecimiento' => $this->telefono_establecimiento,
            'rut_establecimiento' => $this->rut_establecimiento,
            'direccion_establecimiento' => $this->direccion_establecimiento,
            'rbd_establecimiento' => $this->rbd_establecimiento,
            'rut_director' => $this->rut_director,
            'nombre_director' => $this->nombre_director,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'email_director' => $this->email_director,
        ];
    }
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
    public function Guardar()
    {
        $this->validarDatos();
        $datos = new Request([$this->getFormData()]);
        $solicitud = new MvSolicitudEstabController;
        $resultado = $solicitud->store($datos);

        if ($resultado->getData()->estatus == 'success') {
            $this->dispatch('EmiteAlerta', 
            mensaje: 'Solicitud de registro de establecimiento guardada correctamente, usted recibira una respuesta de su solicitud en su correo electronico dentro de las proximas 24Hrs .', 
            estatus: 'success');
            $this->resetFormulario();
        }else{
            $this->dispatch('EmiteAlerta', mensaje: 'Error al guardar la solicitud', estatus: 'error');
        }
    }
    //resetea los campos del formulario
    public function resetFormulario()
    {
        //('resetFormulario');
        foreach ($this->getFormData() as $field => $value) {
            $this->$field = null;
        }
    }
}
