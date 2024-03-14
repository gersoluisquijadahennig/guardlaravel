<?php

namespace App\Modules\Documentacion\Controllers\Politicas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Documentacion\Models\TbPoliticaVersion;

class PoliticaVersionController extends Controller
{
    public function index()
    {
        $versiones = TbPoliticaVersion::all();
        return view('documentacion::politica-version.index', compact('versiones')); 
    }
}
