<?php 

namespace App\Modules\Documentacion\Livewire;

use Livewire\Livewire;
use Livewire\Component;
use Illuminate\Http\Request;
use Livewire\Attributes\On; 
use Livewire\WithFileUploads;


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
    #[Validate([
        'archivos' => 'required|max:2048',
        'archivos.*' => 'required|mimes:pdf|max:2048',
    ], message: [
        'required' => 'El documento es requerido.',
        'archivos.required' => 'Debe Seleccionar por lo menos un Archivo.',
        'archivos.mimes' => 'El archivo tiene un error, tiene que ser un archivo de tipo :values.',
        'archivos.mimes.*' => 'Uno de los archivo tiene un error , tiene que ser un archivo de tipo :values.',
    ])]
    public $archivos = [];
    public $archivos_temporales = [];
    public $observaciones = '';
    public $correo = 'gerso@gmail.com';
    public $correoValidationState = null;
    public $tipo_origen = 1;
    public $establecimiento_id = 361;
    public $establecimientoIdValidationState = null;
    public $establecimiento_destino_id = null;
    public $establecimientoDestinoIdValidationState = null;
    //agregar area o destino, es un string sin caracteres especiales
    public $area_destino;
    public $areaDestinoValidationState = null;
    public $telefono_fijo = '12345678';
    public $telefonoFijoValidationState = null;
    public $telefono_movil = '123456789';
    public $telefonoMovilValidationState = null;
    public $isDisabled = true;
    public $isDisabledArchivos = true;
    public $confirmacion = false;


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
    ];

    /**
     * definimos el metodo rules que se encargara de validar los campos del formulario
     */
    public function mount()
    {
        $datos = new ParteController();
        $this->origenes = $datos->ListaOrigenes()->getData();
        //dd($this->origenes);
        $this->destinos = $datos->ListadoEstablecimientos()->getData();

    }

    public function render()
    {
        /**
         * necesito que al renderizar valide de una vez el formulario
         */
        return view('documentacion::livewire.parte-create'); 
    }

    /**
     * agregamos un metodo para refrescar el 
     */

    public function AgregarDestino()
    {
        sleep(1);

  
        
        $nuevoDestino = array($this->establecimiento_destino_id => $this->area_destino);
        array_push($this->lista_destinos, $nuevoDestino);
        $this->establecimiento_destino_id = null;
        $this->area_destino = null;
        $this->areaDestinoValidationState = $this->getErrorBag()->has('area_destino') ? 'is-invalid' : 'is-warning';
        $this->establecimientoDestinoIdValidationState = $this->getErrorBag()->has('establecimiento_destino_id') ? 'is-invalid' : 'is-warning';
    }

    public function EliminarDestino($id)
    {
        unset($this->lista_destinos[$id]);
        // Reindexar el array después de eliminar un elemento
        $this->lista_destinos = array_values($this->lista_destinos);
        //revisamos si el array esta vacio, para que el boton de enviar se desactive
        

    }
    public function BuscarNombreDestino($id)
    {
        foreach ($this->destinos as $destino) {
            if ($destino->id == $id) {
                return $destino->descripcion;
            }
        }
    }


    /**
     * metodo que cuando actualice el tipo de origen, reinicie la lista de destinos
     */
    public function updatedTipoOrigen()
    {
        /**
         * cuando es persona natural es decir 2, entonces que no valide el establecimiento y que lo deje en null
         */
        if ($this->tipo_origen == 2) {
            $this->establecimiento_id = null;

        } 
    }
    public function EliminarArchivo($nomnreArchivo)
    {
        //eliminar el archivo de array de objetos que devuelve $archivo->getFilename()
        foreach ($this->archivos as $key => $archivo) {
            if ($archivo->getFilename() == $nomnreArchivo) {
                unset($this->archivos[$key]);
            }
        }        
    }
    /**
     * guardamos los datos del formulario
     */
    public function Guardar()
    {
        $this->validate();
   
        dd($this->archivos, $this->observaciones, $this->correo, $this->tipo_origen, $this->establecimiento_id, $this->lista_destinos, $this->telefono_fijo, $this->telefono_movil);
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
        
        $parte = new ParteController();
        $resultado = $parte->store($datos);
        if ($resultado->getStatusCode() == 201) {
            $this->emit('EmiteAlerta', ['type' => 'success', 'message' => 'Parte guardado correctamente']);
            $this->reset();
        } else {
            $this->emit('EmiteAlerta', ['type' => 'error', 'message' => 'Error al guardar el parte']);
        }
    }
}