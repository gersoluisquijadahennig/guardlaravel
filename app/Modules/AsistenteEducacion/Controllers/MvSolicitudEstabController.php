<?php

namespace App\Modules\AsistenteEducacion\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\AsistenteEducacion\Models\MvSolicitudEstab;
use App\Modules\AsistenteEducacion\Models\MvEstablecimiento;
use Illuminate\Support\Facades\DB;


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
        $rbd = $this->FormateaRbd($rbd);
        $existeSolicitud = MvSolicitudEstab::where('RBD_ESTAB', $rbd)
            ->where('ESTADO_ID', 13)//ingresada
            ->exists();
        return $existeSolicitud;

    }
    public function ExisteEstablecimiento($rbd)
    {
        //sleep(2);//Simulación de tiempo de respuesta (2 segundos)
        $rbd = $this->FormatearRut($rbd);
        $existeEstablecimiento = MvEstablecimiento::where('RBD', $rbd)
            ->exists();
        return $existeEstablecimiento;
    }
}

