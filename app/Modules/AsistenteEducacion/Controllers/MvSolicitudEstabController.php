<?php

namespace App\Modules\AsistenteEducacion\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\AsistenteEducacion\Models\MvSolicitudEstab;


class MvSolicitudEstabController extends Controller
{
    public function index()
    {
        $solicitudes = MvSolicitudEstab::all();
        return view('AsistenteEducacion::solicitud_establecimiento.index', compact('solicitudes'));
    }
    public function create(Request $request)
    {
        return view('MvSolicitudEstab::MvSolicitudEstab.create',['visible' => false]);
    }
    //guardar solicitud
    public function store(Request $request)
    {
        //dd($request->input());
        \sleep(2);
        
        $solicitud = new MvSolicitudEstab([
            'CORREO' => $request->correo,
            'NOMBRE_ESTAB' => $request->nombre_establecimiento,
            'TELEFONO_ESTAB' => $request->telefono_establecimiento,
            'RUT_ESTAB' => $request->rut_establecimiento,
            'DIRECCION_ESTAB' => $request->direccion_establecimiento,
            'RBD_ESTAB' => $request->rbd_establecimiento,
            'RUT_DIRECTOR' => $request->rut_director,
            'NOMBRE_DIRECTOR' => $request->nombre_director,
            'APELLIDO_PATERNO' => $request->apellido_paterno,
            'APELLIDO_MATERNO' => $request->apellido_materno,
            'EMAIL_DIRECTOR' => $request->email_director,
            'ESTADO_ID' => 13,//cambiar a un update
        ]);
        
        //$solicitud->save();
        
        return response()->json(['mensaje' => 'Solicitud guardada correctamente', 'estatus' => 'success']);
    }
    /**
     * Servicios
     */
    public function FormatearRut($rut)
    {
        $rut = str_replace(['.', '-'], '', $rut);        
        return $rut;
    }
    public function FormateaRbd($rbd)
    {
        $rbd = str_replace(['.', '-'], '', $rbd);
        return $rbd;
    }
    public function ExisteSolicitud($rbd)
    {
        //sleep(2);//Simulación de tiempo de respuesta (2 segundos)
        /*$rbd = $this->FormateaRbd($rbd);
        $existeSolicitud = MvSolicitudEstab::where('RBD_ESTAB', $rbd)
            ->where('ESTADO_ID', 13)//ingresada
            ->exists();
        return $existeSolicitud;*/
        return false;
    }
    public function ExisteEstablecimiento($rbd)
    {
        //sleep(2);//Simulación de tiempo de respuesta (2 segundos)
        /*$rbd = $this->FormatearRut($rbd);
        $existeEstablecimiento = MvEstablecimiento::where('RBD', $rbd)
            ->exists();
        return $existeEstablecimiento;*/
        return false;
    }
}

