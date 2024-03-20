<?php

namespace App\Modules\Documentacion\Livewire;

use Livewire\Livewire;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use App\Rules\UniqueFile;
use Illuminate\Support\Facades\Validator;



use Illuminate\Validation\Rule;
use Livewire\Attributes\Validate;
use App\Modules\Documentacion\Controllers\OficinaPartes\ParteController;

class ParteCreateLivewire extends Component
{
    use WithFileUploads;

    /**
     * datos desde la vista
     */
    public $token;
    /**
     * datos formulario
     */
    public $establecimiento_id;
    public $establecimiento_destino_id;
    public $archivos = [];
    public $observaciones;
    public $correo;
    public $tipo_origen = 1;
    public $area_destino;
    public $telefono_fijo;
    public $telefono_movil;
    public $confirmacion;

    public $isDisabled = false;
    public $isDisabledArchivos = false;
    
    public $fileValidationState = '';
    public $correoValidationState = '';
    public $observacionesValidationState = '';
    public $telefonoMovilValidationState = '';
    public $telefonoFijoValidationState = '';
    public $establecimientoDestinoIdValidationState = '';
    public $establecimientoIdValidationState = '';
    public $areaDestinoValidationState = '';


    /**
     * datos Controlador
     */
    public $origenes;
    public $destinos;

    /**
     * Datos Componente
     */
    public $lista_destinos = [];
    /**
     * validaciones
     */

    public $messages = [
        'correo.required' => 'El campo correo es obligatorio',
        'correo.email' => 'El campo correo debe ser un correo electrónico',
        'correo.regex' => 'El campo correo debe ser un correo de gmail',
        'archivos.required' => 'Debe seleccionar al menos un archivo',
        'archivos.max' => 'No puede seleccionar más de 2 archivos',
        'archivos.*.mimes' => 'El archivo debe ser de tipo PDF',
        'archivos.*.max' => 'El archivo no debe pesar más de 2MB',
        'establecimiento_id.required_if' => 'El campo establecimiento es obligatorio',
        'telefono_fijo.required' => 'El campo teléfono fijo es obligatorio',
        'telefono_fijo.numeric' => 'El campo teléfono fijo debe ser un número',
        'telefono_fijo.min_digits' => 'El campo teléfono fijo debe tener 8 dígitos',
        'telefono_fijo.max_digits' => 'El campo teléfono fijo debe tener 8 dígitos',
        'telefono_movil.required' => 'El campo teléfono móvil es obligatorio',
        'telefono_movil.numeric' => 'El campo teléfono móvil debe ser un número',
        'telefono_movil.min_digits' => 'El campo teléfono móvil debe tener 9 dígitos',
        'telefono_movil.max_digits' => 'El campo teléfono móvil debe tener 9 dígitos',
        'establecimiento_destino_id.required' => 'debe seleccionar un establecimiento destino',
        'area_destino.required' => 'debe ingresar un área destino ó destinatario',
        'area_destino.regex' => 'El campo área destino no debe contener caracteres especiales',
        'observaciones.required' => 'El campo descripción es obligatorio',
        'confirmacion.accepted' => 'Debe aceptar los términos y condiciones',
    ];

    /**
     * definimos el metodo rules que se encargara de validar los campos del formulario
     */
    public function mount()
    {
        $datos = new ParteController();
        $this->origenes = $datos->ListaOrigenes()->getData();
        $this->destinos = $datos->ListadoEstablecimientos()->getData();
        $this->validarDatos();   
    }

    public function render()
    {
        return view('documentacion::livewire.parte-create');
    }

    public function AgregarDestino()
    {
        sleep(1); // simulamos una peticion al servidor
        if ($this->establecimiento_destino_id == null || $this->area_destino == null) {
            $this->dispatch('EmiteAlerta', mensaje: 'Debe Seleccionar un Destino y agregarlo a la lista', estatus: 'error');
            return;
        } else {
            $nuevoDestino = [
                'establecimiento_id' => $this->establecimiento_destino_id,
                'area' => $this->area_destino
            ];
            array_push($this->lista_destinos, $nuevoDestino);
            $this->establecimiento_destino_id = null;
            $this->area_destino = null;
        }
        $this->validarDatos();
    }

    public function EliminarDestino($establecimiento_id)
    {
        unset($this->lista_destinos[$establecimiento_id]);
        // Reindexar el array después de eliminar un elemento
        $this->lista_destinos = array_values($this->lista_destinos);
        //revisamos si el array esta vacio, para que el boton de enviar se desactive
        $this->validarDatos();
    }
    public function BuscarNombreDestino($establecimiento_id)
    {
        foreach ($this->destinos as $destino) {
            if ($destino->id == $establecimiento_id) {
                return $destino->descripcion;
            }
        }
    }    public function EliminarArchivo($nomnreArchivo)
    {
        //eliminar el archivo de array de objetos que devuelve $archivo->getFilename()
        foreach ($this->archivos as $key => $archivo) {
            if ($archivo->getFilename() == $nomnreArchivo) {
                unset($this->archivos[$key]);
                $archivo->delete();
            }
        }
        $this->validarDatos();
        
    }
    public function updated($propertyName)
    {
        $this->handleTipoOrigenUpdate($propertyName);
        $this->resetValidationStates();
        $this->validarDatos();
    }

    private function handleTipoOrigenUpdate($propertyName)
    {
        if ($propertyName == 'tipo_origen') {
            $this->isDisabled = $this->tipo_origen != 1;
            if ($this->isDisabled) {
                $this->establecimientoIdValidationState = 'is-valid';
                $this->establecimiento_id = 41;//PARTICULARES
            }
        }
    }

    private function resetValidationStates()
    {
        $this->telefonoFijoValidationState = 'is-valid';
        $this->telefonoMovilValidationState = 'is-valid';
        $this->correoValidationState = 'is-valid';
        $this->observacionesValidationState = 'is-valid';
        $this->establecimientoDestinoIdValidationState = 'is-valid';
        $this->areaDestinoValidationState = 'is-valid';
        $this->establecimientoIdValidationState = 'is-valid';
    }    
    
    protected function validarDatos()
    {
        $this->validate([
            'tipo_origen' => 'sometimes',
            'correo' => 'required|email|regex:/^[a-z0-9.]+@gmail\.com$/i',
            'establecimiento_id' => 'required_if:tipo_origen,1',
            'telefono_fijo' => 'required|max_digits:8|min_digits:8|numeric',
            'telefono_movil' => 'required|max_digits:9|min_digits:9|numeric',
            'observaciones' => 'required',
            'confirmacion' => 'accepted',
            'archivos' => ['required', 'array', 'max:2', new UniqueFile],
            'archivos.*' => 'file|mimes:pdf|max:20480',//20MB
            'establecimiento_destino_id' => Rule::requiredIf(empty($this->lista_destinos)),
            'area_destino' => [
                'sometimes', 
                Rule::requiredIf(empty($this->lista_destinos)), 
                Rule::when(empty($this->lista_destinos), ['regex:/^[a-zA-Z0-9\s]*$/i']),
            ],
        ], $this->messages);
    }
    public function Guardar()
    {
       
        $this->validarDatos();

        if (empty ($this->lista_destinos)) {
            $this->dispatch('EmiteAlerta', mensaje: 'Debe Seleccionar Al menos un Destino y agregarlo a la lista', estatus: 'error');
            return;
        }

        $datos = new Request([
            'archivos' => $this->archivos,
            'observaciones' => $this->observaciones,
            'correo' => $this->correo,
            'tipo_origen' => $this->tipo_origen,
            'establecimiento_id' => $this->establecimiento_id,
            'destinos_seleccionados' => $this->lista_destinos,
            'telefono_fijo' => $this->telefono_fijo,
            'telefono_movil' => $this->telefono_movil,
            'token' => $this->token,
            'confirmacion' => 'on',
            'ip_creacion' => request()->ip(),
            'servidor_creacion' => request()->server('SERVER_NAME'),
            'origenes' => $this->origenes,
            'destinos' => $this->destinos,

        ]);
        
        /**
         * Guardamos el parte con los datos del formulario
         */

        $parte = new ParteController();

        $resultado = $parte->store($datos)->getData();

        return redirect()->route('partes.create', ['token' => $this->token]);


        /*if ($resultado->getStatusCode() == 201) {
            $this->emit('EmiteAlerta', ['type' => 'success', 'message' => 'Parte guardado correctamente']);
            $this->reset();
        } else {
            $this->emit('EmiteAlerta', ['type' => 'error', 'message' => 'Error al guardar el parte']);
        }*/
    }
}
