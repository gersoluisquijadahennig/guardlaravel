<?php

namespace App\Modules\AsistenteEducacion\Livewire\MvSolicitudEstab;

use Livewire\Component;
use App\Rules\RutChileno;
use PHPUnit\TextUI\Configuration\DirectoryCollectionIterator;

class CreateLivewire extends Component
{
    public $correo = '';
    public $nombre_establecimiento = '';
    public $nombreEstablecimientoValidationState = false;
    public $telefono_establecimiento = '';
    public $telefonoEstablecimientoValidationState = false;
    public $rut_establecimiento = '';
    public $rutEstablecimientoValidationState = false;
     
    public $direccion_establecimiento = '';
    public $direccionEstablecimientoValidationState = false;
    public $rbd_establecimiento = '';
    public $rbdEstablecimientoValidationState = false;
    public $rut_director = '';
    public $rutDirectorValidationState = false;
    public $nombre_director = '';
    public $nombreDirectorValidationState = false;
    public $apellido_paterno = '';
    public $apellidoPaternoValidationState = false;
    public $apellido_materno = '';
    public $apellidoMaternoValidationState = false;
    public $email_director = '';
    public $emailDirectorValidationState = false;

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
        return view('MvSolicitudEstab::Livewire.create-livewire');
    }
    public function mount()
    {
        $this->validarDatos();
    }
    protected function validarDatos()
    {
        $this->validate([
            'nombre_establecimiento' => 'required|string|max:255',
            'telefono_establecimiento' => 'required|digits_between:7,15',
            'rut_establecimiento' => ['required','string','max:12',new RutChileno],
            'direccion_establecimiento' => 'required|string|max:255',
            'rbd_establecimiento' => 'required|integer',
            'rut_director' => ['required','string','max:12',new RutChileno],
            'nombre_director' => 'required|string|max:255',
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'email_director' => 'required|email|max:255',
        ], $this->mensajes);    }

    public function updated($propertyName)
    {
        $this->resetValidacionDatos();
        $this->validarDatos();
    }
    public function resetValidacionDatos()
    {
        $this->nombreEstablecimientoValidationState = 'is-valid';
        $this->telefonoEstablecimientoValidationState = 'is-valid';
        $this->rutEstablecimientoValidationState = 'is-valid';
        $this->direccionEstablecimientoValidationState = 'is-valid';
        $this->rbdEstablecimientoValidationState = 'is-valid';
        $this->rutDirectorValidationState = 'is-valid';
        $this->nombreDirectorValidationState = 'is-valid';
        $this->apellidoPaternoValidationState = 'is-valid';
        $this->apellidoMaternoValidationState = 'is-valid';
        $this->emailDirectorValidationState = 'is-valid';
    }
    public function validaRutChileno()
    {
        $rut = $this->rut_establecimiento;
        $rut = str_replace(['.', '-'], '', $rut);
        $rut = substr($rut, 0, -1);
        $dv = substr($rut, -1);
        $rut = strrev($rut);
        $multiplicador = 2;
        $suma = 0;
        for ($i = 0; $i < strlen($rut); $i++) {
            $suma += $rut[$i] * $multiplicador;
            $multiplicador++;
            if ($multiplicador > 7) {
                $multiplicador = 2;
            }
        }
        $resto = $suma % 11;
        $dvCalculado = 11 - $resto;
        if ($dvCalculado == 11) {
            $dvCalculado = 0;
        }
        if ($dvCalculado == 10) {
            $dvCalculado = 'K';
        }
        if ($dv == $dvCalculado) {
            $this->rutEstablecimientoValidationState = 'is-valid';
        } else {
            $this->rutEstablecimientoValidationState = 'is-invalid';
        }
    }
}
