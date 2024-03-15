<?php 

namespace App\Modules\Documentacion\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Validate;

use App\Modules\Documentacion\Controllers\OficinaPartes\ParteController;

class ParteCreateLivewire extends Component
{
    use WithFileUploads;
    public $token;
    public $datos;
    public $origenes;
    public $establecimiento_id = '';
    public $tipo_origen;
    public $destinos;
    public $area_destino;
    public $establecimiento_destino_id;
    public $lista_destinos = [];
    #[Validate('mimes:pdf|max:2048')]
    public $archivos = [];
    #[Validate('mimes:pdf|max:2048')]
    public $archivos_temporales = [];


    public function mount()
    {
        $datos = new ParteController();
        $this->origenes = $datos->ListaOrigenes()->getData();
        $this->destinos = $datos->ListadoEstablecimientos()->getData();
    }

    public function render()
    {
        return view('documentacion::livewire.parte-create'); 
    }

    public function AgregarDestino()
    {
        $nuevoDestino = array($this->establecimiento_destino_id => $this->area_destino);
        array_push($this->lista_destinos, $nuevoDestino);
        $this->establecimiento_destino_id = '';
        $this->area_destino = '';
    }

    public function EliminarDestino($id)
    {
        unset($this->lista_destinos[$id]);
        // Reindexar el array después de eliminar un elemento
        $this->lista_destinos = array_values($this->lista_destinos);
    }
    public function BuscarNombreDestino($id)
    {
        foreach ($this->destinos as $destino) {
            if ($destino->id == $id) {
                return $destino->descripcion;
            }
        }
    }
    public function updatedArchivos($value)
    {
        
        // validamos con validate que el archivo sea pdf y no pese mas de 2MB
        $this->validate([
            'archivos.*' => 'mimes:pdf|max:2048',
        ]);

        //dd($value);
        foreach($value as $archivo){
            $hash = md5_file($archivo->getRealPath());
            if (!in_array($hash, $this->archivos_temporales)) {
                $this->archivos_temporales[] = ['hash' => $hash, 'archivo' => $archivo];
            }
        }
        $this->archivos = $this->archivos_temporales;
    }

    public function EliminarArchivo($hash)
    {
        foreach ($this->archivos_temporales as $key => $archivo) {
            if ($archivo['hash'] === $hash) {
                unset($this->archivos_temporales[$key]);
                // Reindexar el array después de eliminar un elemento
                $this->archivos_temporales = array_values($this->archivos_temporales);
                break;
            }
        }
        $this->archivos = $this->archivos_temporales;
    }


}