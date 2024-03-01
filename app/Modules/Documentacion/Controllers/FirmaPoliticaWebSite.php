<?php

namespace App\Modules\Documentacion\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Documentacion\Models\MVUsuarioPolitica;

class FirmaPoliticaWebSite extends Controller
{
    public function index(){

        return view('documentacion::firma-politica-web-site.index');
    }

    public function DocumentacionPorFirma()
    {
        return view('documentacion::firma-politica-web-site.documentacion-por-firma');
    }

    public function DocumentacionFirmada()
    {
        return view('documentacion::firma-politica-web-site.documentacion-firmada');
    }

    public function obtenerFirmaPolitica($us_pol_id)
    {
        $firmaPolitica = MVUsuarioPolitica::with([
            'politicaVersion.politica',
            'usuario'
        ])->find($us_pol_id);

        //dd($firmaPolitica);

        // Ahora, $firmaPolitica contiene la información necesaria.

        return view('documentacion::politica-usuario.obtener', compact('firmaPolitica'));
    }
}
