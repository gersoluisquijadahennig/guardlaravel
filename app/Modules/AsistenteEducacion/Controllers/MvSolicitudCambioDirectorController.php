<?php

namespace App\Modules\AsistenteEducacion\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\AsistenteEducacion\Models\MvSolicitudCambioDirector;

class MvSolicitudCambioDirectorController extends Controller
{
    public function index()
    {
        return view('AsistenteEducacion::solicitud_cambio_director.index');
    }
    public function create()
    {
        return view('MvSolicitudCambioDirector::MvSolicitudCambioDirector.create',['visible' => false]);
    }
    //guardar solicitud
    public function store(Request $request)
    {
        //dd($request->input());
        \sleep(2);
        
        $solicitud = new MvSolicitudCambioDirector([
            'RUT_SOLICITANTE' => $request->rut_solicitante,
            'NOMBRE_SOLICITANTE' => $request->nombre_solicitante,
            'APELLIDO_PATERNO_SOLICITANTE' => $request->apellido_paterno_solicitante,
            'APELLIDO_MATERNO_SOLICITANTE' => $request->apellido_materno_solicitante,
            'CARGO' => $request->cargo,
            'TELEFONO_SOLICITANTE' => $request->telefono_solicitante,
            'EMAIL_SOLICITANTE' => $request->email_solicitante,
            'RUT_DIRECTOR' => $request->rut_director,
            'NOMBRE_DIRECTOR' => $request->nombre_director,
            'APELLIDO_PATERNO_DIRECTOR' => $request->apellido_paterno_director,
            'APELLIDO_MATERNO_DIRECTOR' => $request->apellido_materno_director,
            'TELEFONO_DIRECTOR' => $request->telefono_director,
            'EMAIL_DIRECTOR' => $request->email_director,
            'ESTADO_ID' => 13,//cambiar a un update
        ]);
        
        //$solicitud->save();
        
        return response()->json(['mensaje' => 'Solicitud guardada correctamente', 'estatus' => 'success']);
    }
    //editar solicitud
    public function edit($id)
    {
        $solicitud = MvSolicitudCambioDirector::find($id);
        return view('MvSolicitudCambioDirector::MvSolicitudCambioDirector.edit', compact('solicitud'));
    }
    //actualizar solicitud
    public function update(Request $request, $id)
    {
        $solicitud = MvSolicitudCambioDirector::find($id);
        $solicitud->update([
            'RUT_SOLICITANTE' => $request->rut_solicitante,
            'NOMBRE_SOLICITANTE' => $request->nombre_solicitante,
            'APELLIDO_PATERNO_SOLICITANTE' => $request->apellido_paterno_solicitante,
            'APELLIDO_MATERNO_SOLICITANTE' => $request->apellido_materno_solicitante,
            'CARGO' => $request->cargo,
            'TELEFONO_SOLICITANTE' => $request->telefono_solicitante,
            'EMAIL_SOLICITANTE' => $request->email_solicitante,
            'RUT_DIRECTOR' => $request->rut_director,
            'NOMBRE_DIRECTOR' => $request->nombre_director,
            'APELLIDO_PATERNO_DIRECTOR' => $request->apellido_paterno_director,
            'APELLIDO_MATERNO_DIRECTOR' => $request->apellido_materno_director,
            'TELEFONO_DIRECTOR' => $request->telefono_director,
            'EMAIL_DIRECTOR' => $request->email_director,
            'ESTADO_ID' => 13,
        ]);        
        
        $solicitud->save();
        return redirect()->route('solicitud_cambio_director.index');
    }
    //eliminar solicitud
    public function destroy($id)
    {
        $solicitud = MvSolicitudCambioDirector::find($id);
        $solicitud->delete();
        return redirect()->route('solicitud_cambio_director.index');
    }

}