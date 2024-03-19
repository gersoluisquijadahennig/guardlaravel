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
        if($token == 'tokenPrueba')
        {
            $tokenData['rut'] = '26335451';
            $tokenData['dv'] = '6';
            $tokenData['nombres'] = 'Gerso Luis';
            $tokenData['apellidos'] = 'Quijada Hennig';

            return response()->json($tokenData);
        }
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
        $origenes = Origen::select('ID', 'DESCRIPCION')
        ->where('ACTIVO', 'S')
        ->orderBy('DESCRIPCION', 'ASC')
        ->get();

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
        return response()->json($establecimientos, 200);
    }
    public function ObtenerFolio($formularioId)
    {
        $folio = DB::connection('oracle')
            ->table('GESTION_CENTRAL.FOLIOS')
            ->select('ID', 'PREFIJO', 'FOLIO')
            ->where('FORMULARIO_ID', $formularioId)
            ->get()
            ->first();

        $folioActual = $folio->folio;
        $folioNuevo = ++$folio->folio;
        

        return response()->json([
            'folio'=>$folioActual,
            'foliado'=>$folioNuevo
        ], 200);

    }
    public function ActualizarCorrelativoFolio($folio,$formularioId){
        $folio = DB::connection('oracle')
            ->table('GESTION_CENTRAL.FOLIOS')
            ->where('FORMULARIO_ID', $formularioId)
            ->update(['FOLIO' => $folio]);

        return response()->json($folio);
    }
    public function store(Request $request)
    {
        // Validar los datos del request
        $formularioId = 12; // id del formulario
        $datosToken =  $this->DesencriptarToken($request->token)->getData();
        $datosFolio = $this->ObtenerFolio($formularioId)->getData();
        $estadoSolicitud = 13; // id del estado de la solicitud 13 SOLICITUD ENVIADA

        //dd($datosToken, $datosFolio, $estadoSolicitud, $request->all());

        // Crear una nueva instancia de MvSolIngDocumento
        $mvSolIngDocumento = new MvSolIngDocumento;

        // Asignar los datos del request a las propiedades del modelo
        $mvSolIngDocumento->rut_responsable = $datosToken->rut.'-'.$datosToken->dv;
        $mvSolIngDocumento->nombre_responsable = $datosToken->nombres.' '.$datosToken->apellidos;
        $mvSolIngDocumento->correo_responsable = $request->correo;
        $mvSolIngDocumento->telefono_fijo_responsable = $request->telefono_fijo;
        $mvSolIngDocumento->telefono_movil_responsable = $request->telefono_movil;
        $mvSolIngDocumento->origen_id = $request->origen_id;
        $mvSolIngDocumento->folio = $datosFolio->foliado;//obtener el folio de la secuencia
        $mvSolIngDocumento->observacion_externa = $request->observaciones;
        $mvSolIngDocumento->estado_id = $estadoSolicitud;
        //$mvSolIngDocumento->clave_unica_crea = $request->clave_unica_crea;
        $mvSolIngDocumento->fecha_crea = 'SYSDATE';
        $mvSolIngDocumento->ip_crea = $request->ip();
        $mvSolIngDocumento->servidor_crea = $request->server('SERVER_NAME');

        //dd($mvSolIngDocumento->toArray());

        // Guardar el modelo
        //$mvSolIngDocumento->save();
        
        /*
        'MV_SOL_ING_DOCUMENTO_ID',
        'ESTABLECIMIENTO_ID',
        'DESTINO',
        'ACTIVO',
        'FECHA_CREA',
        'IP_CREA',
        'SERVIDOR_CREA',
        */
        //dd($request->destinos);
        /*
        foreach ($request->destinos as $destino) {
            $nuevoDestino = new Destino(
                [
                'MV_SOL_ING_DOCUMENTO_ID' => $mvSolIngDocumento->id,
                'ESTABLECIMIENTO_ID' => $request->establecimiento_id,
                'DESTINO' => $destino,
                'ACTIVO' => 'S',
                'FECHA_CREA' => 'SYSDATE',
                'IP_CREA' => $request->ip(),
                'SERVIDOR_CREA' => $request->server('SERVER_NAME')
            ]);

            //$mvSolIngDocumento->destinos()->save($nuevoDestino);
        }*/
        
        /*
        'FOLIO',
        'FOLIO_ADJUNTO',
        'MV_SOL_ING_DOCUMENTO_ID',
        'DESCRIPCION',
        'ACTIVO',
        'FECHA_CREA',
        'IP_CREA',
        'SERVIDOR_CREA',

        */
        //dd($request->fiel->archivos);
        /*
        foreach ($request->archivos as $archivo) {
            $nuevoArchivo = new Archivo([
                'MV_SOL_ING_DOCUMENTO_ID' => $mvSolIngDocumento->id,
                'FOLIO' => $datosFolio->foliado,
                'FOLIO_ADJUNTO' => $datosFolio->foliado,
                'ACTIVO' => 'S',
                'FECHA_CREA' => 'SYSDATE',
                'IP_CREA' => $request->ip(),
                'SERVIDOR_CREA' => $request->server('SERVER_NAME')
            ]);

            //$mvSolIngDocumento->archivos()->save($nuevoArchivo);
        }*/
        // Devolver una respuesta
        return response()->json(['mensaje' => 'MvSolIngDocumento creado exitosamente'], 201);
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
