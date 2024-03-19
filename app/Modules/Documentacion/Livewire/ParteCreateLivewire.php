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
    public $archivos = [];
    public $archivos_temporales = [];
    public $observaciones = '';
    public $correo = '';
    public $correoValidationState = null;
    public $tipo_origen = 1;
    public $establecimiento_id = '';
    public $establecimientoIdValidationState = false;
    public $establecimiento_destino_id = null;
    public $establecimientoDestinoIdValidationState = null;
    //agregar area o destino, es un string sin caracteres especiales
    public $area_destino;
    public $areaDestinoValidationState = null;
    public $telefono_fijo = '';
    public $telefonoFijoValidationState = null;
    public $telefono_movil = '';
    public $telefonoMovilValidationState = null;
    public $isDisabled = false;
    public $isDisabledArchivos = false;
    public $confirmacion = false;
    public $fileValidationState = '';
    public $observacionesValidationState = '';


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

        sleep(1);//simulamos una peticion al servidor
        if($this->establecimiento_destino_id == null || $this->area_destino == null){
            $this->dispatch('EmiteAlerta', mensaje: 'Debe Seleccionar un Destino y agregarlo a la lista', estatus: 'error');
            return;
        }else{
            $nuevoDestino = array($this->establecimiento_destino_id => $this->area_destino);
            array_push($this->lista_destinos, $nuevoDestino);
            $this->establecimiento_destino_id = null;
            $this->area_destino = null;
        }
        $this->validarDatos();
    }

    public function EliminarDestino($id)
    {
        unset($this->lista_destinos[$id]);
        // Reindexar el array después de eliminar un elemento
        $this->lista_destinos = array_values($this->lista_destinos);
        //revisamos si el array esta vacio, para que el boton de enviar se desactive
        $this->validarDatos();
    }
    public function BuscarNombreDestino($id)
    {
        foreach ($this->destinos as $destino) {
            if ($destino->id == $id) {
                return $destino->descripcion;
            }
        }
    }
    public function EliminarArchivo($nomnreArchivo)
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
    public function updatedTipoOrigen()
    {
        if ($this->tipo_origen == 2) {
            $this->establecimiento_id = null;
        }
        $this->validarDatos();
    }
    public function updated()
    {
        $this->validarDatos();
    }
    protected function validarDatos()
    {
        $validator = Validator::make([
            'tipo_origen' => $this->tipo_origen,
            'correo' => $this->correo,
            'establecimiento_id' => $this->establecimiento_id,
            'telefono_fijo' => $this->telefono_fijo,
            'telefono_movil' => $this->telefono_movil,
            'observaciones' => $this->observaciones,
            'confirmacion' => $this->confirmacion,
            'archivos' => $this->archivos,
            'establecimiento_destino_id' => $this->establecimiento_destino_id,
            'area_destino' => $this->area_destino,
        ], [
            'correo' => 'required|email|regex:/^[a-z0-9.]+@gmail\.com$/i',
            'establecimiento_id' => 'required_if:tipo_origen,1',
            'telefono_fijo' => 'required|max_digits:8|min_digits:8|numeric',
            'telefono_movil' => 'required|max_digits:9|min_digits:9|numeric',
            'observaciones' => 'required',
            'confirmacion' => 'required|accepted',
            'archivos' => ['required', 'array', 'max:2', new UniqueFile],
            'archivos.*' => 'file|mimes:pdf|max:2048',

        ], $this->messages);

        $validator->sometimes('establecimiento_destino_id', 'required', function ($input) {
            return empty ($this->lista_destinos);
        });

        $validator->sometimes('area_destino', 'required|regex:/^[a-zA-Z0-9\s]*$/i', function ($input) {
            return empty ($this->lista_destinos);
        });


        $validator->validate();
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
            'destinos' => $this->lista_destinos,
            'telefono_fijo' => $this->telefono_fijo,
            'telefono_movil' => $this->telefono_movil,
            'token' => $this->token,
        ]);
        /**
         * guardamos los archivos en el servidor pero necesitamos el id del parte para guardar los archivos
         */

        foreach ($this->archivos as $archivo) {
            $nombre = $archivo->getClientOriginalName();//recuperamos el archivo nombre original
            $archivo->storeAs(path: 'documentos', name: $nombre);//aqui guardamos el archivo en el servidor
        }
        //borramos los archivos temporales

        foreach ($this->archivos as $archivo) {
            $archivo->delete();
        }

        return redirect()->route('partes.create', ['token' => $this->token]);

        $parte = new ParteController();

        $resultado = $parte->store($datos);
        
       /* necesito redireccionar a la vista principal
        http://10.8.117.183:8082/web/partes/create/tokenPrueba*/

        




        return $resultado;

        /*if ($resultado->getStatusCode() == 201) {
            $this->emit('EmiteAlerta', ['type' => 'success', 'message' => 'Parte guardado correctamente']);
            $this->reset();
        } else {
            $this->emit('EmiteAlerta', ['type' => 'error', 'message' => 'Error al guardar el parte']);
        }*/
    }
}