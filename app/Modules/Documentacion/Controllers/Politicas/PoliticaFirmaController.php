<?php

namespace App\Modules\Documentacion\Controllers\Politicas;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Queue;
use App\Modules\Documentacion\Mail\PoliticaFirmaMail;
use App\Modules\Documentacion\Models\Politicas\MVUsuarioPolitica;
use Illuminate\Mail\Attachment;



/**
 * recordar
 * el tema de la encriptacion 
 * el tema de autenticación, cuando el usuario es un usuario panel
 */


class PoliticaFirmaController extends Controller
{
    public function index($token){
        return view('documentacion::politicas.politica-firma.index', compact('token'));
    }

    public function indexWebSite($token)
    {
        
        if($token === 'tokenPrueba'){
            $tokenData['rut'] = '26335451';
            $tokenData['dv'] = '6';
        }else{
        
            if(empty($token)){
                // enviar a la pagina de error
                //event(new ErrorOccurred('Error de desencriptación'));
            }
            $pass = base64_encode('ssbiobiopass'.date("ymd"));
            $decryptToken = openssl_decrypt($token,"AES-256-CBC",$pass);

            if ($decryptToken === false) {
                // enviar a la pagina de error
                //event(new ErrorOccurred('Error de desencriptación'));
            }

            $tokenData = json_decode($decryptToken, true);

            if ($tokenData === null) {
                // enviar una alerta de que el token no es valido
                //event(new ErrorOccurred('Error de desencriptación'));
            }
        }

        $resultadoRutServicio = $this->rutServicio($tokenData['rut'], $tokenData['dv']);

        if (empty($resultadoRutServicio)) {
            //event(new ErrorOccurred('Error de desencriptación'));
            return [
                'estatus' => 500,
                'mensaje' => 'El usuario no existe en la base de datos del sistema admistrativo del Servicio de Salud Biobío'];
        }

        $rutCompleto = $resultadoRutServicio->rut.$resultadoRutServicio->dv;
        $nombreCompleto = $resultadoRutServicio->nombre.' '.$resultadoRutServicio->apellido_pat.' '.$resultadoRutServicio->apellido_mat;


        $politicas = $this->ListadoPoliticas($rutCompleto);
        $politicasSeleccionCheckbox = $this->MapParaCheck($politicas);
        $contarPoliticaFirmada = $this->ContarPoliticasFirmadas($politicas);
        $contarPoliticaNoFirmada = $this->ContarPoliticasNoFirmadas($politicas);
        $establecimientos = $this->Establecimientos();

        return [
            'politicas' => $politicas,
            'establecimientos' => $establecimientos,
            'contarPoliticaFirmada' => $contarPoliticaFirmada,
            'contarPoliticaNoFirmada'=> $contarPoliticaNoFirmada,
            'rutFuncionario' => $rutCompleto, 
            'nombreFuncionario' => $nombreCompleto, 
            'listasdoCheckbox' => $politicasSeleccionCheckbox,
            'estatus' => 200,
        ];
    }

    public function ListadoPoliticas($rut_completo = null)
    {
        $resultados = DB::connection('oracle')->table('BIBLIOTECA_VIRTUAL.TB_POLITICA AS P')
            ->select([
                'P.ID AS POLITICA_ID',
                'PV.ID AS POLITICA_VERSION_ID',
                'PVE.ID AS POLITICA_VERSION_ESTAB_ID',
                'P.NOMBRE',
                'P.DESCRIPCION',
                'P.DEPENDENCIA_ESTABLECIMIENTO_ID',
                'PV.VERSION',
                'PV.RUTA_ARCHIVO',
                'PV.TIPO_POLITICA',
                'PV.COMPROBANTE',
                'PV.ARCHIVO_COMPROBANTE',
                'PV.TB_TIPO_CORREO_ID',
                'PVE.ESTABLECIMIENTO_ID',
                DB::raw("CASE WHEN UP.ID IS NULL THEN 0 ELSE UP.ID END AS USUARIO_POLITICA_ID"),
                DB::raw("TO_CHAR(UP.FECHA_CREA,'DD/MM/RRRR') AS DIA_CREA"),
                DB::raw("TO_CHAR(UP.FECHA_CREA,'HH24:MI') AS HORA_CREA"),
                'PV.ALCANCE',
                'PV.POLITICA_EXTERNA',
                'PV.POLITICA_INTERNA',
                'PV.NOTIFICA_CORREO',
                DB::raw("CASE WHEN UP.FIRMADO IS NULL THEN 'N' ELSE UP.FIRMADO END AS FIRMADO"),
            ])
            ->join('BIBLIOTECA_VIRTUAL.TB_POLITICA_VERSION AS PV', function ($join) {
                $join->on('P.ID', '=', 'PV.TB_POLITICA_ID')
                    ->where('PV.ACTIVO', '=', 'S');
            })
            ->join('BIBLIOTECA_VIRTUAL.TB_POLITICA_VERSION_ESTAB AS PVE', function ($join) {
                $join->on('PVE.TB_POLITICA_VERSION_ID', '=', 'PV.ID')
                    ->where('PVE.ACTIVO', '=', 'S')
                    ->where('PV.POLITICA_EXTERNA', '=', 'S');
            })
            ->Join('BIBLIOTECA_VIRTUAL.MV_USUARIO_POLITICA AS UP', function ($join) use ($rut_completo) {
                $join->on('UP.TB_POLITICA_VERSION_ID', '=', 'PV.ID')
                    ->where('UP.ACTIVO', '=', 'S')
                    ->where('UP.RUT_FUNCIONARIO', '=', '' . $rut_completo . '');
            })
            ->where('PV.POLITICA_EXTERNA', '=', 'S')
            ->orderByDesc('PVE.ID')
            ->get();

            $this->MapParaCheck($resultados);

            return $resultados;

    }

    public function MapParaCheck($listadoPoliticas){


        /**
         * pendiente intentar realizar esta transformacion en un resource
         */
        //dd($listadoPoliticas);
        $map = [];
        foreach ($listadoPoliticas as $politica){
            $map[$politica->usuario_politica_id] = [
                'politica_id' => $politica->politica_id,
                'politica_version_id' => $politica->politica_version_id,
                'politica_version_estab_id' => $politica->politica_version_estab_id,
                'nombre' => $politica->nombre,
                'descripcion' => $politica->descripcion,
                'dependencia_establecimiento_id' => $politica->dependencia_establecimiento_id,
                'version' => $politica->version,
                'ruta_archivo' => $politica->ruta_archivo,
                'tipo_politica' => $politica->tipo_politica,
                'comprobante' => $politica->comprobante,
                'archivo_comprobante' => $politica->archivo_comprobante,
                'tb_tipo_correo_id' => $politica->tb_tipo_correo_id,
                'establecimiento_id' => $politica->establecimiento_id,
                'usuario_politica_id' => $politica->usuario_politica_id,
                'dia_crea' => $politica->dia_crea,
                'hora_crea' => $politica->hora_crea,
                'alcance' => $politica->alcance,
                'politica_externa' => $politica->politica_externa,
                'politica_interna' => $politica->politica_interna,
                'notifica_correo' => $politica->notifica_correo,
                'firmado' => $politica->firmado

            ];
        }
        //dd($map);
        return collect($map)->map(function ($item) {
            return (object) $item;
        });
    }

    public function ContarPoliticasFirmadas($listadoPoliticas){
        $contarPoliticaFirmada = 0;
        foreach ($listadoPoliticas as $politica){
            if ($politica->firmado == 'S'){
                $contarPoliticaFirmada++;
            }
        }

        return $contarPoliticaFirmada;
    }

    public function ContarPoliticasNoFirmadas($listadoPoliticas){
        $contarPoliticaNoFirmada = 0;
        foreach ($listadoPoliticas as $politica){
            if ($politica->firmado == 'N'){
                $contarPoliticaNoFirmada++;
            }
        }

        return $contarPoliticaNoFirmada;
    }

    public function UsarioPolitica($us_pol_id)
    {
        $resultados = DB::connection('oracle')->table('BIBLIOTECA_VIRTUAL.TB_POLITICA as P')
            ->select(
                'P.ID',
                'P.NOMBRE',
                'P.DESCRIPCION',
                'PV.tipo_politica',
                'PV.RUTA_ARCHIVO',
                'PV.COMPROBANTE',
                'PV.ARCHIVO_COMPROBANTE',
                DB::raw('CASE WHEN UP.ID IS NULL THEN 0 ELSE UP.ID END as USUARIO_POLITCA_ID'),
                'UP.ID as USUARIO_POLITICA_ID',
                DB::raw("TO_CHAR(UP.FECHA_CREA,'DD/MM/RRRR') as DIA_CREA"),
                DB::raw("TO_CHAR(UP.FECHA_CREA,'HH24:MI') as HORA_CREA"),
                DB::raw("TO_CHAR(UP.FECHA_CREA,'DD/MM/RRRR HH24:MI:SS') as FECHA_CREA"),
                'UP.CODIGO_VERIFICACION',
                DB::raw("CASE WHEN USUARIO_ID IS NULL THEN UP.RUT_FUNCIONARIO ELSE US.RUN END as RUN"),
                DB::raw("CASE WHEN USUARIO_ID IS NULL THEN UP.NOMBRE_FUNCIONARIO ELSE US.ALIAS END as ALIAS"),
                'PV.ALCANCE',
                'PV.POLITICA_EXTERNA',
                'PV.POLITICA_INTERNA',
                DB::raw("CASE WHEN UP.FIRMADO IS NULL THEN 'N' ELSE UP.FIRMADO END as FIRMADO")
            )
            ->join('BIBLIOTECA_VIRTUAL.TB_POLITICA_VERSION as PV', function ($join) {
                $join->on('P.ID', '=', 'PV.TB_POLITICA_ID')->where('PV.ACTIVO', '=', 'S');
            })
            ->join('BIBLIOTECA_VIRTUAL.MV_USUARIO_POLITICA as UP', 'UP.TB_POLITICA_VERSION_ID', '=', 'PV.ID')
            ->leftJoin('BIBLIOTECA_VIRTUAL.USUARIO_PANEL as US', 'US.ID', '=', 'UP.USUARIO_ID')
            ->where('UP.ID', '=', $us_pol_id)
            ->get();

            return $resultados;
    }

    public function versionPolitica($politicaVersionId)
    {
        $result = DB::connection('oracle')->table('BIBLIOTECA_VIRTUAL.TB_POLITICA as P')
            ->select(
                'P.ID as POLITICA_ID',
                'PV.ID as POLITICA_VERSION_ID', 
                'PVE.ID as POLITICA_VERSION_ESTAB_ID', 
                'P.NOMBRE', 
                'P.DESCRIPCION', 
                'P.DEPENDENCIA_ESTABLECIMIENTO_ID', 
                'PV.VERSION', 
                'PV.RUTA_ARCHIVO', 
                'PV.TIPO_POLITICA', 
                'PV.COMPROBANTE', 
                'PV.NOTIFICA_CORREO', 
                'PV.ARCHIVO_COMPROBANTE', 
                'PVE.ESTABLECIMIENTO_ID', 
                'D.DESCRIPCION as DEPENDENCIA', 
                'E.DESCRIPCION as ESTABLECIMIENTO')
            ->join('BIBLIOTECA_VIRTUAL.TB_POLITICA_VERSION as PV', 'P.ID', '=', 'PV.TB_POLITICA_ID')
            ->join('BIBLIOTECA_VIRTUAL.TB_POLITICA_VERSION_ESTAB as PVE', 'PVE.TB_POLITICA_VERSION_ID', '=', 'PV.ID')
            ->join('GESTION_CENTRAL.DEPENDENCIA_ESTABLECIMIENTO as D', 'D.ID', '=', 'P.DEPENDENCIA_ESTABLECIMIENTO_ID')
            ->join('GESTION_CENTRAL.ESTABLECIMIENTO as E', 'E.ID', '=', 'PVE.ESTABLECIMIENTO_ID')
            ->where('PV.ACTIVO', 'S')
            ->where('PVE.ACTIVO', 'S')
            ->where('PV.ID', $politicaVersionId)
            ->get();
    }

    public function rutServicio($rut, $dv)
    {
        $resultado = DB::connection('oracle')->table('REFCENTRAL.MV_RUT_SERVICIO')
            ->select('RUT', 'DV', 'NOMBRE', 'APELLIDO_PAT', 'APELLIDO_MAT')
            ->where('RUT', $rut)
            ->whereRaw("UPPER(DV) = UPPER(?)", [$dv])
            ->where('SERVICIO_WEB_ID', 3)
            ->first();

            return $resultado;
    }
    
    public function Establecimientos()
    {
        $establecimientos = DB::connection('oracle')->table('GESTION_CENTRAL.ESTABLECIMIENTO')
            ->select('ID', 'DESCRIPCION')
            ->where('ESTADO_ID', '=', '5')
            ->where('SERVICIO_SALUD_ID', '=', 1)
            ->orderBy('DESCRIPCION', 'ASC')
            ->get();

        return $establecimientos;
    }

    public function firmarPoliticasWebSite(Request $request) 
    {

        //dd($request->all());
        
        $validator = $request->validate([
            'cargo' => 'required',
            'establecimiento_id' => 'required',
            'email' => 'required|email|regex:/(.*)@(?!ssbiobio\.cl$).*/i',
            'confirmacion' => 'accepted',
            'politicas_seleccionadas_id' => 'required',
        ],
        [
            'cargo.required' => 'El cargo es requerido',
            'establecimiento_id.required' => 'El establecimiento es requerido',
            'email.required' => 'El email es requerido',
            'email.email' => 'El email no es valido',
            'email.exists' => 'El email no existe en nuestra base de datos',
            'confirmacion.accepted' => 'Es necesario confirmar haber leído las Políticas',
            'email.regex' => 'El email no es valido No puede ser un correo institucional',
            'politicas_seleccionadas_id.required' => 'Es necesario aceptar las Políticas',
        ],

        );

        $fecha = DB::connection('oracle')->table('dual')->select([
            DB::raw("TO_CHAR(sysdate, 'DD') as dia"),
            DB::raw("TO_CHAR(sysdate, 'MM') as mes"),
            DB::raw("TO_CHAR(sysdate, 'YYYY') as anho"),
            DB::raw("TO_CHAR(sysdate, 'HH24') as hora"),
            DB::raw("TO_CHAR(sysdate, 'MI') as minuto"),
            DB::raw("TO_CHAR(sysdate, 'SS') as segundo"),
            DB::raw("TO_CHAR(sysdate, 'DD/MM/RRRR') as dia_completo"),
            DB::raw("TO_CHAR(sysdate, 'HH24:MI:SS') as hora_completa"),
            DB::raw("TO_CHAR(sysdate, 'DD/MM/RRRR HH24:MI:SS') as dia_hora")
        ])->first();

        
        $codigo_verficacion = [
            'rutFuncionario' => $request->rutFuncionario,
            'nombreFuncionario' => $request->nombreFuncionario,
            'dia' => $fecha->dia,
            'mes' => $fecha->mes,
            'anho' => $fecha->anho,
            'hora' => $fecha->hora,
            'minuto' => $fecha->minuto,
            'segundo' => $fecha->segundo,
        ];


        //$codigo_verficacion = Crypt::encryptString(json_encode($codigo_verficacion));
        $codigo_verificacion_md5 = md5(json_encode($codigo_verficacion));
        $codigo_verficacion_md5_rev = strrev($codigo_verificacion_md5);
        /*
        foreach ($request->datos_politicas_seleccionadas as  $politica_id => $datos_politica_seleccionada) {

            DB::beginTransaction();
            try{
                MVUsuarioPolitica::where('ID', $politica_id)->update([
                    'FIRMADO' => 'S',
                    'CODIGO_VERIFICACION' => $codigo_verficacion_md5_rev,
                    'CARGO' => $request->cargo,
                    'ESTABLECIMIENTO_ID' => $request->establecimiento_id,
                    'EMAIL' => $request->email,
                ]);

                if($datos_politica_seleccionada->notifica_correo == 'S'){

                    if($datos_politica_seleccionada->comprobante == 'S'){
                        $this->EnviarCorreoPoliticaComprobante(
                            'Comprobante de envío y recepción de '.$datos_politica_seleccionada->nombre.' para '.$request->nombreFuncionario,
                            'administrador@ssbiobio.cl',
                            $request->email,
                            $request->nombreFuncionario,
                            $request->cargo,
                            $request->establecimiento,
                            $datos_politica_seleccionada->ruta_archivo,
                            $datos_politica_seleccionada->archivo_comprobante
                        );
                    }else{
                        $this->EnviarCorreoSinComprobante(
                            'Notificacion de Correo '.$datos_politica_seleccionada->nombre.' para '.$request->nombreFuncionario,
                            'administrador@ssbiobio.cl',
                            $request->email,
                            $request->nombreFuncionario,
                            $request->cargo,
                            $request->establecimiento,
                            $datos_politica_seleccionada->ruta_archivo,
                        );
                    }
                
                }
                DB::commit();
            }catch(\Exception $e){
                
                DB::rollBack();
                
                //dd($e->getMessage());
            }    
        }*/

        foreach ($request->datos_politicas_seleccionadas as  $politica_id => $datos_politica_seleccionada) {
            try{
                if($datos_politica_seleccionada->notifica_correo == 'S'){
        
                    if($datos_politica_seleccionada->comprobante == 'S'){
                        $this->EnviarCorreoPoliticaComprobante(
                            'Comprobante de envío y recepción de '.$datos_politica_seleccionada->nombre.' para '.$request->nombreFuncionario,
                            'administrador@ssbiobio.cl',
                            $request->email,
                            $request->nombreFuncionario,
                            $request->cargo,
                            $request->establecimiento,
                            $datos_politica_seleccionada->ruta_archivo,
                            $datos_politica_seleccionada->archivo_comprobante
                        );
                    }else{
                        $this->EnviarCorreoSinComprobante(
                            'Notificacion de Correo '.$datos_politica_seleccionada->nombre.' para '.$request->nombreFuncionario,
                            'administrador@ssbiobio.cl',
                            $request->email,
                            $request->nombreFuncionario,
                            $request->cargo,
                            $request->establecimiento,
                            $datos_politica_seleccionada->ruta_archivo,
                        );
                    }
                
                }
        
                DB::beginTransaction();
        
                MVUsuarioPolitica::where('ID', $politica_id)->update([
                    'FIRMADO' => 'S',
                    'CODIGO_VERIFICACION' => $codigo_verficacion_md5_rev,
                    'CARGO' => $request->cargo,
                    'ESTABLECIMIENTO_ID' => $request->establecimiento_id,
                    'EMAIL' => $request->email,
                ]);
        
                DB::commit();
                return ['estatus' => 'success', 'mensaje' => 'Se firmaron correctamente las políticas','codigo' => $codigo_verficacion_md5_rev];
            }catch(\Exception $e){
                
                DB::rollBack();
                
                return ['estatus' => 'error', 'mensaje' => 'Se produjo un error al firmar las politicas, el error es: '.$e->getMessage()];
            }    
        }
            
    }

    public function EnviarCorreoPoliticaComprobante($asunto, $emailTo, $correo, $nombre, $cargo, $establecimiento, $nombreArchivoPolitica, $nombreArchivoComprobante)
    {   
        /**
         * para pruebas
         */

        $nombreArchivoPolitica = 'politica.pdf';
        $nombreArchivoComprobante = 'comprobante.pdf';
 
        $rutaArchivoPolitica = 'documentos/politicas/'.$nombreArchivoPolitica;

        $rutaArchivoComprobante = 'documentos/comprobantes/'.$nombreArchivoComprobante;
        //Attachment::fromStorage($rutaArchivoPolitica)->as($customName)->mime($customMimeType);
        //dd(Attachment::fromStorage($rutaArchivoPolitica)->as($nombreArchivoPolitica)->withMime('application/pdf'));

        $email = new PoliticaFirmaMail(
            asunto:$asunto,
            emailTo:$emailTo,
            email:$correo,
            nombre:$nombre,
            cargo:$cargo,
            establecimiento:$establecimiento,
            rutaArchivo:$rutaArchivoPolitica,
            nombreArchivo:$nombreArchivoPolitica,
            rutaArchivoComprobante:$rutaArchivoComprobante,
            nombreArchivoComprobante:$nombreArchivoComprobante

        );
        /**
         * agregamos a la cola de correos
         */
        Mail::to($emailTo)->queue($email); // esto no es necesario porque se implementa en la clase del mail implements ShouldQueue

        /**
         * empecemos una transacion en la base de datos para manejar los errores del correo electronico
         */

        //Mail::to($emailTo)->send($email);
    }

    public function EnviarCorreoSinComprobante($asunto, $emailTo, $correo, $nombre, $cargo, $establecimiento, $nombreArchivoPolitica)
    {   
        /**
         * para prueba
         */
        $nombreArchivoPolitica = 'politica.pdf';

        $rutaArchivoPolitica = 'documentos/politicas/'.$nombreArchivoPolitica;

        $email = new PoliticaFirmaMail(
            asunto:$asunto,
            emailTo:$emailTo,
            email:$correo,
            nombre:$nombre,
            cargo:$cargo,
            establecimiento:$establecimiento,
            rutaArchivo:$rutaArchivoPolitica,
            nombreArchivo:$nombreArchivoPolitica,
        );
            
        Mail::to($emailTo)->send($email);
    }
}