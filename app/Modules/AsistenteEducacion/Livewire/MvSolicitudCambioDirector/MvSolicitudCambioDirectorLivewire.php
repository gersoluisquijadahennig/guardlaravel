<?php

namespace App\Modules\AsistenteEducacion\Livewire\MvSolicitudCambioDirector;

use Livewire\Component;
use App\Rules\RutChileno;
use Illuminate\Http\Request;
use App\Modules\AsistenteEducacion\Controllers\MvSolicitudCambioDirectorController;


class MvSolicitudCambioDirectorLivewire extends Component
{
    //Datos del Solicitante
    public $rut_solicitante = '263354516';
    public $nombre_solicitante = 'GERSO LUIS';
    public $apellido_paterno_solicitante = 'QUIJADA';
    public $apellido_materno_solicitante = 'HENNIG';
    public $cargo = 'ANALISTA DE SISTEMAS';
    public $telefono_solicitante = '979727046';
    public $email_solicitante = 'GERSOLUIS@GMAIL.COM';

    //Datos del Director
    public $rut_director = '26.740.877-7';
    public $nombre_director = 'LILIANA CAROLINA';
    public $apellido_paterno_director = 'SANGUINO';
    public $apellido_materno_director = 'AGUILAR';
    public $telefono_director = '990411480';
    public $email_director = 'SANGUINO.LILI@GMAIL.COM';


    public $ValidationState = false;

    public function getFormData()
    {
        return [
            'rut_solicitante' => $this->rut_solicitante,
            'nombre_solicitante' => $this->nombre_solicitante,
            'apellido_paterno_solicitante' => $this->apellido_paterno_solicitante,
            'apellido_materno_solicitante' => $this->apellido_materno_solicitante,
            'cargo' => $this->cargo,
            'telefono_solicitante' => $this->telefono_solicitante,
            'email_solicitante' => $this->email_solicitante,
            'rut_director' => $this->rut_director,
            'nombre_director' => $this->nombre_director,
            'apellido_paterno_director' => $this->apellido_paterno_director,
            'apellido_materno_director' => $this->apellido_materno_director,
            'telefono_director' => $this->telefono_director,
            'email_director' => $this->email_director,
        ];
    }

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
        $this->ValidationState = "is-valid";
        $this->validate([
            'rut_solicitante' => ['required', 'string', 'max:12', new RutChileno],
            'nombre_solicitante' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellido_paterno_solicitante' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellido_materno_solicitante' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'cargo' => 'required|string|max:255',
            'telefono_solicitante' => 'required|digits_between:9,12',
            'email_solicitante' => 'required|email|max:255',
            'rut_director' => ['required', 'string', 'max:12', new RutChileno],
            'nombre_director' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellido_paterno_director' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'apellido_materno_director' => 'required|string|max:255|regex:/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/',
            'telefono_director' => 'required|digits_between:9,12',
            'email_director' => 'required|email|max:255'],
            $this->mensajes);
    }
    public function mount()
    {
        $this->ValidarDatos();
    }
    public function updated($propertyName)
    {
        //uppercase data
        $this->$propertyName = strtoupper($this->$propertyName);
        $this->ValidarDatos();
    }
    public function Guardar()
    {
        $this->ValidarDatos();
        $datos = new Request([$this->getFormData()]);
        $solicitud = new MvSolicitudCambioDirectorController;
        $resultado = $solicitud->store($datos);
        // retornamos a la vista anterior
        if ($resultado->getData()->estatus == 'success') {
            $this->dispatch('EmiteAlerta', mensaje: 'Solicitud guardada correctamente', estatus: 'success');
        }else{
            $this->dispatch('EmiteAlerta', mensaje: 'Error al guardar la solicitud', estatus: 'error');
        }
    }

}