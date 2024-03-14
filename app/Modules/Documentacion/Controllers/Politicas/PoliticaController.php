<?php

namespace App\Modules\Documentacion\Controllers\Politicas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Documentacion\Models\TbPolitica;

class PoliticaController extends Controller
{

    public function index()
    {
        $politicas = TbPolitica::all();
        return view('documentacion::politica.index', compact('politicas'));
    }
    public function editarPolitica($id){

        $politica = TbPolitica::find($id);
        return view('documentacion::politica.editar', compact('politica'));
    }

    public function actualizarPolitica(Request $request, $id){

        $request->validate([
            'nombre' => 'required|min:5|max:255',
            'descripcion' => 'required|min:20|max:255',
        ],
        [
            'nombre.required' => 'El nombre es requerido',
            'nombre.min' => 'El nombre debe tener al menos 5 caracteres',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'descripcion.required' => 'La descripción es requerida',
            'descripcion.min' => 'La descripción debe tener al menos 20 caracteres',
            'descripcion.max' => 'La descripción no puede tener más de 255 caracteres',
        ]);


        $update = TbPolitica::where('ID', $id)->update([
            'NOMBRE' => $request->nombre,
            'DESCRIPCION' => $request->descripcion,
            'ACTIVO' => $request->activo,
            'DEPENDENCIA_ESTABLECIMIENTO_ID' => $request->dependencia_establecimiento_id,
            'IP_MOD' => $request->ip(),
            'SERVIDOR_MOD' => $request->server('SERVER_NAME'),
            //'USUARIO_MOD' => auth()->user()->id,
            //'PERSONA_MOD' => auth()->user()->id,
            'USUARIO_MOD_ID' => 590,
            'PERSONAS_MOD' => 590,

        ]);

        if(!$update){
            $request->session()->flash('error', 'No se ha podido actualizar la POLITICA');
            return back();
        } else {

            $request->session()->flash('success', 'La POLITICA se ha actualizado exitosamente.');
        }

        return redirect()->route('politica.index');
      
    }

    public function crearPolitica(){

        return view('documentacion::politica.crear');
    }

    public function guardarPolitica(Request $request){

        $request->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
            'dependencia_establecimiento_id' => 'required',
        ],
        [
            'nombre.required' => 'El nombre es requerido',
            'descripcion.required' => 'La descripción es requerida',
            'dependencia_establecimiento_id.required' => 'La dependencia es requerida',
        ]);

        //dd( $request->all() );
        
    $create = TbPolitica::create([
        'NOMBRE' => $request->nombre,
        'DESCRIPCION' => $request->descripcion,
        'ACTIVO' => $request->activo,
        //'dependencia_establecimiento_id' => $request->dependencia_establecimiento_id,
        'DEPENDENCIA_ESTABLECIMIENTO_ID' => 531,
        //'usuario_crea_id' => auth()->user()->id,
        'USUARIO_CREA_ID' => 900,
        'IP_CREA' => $request->ip(),
        'SERVIDOR_CREA' => gethostname(),
        //'persona_crea_id' => auth()->user()->id,
        'PERSONA_CREA_ID' => 900,
        // Agrega otros campos según sea necesario
    ]);

    if(!$create){
        $request->session()->flash('error', 'No se ha podido guardar la POLITICA');
        return back();
    } else {

        $request->session()->flash('success', 'La POLITICA se ha Guardado exitosamente.');
    }


        return redirect()->route('politica.index');
    }

    public function eliminarPolitica($id){
        
        
        $deleted = TbPolitica::where('ID',$id)->delete();


        return redirect()->route('politica.index');
    }
   
}   
