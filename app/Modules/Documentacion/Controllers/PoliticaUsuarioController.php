<?php

namespace App\Modules\Documentacion\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Documentacion\Models\MVUsuarioPolitica;

class PoliticaUsuarioController extends Controller
{
    public function index()
    {
        $usuariosPoliticas = MVUsuarioPolitica::all();
        return view('documentacion::politica-usuario.index', compact('usuariosPoliticas'));
    }
}
