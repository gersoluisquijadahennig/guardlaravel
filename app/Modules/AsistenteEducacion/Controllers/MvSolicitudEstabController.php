<?php

namespace App\Modules\AsistenteEducacion\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\AsistenteEducacion\Models\MvSolicitudEstab;
use App\Modules\AsistenteEducacion\Models\MvEstablecimiento;
use Illuminate\Support\Facades\DB;


class MvSolicitudEstabController extends Controller
{
    /**
     * validamos si el Establecimiento ya cuenta con una solicitud
     */
    public function validarSolicitudEstablecimiento(Request $request)
    {
        $rbd = $request->input('rbd');
        $rbd_completo = $request->input('rbd_completo');
        $rut_estab_sin_dv = $request->input('rut_estab_sin_dv');

        $solicitudes = MvSolicitudEstab::select(DB::raw('0 AS ESTABLECIMIENTO_ID, COUNT(*) AS CONTAR_ESTAB, "SOLICITUD" AS TIPO_ESTABLECIMIENTO'))
            ->where('RBD_ESTAB', $rbd)
            ->orWhere('RBD_ESTAB', $rbd_completo)
            ->orWhere('RBD_ESTAB', $rut_estab_sin_dv)
            ->where('ESTADO_ID', 13)//INGRASADA
            ->getQuery(); // Get the underlying query to be used with union

        $establecimientos = MvEstablecimiento::select(DB::raw('ID AS ESTABLECIMIENTO_ID, COUNT(*) AS CONTAR_ESTAB, "ESTABLECIMIENTO_INGRESADO" AS TIPO_ESTABLECIMIENTO'))
            ->where('RBD', $rbd)
            ->orWhere('RBD', $rbd_completo)
            ->orWhere('RBD', $rut_estab_sin_dv)
            ->groupBy('ID')
            ->union($solicitudes)
            ->get();

        return $establecimientos;
    }
}
