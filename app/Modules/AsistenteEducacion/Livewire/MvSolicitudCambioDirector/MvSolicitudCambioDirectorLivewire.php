<?php

namespace App\Modules\AsistenteEducacion\Livewire\MvSolicitudCambioDirector;

use Livewire\Component;
use App\Rules\RutChileno;

class MvSolicitudCambioDirectorLivewire extends Component
{
    //Datos del Solicitante
    public $rut_solicitante = '';
    public $nombre_solicitante = '';
    public $apellido_paterno_solicitante = '';
    public $apellido_materno_solicitante = '';
    public $cargo = '';
    public $telefono_solicitante = '';
    public $email_solicitante = '';

    //Datos del Director
    public $rut_director = '';
    public $nombre_director = '';
    public $apellido_paterno_director = '';
    public $apellido_materno_director = '';
    public $telefono_director = '';
    public $email_director = '';


    public $ValidationState = false;

    public function render()
    {
        return view('MvSolicitudCambioDirector::Livewire.MvSolicitudCambioDirector.create-livewire');
    }

    public $mensajes = [
        'rut_solicitante.required' => 'El rut del solicitante es requerido',
        'nombre_solicitante.required' => 'El nombre del solicitante es requerido',
        'apellido_paterno_solicitante.required' => 'El apellido paterno del solicitante es requerido',
        'apellido_materno_solicitante.required' => 'El apellido materno del solicitante es requerido',
        'cargo.required' => 'El cargo del solicitante es requerido',
        'telefono_solicitante.required' => 'El teléfono del solicitante es requerido',
        'email_solicitante.required' => 'El email del solicitante es requerido',
        'rut_director.required' => 'El rut del director es requerido',
        'nombre_director.required' => 'El nombre del director es requerido',
        'apellido_paterno_director.required' => 'El apellido paterno del director es requerido',
        'apellido_materno_director.required' => 'El apellido materno del director es requerido',
        'telefono_director.required' => 'El teléfono del director es requerido',
        'email_director.required' => 'El email del director es requerido',
    ];

    public function  ValidarDatos()
    {
        $this->validate([
            'rut_solicitante' => ['required','string','regex:/^[A-Za-z0-9-.]+$/','max:12',new RutChileno],
            'nombre_solicitante' => 'required|string|max:255',
            'apellido_paterno_solicitante' => 'required|string|max:255',
            'apellido_materno_solicitante' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'telefono_solicitante' => 'required|string|max:255',
            'email_solicitante' => 'required|string|max:255',
            'rut_director' => ['required','string','regex:/^[A-Za-z0-9-.]+$/','max:12',new RutChileno],
            'nombre_director' => 'required|string|max:255',
            'apellido_paterno_director' => 'required|string|max:255',
            'apellido_materno_director' => 'required|string|max:255',
            'telefono_director' => 'required|string|max:255',
            'email_director' => 'required|string|max:255',
        ],$this->mensajes);
    }

    public function mount()
    {
        $this->ValidarDatos();
    }

    public function updated($propertyName)
    {
        $this->ValidarDatos();
    }


}