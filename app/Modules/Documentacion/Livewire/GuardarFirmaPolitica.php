<?php

namespace App\Modules\Documentacion\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Http\Request;
use App\Modules\Documentacion\Controllers\PoliticaFirma;

class GuardarFirmaPolitica extends Component
{
    /**
     * datos desde el controlador
     */
    public $token;

    /**
     * datos para la vista
     */
    public $contarPoliticaNoFirmada;
    public $contarPoliticaFirmada;
    public $rutFuncionario;
    public $nombreFuncionario;
    public $establecimientos;
    public $listasdoCheckbox;
    public $politicas;
    
    /**
     * datos desde el formulario
     */
    public $cargo;
    public $establecimiento_id;
    public $email;
    public $confirmacion;
    public $politicasId = [];
    public $seleccionar_todos = false;

    public function SeleccionarTodos()
    {
        if ($this->seleccionar_todos){
            $this->politicasId = $this->listasdoCheckbox->keys();
        }else{
            $this->politicasId = [];
        }
    }

    public function updatedPoliticasId()
    {
        if(count($this->politicasId) == count($this->listasdoCheckbox->toArray()) && 
        count(array_diff($this->politicasId, array_keys($this->listasdoCheckbox->toArray()))) == 0)
         $this->seleccionar_todos = true;
        else
            $this->seleccionar_todos = false;
        }
    public function FirmarPoliticaWebSite()
    {
        // voy a armar un objeto request con los valores del formulario
        $request = new Request([
            'cargo' => $this->cargo,
            'establecimiento_id' => $this->establecimiento_id,
            'email' => $this->email,
            'confirmacion' => $this->confirmacion,
            'politicas_seleccionadas_id' => $this->politicasId,
            'datos_politicas_seleccionadas' => $this->listasdoCheckbox,
            'nombreFuncionario' => $this->nombreFuncionario,
            'rutFuncionario' => $this->rutFuncionario,
        ]);

        $politicaFirma = new PoliticaFirma();
        $resultado = $politicaFirma->firmarPoliticasWebSite($request);

        if($resultado['estatus'] == 'error'){
            $this->dispatch('EmiteAlerta', mensaje:$resultado['mensaje'], estatus:$resultado['estatus']);
            return;
        }else{
            $this->dispatch('EmiteAlerta', mensaje:$resultado['mensaje'], estatus:$resultado['estatus']);
            //dd($resultado);
        }

        $this->reset('cargo', 'establecimiento_id', 'email', 'confirmacion', 'politicasId', 'seleccionar_todos');
        $this->DatosControllador(); 
        $this->render();
    }

    /*
    #[On('GuardarFirmarPolitica')] 
    public function FirmarPolitica()
    {
        dd($this->rutFuncionario, $this->nombreFuncionario, $this->cargo, $this->establecimiento_id);
    }*/

    public function DatosControllador(){

        $politicaFirma = new PoliticaFirma();
        $respuesta = $politicaFirma->indexWebSite($this->token);

        $this->contarPoliticaNoFirmada = $respuesta['contarPoliticaNoFirmada'];
        $this->contarPoliticaFirmada = $respuesta['contarPoliticaFirmada'];
        $this->establecimientos = $respuesta['establecimientos'];
        $this->rutFuncionario = $respuesta['rutFuncionario'];
        $this->nombreFuncionario = $respuesta['nombreFuncionario'];
        $this->politicas = $respuesta['politicas'];
        $this->listasdoCheckbox = $respuesta['listasdoCheckbox'];


    }

    public function mount()
    {
        $this->DatosControllador();        
    }

    public function render()
    {

        return view('documentacion::livewire.formulario-firma-politica-web-site');
    }
}
