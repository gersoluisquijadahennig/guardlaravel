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
        $validacionInicial = $this->validarSolicitudEstablecimiento($request->RBD);
        if($validacionInicial['existeEstablecimiento']){
            return response()->json(['mensaje' => 'Ya existe un establecimiento con el RBD ingresado','estatus'=>'error'], 400);
        }
        if($validacionInicial['existeSolicitud']){
            return response()->json(['mensaje' => 'Ya existe una solicitud con el RBD ingresado','estatus'=>'error'], 400);
        }

        return view('MvSolicitudEstab::MvSolicitudEstab.create');
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
        $rbd = $this->FormateaRbd($rbd);
        $existeSolicitud = MvSolicitudEstab::where('RBD_ESTAB', $rbd)
            ->where('ESTADO_ID', 13)//ingresada
            ->exists();
        return $existeSolicitud;
    }
    public function ExisteEstablecimiento($rbd)
    {
        $rbd = $this->FormatearRut($rbd);
        $existeEstablecimiento = MvEstablecimiento::where('RBD', $rbd)
            ->exists();
        return $existeEstablecimiento;
    }
    public function validarSolicitudEstablecimiento($rbd)
    {
        $existeEstablecimiento = false;
        $existeSolicitud = false;
        if($this->ExisteEstablecimiento($rbd)){
            $existeEstablecimiento = true;
        }
        if($this->ExisteSolicitud($rbd)){
            $existeSolicitud = true;
        }
        return [
            'existeEstablecimiento' => $existeEstablecimiento,
            'existeSolicitud' => $existeSolicitud
        ];
    }
}
