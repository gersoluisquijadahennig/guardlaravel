<?php

namespace App\Modules\Documentacion\Controllers\OficinaPartes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
        $origenes = Origen::select('ID', 'DESCRIPCION')->where('ACTIVO', 'S')->orderBy('DESCRIPCION', 'ASC')->get();
        return response()->json($origenes);
    }
    public function ListadoEstablecimientos()
    {
        $establecimientos = DB::connection('oracle')
        ->table('GESTION_CENTRAL.ESTABLECIMIENTO')
        ->select('ID', 'DESCRIPCION')
        ->whereIn('ID',[197,198,200,201,202,203,204,205])
        ->orderByRaw("
                    CASE ID
                    WHEN 197 THEN 0
                    WHEN 198 THEN 1
                    ELSE ID END
                    ")
        ->get();
        return response()->json($establecimientos);
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
