<?php

namespace App\Modules\Documentacion\Controllers\OficinaPartes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Modules\Documentacion\Models\OficinaPartes\Origen;
use App\Modules\Documentacion\Models\OficinaPartes\MvSolIngDocumento;

class ParteController extends Controller
{
    public function index($token)
    {
        $partes = MvSolIngDocumento::all();
        
        return view('documentacion::OficinaPartes.partes.index', compact('token','partes'));
    }

    public function create($token)
    {
        return view('documentacion::OficinaPartes.partes.create',compact('token'));         
    }

    public function DesencriptarToken($token)
    {
        $pass = base64_encode('ssbiobiopass'.date("ymd"));
        $decryptToken = openssl_decrypt($token,"AES-256-CBC",$pass);

        if ($decryptToken === false) {

            return response()->json(['mensaje' => 'Error de desencriptación'],500);

        }

        $tokenData = json_decode($decryptToken, true);

        if ($tokenData === null) {

            return response()->json(['mensaje' => 'Token invalido'],500);
        }

        return response()->json($tokenData);
    }

    public function ListaOrigenes()
    {
        $origenes = Origen::select('ID', 'DESCRIPCION')->where('ACTIVO', 'S')->get();
        //dd($origenes);
        return response()->json($origenes);
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }



}
