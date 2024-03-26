<?php

namespace App\Modules\AsistenteEducacion\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Modules\AsistenteEducacion\Models\MvSolicitudEstab;
use App\Modules\AsistenteEducacion\Mail\ComprobanteEnvioSolicitudNuevoEstablecimientoMail;


class MvSolicitudEstabController extends Controller
{
    public function index()
    {
        $solicitudes = MvSolicitudEstab::all();
        return view('AsistenteEducacion::solicitud_establecimiento.index', compact('solicitudes'));
    }
    public function create(Request $request)
    {
        return view('MvSolicitudEstab::MvSolicitudEstab.create', ['visible' => false]);
    }
    //guardar solicitud
    public function store(Request $request)
    {
        //dd($request->input());
        \sleep(2);
        try {
            DB::beginTransaction();
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
                'ESTADO_ID' => 13,
            ]);

            //$solicitud->save();
            DB::commit();
        } catch (\Exception $e) {
            
            DB::rollBack();
            return response()->json(['mensaje' => 'Error al guardar la solicitud', 'estatus' => 'error']);
        }

         
        //enviamos correo
        //Mail::to($request->correo_solicitante)->send(new ComprobanteEnvioSolicitudNuevoEstablecimientoMail($solicitud));


        return response()->json(['mensaje' => 'Solicitud guardada correctamente', 'estatus' => 'success']);
    }
    /**
     * Servicios que se deben pasar a servicios
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
    /**
     * Servicios internos de la clase, son especificos para la clase
     */
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


