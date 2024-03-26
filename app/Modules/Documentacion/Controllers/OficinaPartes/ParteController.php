<?php

namespace App\Modules\Documentacion\Controllers\OficinaPartes;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Modules\Documentacion\Mail\ParteDocumentoMail;
use App\Modules\Documentacion\Models\OficinaPartes\Origen;
use App\Modules\Documentacion\Models\OficinaPartes\MvSolIngDocumento;
use App\Modules\Documentacion\Models\OficinaPartes\MvSolIngDocumentoArchivo;
use App\Modules\Documentacion\Models\OficinaPartes\MvSolIngDocumentoDestino;

class ParteController extends Controller
{
    public function index($token)
    {
        $partes = MvSolIngDocumento::all();
        return view('documentacion::OficinaPartes.partes.index', compact('token', 'partes'));
    }
    public function create($token)
    {
        return view('documentacion::OficinaPartes.partes.create', compact('token'));
    }
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            // Validar los datos del request
            $formularioId = 12; // id del formulario
            $datosToken = $this->DesencriptarToken($request->token)->getData();
            $datosFolio = $this->ObtenerFolio($formularioId)->getData();


            //dd($datosToken, $datosFolio, $request->input());

            // Crear una nueva instancia de MvSolIngDocumento
            $mvSolIngDocumento = new MvSolIngDocumento(
                [
                    'RUT_RESPONSABLE' => $datosToken->rut . '-' . $datosToken->dv,
                    'NOMBRE_RESPONSABLE' => $datosToken->nombres . ' ' . $datosToken->apellidos,
                    'CORREO_RESPONSABLE' => $request->correo,
                    'TELEFONO_FIJO_RESPONSABLE' => $request->telefono_fijo,
                    'TELEFONO_MOVIL_RESPONSABLE' => $request->telefono_movil,
                    'ORIGEN_ID' => $request->establecimiento_id,
                    'FOLIO' => $datosFolio->foliado,//obtener el folio de la secuencia
                    'OBSERVACION_EXTERNA' => $request->observaciones,
                    'IP_CREA' => $request->ip_creacion,
                    'SERVIDOR_CREA' => $request->servidor_creacion,
                ]
            );
            
            
            $mvSolIngDocumento->save();
            
            //dd($mvSolIngDocumento,$mvSolIngDocumento->freshTimestamp(),$mvSolIngDocumento->ID);

            // Crear una nueva instancia de MvSolIngDocumentoDestino
            //dd($request->destinos);
            foreach ($request->destinos_seleccionados as $destino) {
                $nuevoDestino = new MvSolIngDocumentoDestino(
                    [
                        'ESTABLECIMIENTO_ID' => $destino['establecimiento_id'],
                        'DESTINO' => $destino['area'],
                        'ACTIVO' => 'S',
                        'IP_CREA' => $request->ip_creacion,
                        'SERVIDOR_CREA' => $request->servidor_creacion
                    ]
                );
                // solo simulamos la fecha de carga del sistema 
                $fechaCrea = $nuevoDestino->freshTimestamp();


                $mvSolIngDocumento->destinos()->save($nuevoDestino);
            }
            //dd($nuevoDestino, $mvSolIngDocumento->destinos(), $fechaCrea);

            $contar = 0;
            $archivosGuardados = [];
            $fechaActual = $mvSolIngDocumento->freshTimestamp();
            $anio = Carbon::parse($fechaActual)->year;
            $ruta = 'archivos/197/documentacion_solicitud/' . $anio . '/';

            foreach ($request->archivos as $archivo) {
                $contar++;
                $extension = $archivo->getClientOriginalExtension();
                $nombreArchivo = $archivo->getClientOriginalName();
                $nombreArchivoFoliado = $datosFolio->foliado . "_ADJ_0" . $contar . "." . $extension;
                
                // recuperar la extension del archivo
                
                $archivo->storeAs($ruta, $nombreArchivoFoliado);
                // guardamos los archivos guardados con el nombre original para mostrar en el correo
                $archivosGuardados[] = [
                    'nombre' => $nombreArchivo,
                    'link' => Storage::url($ruta . $nombreArchivoFoliado)
                ];

                if ($archivo->isValid()) {
                    // Eliminar el archivo temporal
                     unlink($archivo->path());
                } else {
                    return response()->json(['mensaje' => 'Error al eliminar el archivo temporal y cargar el archivo al servidor'], 500);
                }

                
                $nuevoArchivo = new MvSolIngDocumentoArchivo([
                    'FOLIO' => $datosFolio->foliado,
                    'FOLIO_ADJUNTO' => $nombreArchivoFoliado,
                    'DESCRIPCION' => $nombreArchivo,
                    'ACTIVO' => 'S',
                    'IP_CREA' => $request->ip_creacion,
                    'SERVIDOR_CREA' => $request->servidor_creacion
                ]);
                $fechaCrea = $nuevoArchivo->freshTimestamp();

                //dd($nuevoArchivo, $mvSolIngDocumento->archivos(), $fechaCrea);
                $mvSolIngDocumento->archivos()->save($nuevoArchivo);
            }

            //dd($nuevoArchivo,$mvSolIngDocumento->archivos(),$fechaCrea);
            $nombreInstitucionOrigen = $this->NombreOrigenSeleccionado($request->origenes, $request->establecimiento_id)->getData();
            $nombreDestinosSeleccionados = $this->NombreDestinosSelecionados($request->destinos, $request->destinos_seleccionados)->getData();
            $cantidadArchivos = count($request->archivos);
            /**
             * enviar correo de confirmacion de recepcion de documentos del parte
             */
            /**
             * uddate MvSolIngDocumento a 13 si todo bien
             */
            $mvSolIngDocumento->update(['ESTADO_ID' => 13]);
            $this->ActualizarCorrelativoFolio($datosFolio->folioNuevo, $formularioId);

            DB::commit();

            Mail::to($request->correo)->queue(
                new ParteDocumentoMail(
                    asunto: 'Confirmación de recepción de documentos N° ' . $datosFolio->foliado,
                    emailTo: $request->correo,
                    email: $request->correo,
                    autofolio: $datosFolio->foliado,
                    nombre: $datosToken->nombres . ' ' . $datosToken->apellidos,
                    institucion_origen: $nombreInstitucionOrigen,
                    destinos: $nombreDestinosSeleccionados,
                    observaciones: $request->observaciones,
                    archivos: $archivosGuardados,
                    cantidad_archivos: $cantidadArchivos,
                    notificacionAdministrador: false
                )
            );
            Mail::to('administrador@ssbiobio.cl')->queue(
                new ParteDocumentoMail(
                    asunto: 'Notificación de nuevo parte N° ' . $datosFolio->foliado,
                    emailTo: $request->correo,
                    email: 'administrador@ssbiobio.cl',
                    autofolio: $datosFolio->foliado,
                    nombre: $datosToken->nombres . ' ' . $datosToken->apellidos,
                    institucion_origen: $nombreInstitucionOrigen,
                    destinos: $nombreDestinosSeleccionados,
                    observaciones: $request->observaciones,
                    archivos: $archivosGuardados,
                    cantidad_archivos: $cantidadArchivos,
                    notificacionAdministrador: true
                )
            );
            
            //Event::dispatch('resetFormulario');
            
            return response()->json(['mensaje' => 'Parte guardado correctamente','status'=>'201'], 201);

        } catch (\Exception $e) {
            DB::rollBack();
            dd(
                $e->getMessage(),
                $e->getCode(),
                $e->getFile(),
                $e->getLine(),
                $e->getTrace()
            );
            return response()->json(['mensaje' => 'Error al guardar el parte'], 500);
        }


    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {

        // Recuperar la instancia de Parte
        $parte = MvSolIngDocumento::findOrFail($id);

        // Pasar la instancia de Parte a la vista
        return view('partes.edit', ['parte' => $parte]);
    }
    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();

            // Validar los datos del request
            $formularioId = 12; // id del formulario
            $datosToken = $this->DesencriptarToken($request->token)->getData();
            $datosFolio = $this->ObtenerFolio($formularioId)->getData();

            // Recuperar la instancia de MvSolIngDocumento
            $mvSolIngDocumento = MvSolIngDocumento::findOrFail($id);

            // Actualizar los atributos de la instancia de MvSolIngDocumento
            $mvSolIngDocumento->fill([
                'RUT_RESPONSABLE' => $datosToken->rut . '-' . $datosToken->dv,
                'NOMBRE_RESPONSABLE' => $datosToken->nombres . ' ' . $datosToken->apellidos,
                'CORREO_RESPONSABLE' => $request->correo,
                'TELEFONO_FIJO_RESPONSABLE' => $request->telefono_fijo,
                'TELEFONO_MOVIL_RESPONSABLE' => $request->telefono_movil,
                'ORIGEN_ID' => $request->establecimiento_id,
                'FOLIO' => $datosFolio->foliado,//obtener el folio de la secuencia
                'OBSERVACION_EXTERNA' => $request->observaciones,
                'IP_CREA' => $request->ip_creacion,
                'SERVIDOR_CREA' => $request->servidor_creacion,
            ]);

            // Actualizar las instancias de MvSolIngDocumentoDestino
            foreach ($request->destinos as $destino) {
                $nuevoDestino = MvSolIngDocumentoDestino::where('ESTABLECIMIENTO_ID', $destino['establecimiento_id'])->firstOrFail();
                $nuevoDestino->fill([
                    'DESTINO' => $destino['area'],
                    'ACTIVO' => 'S',
                    'IP_CREA' => $request->ip_creacion,
                    'SERVIDOR_CREA' => $request->servidor_creacion
                ]);
                $nuevoDestino->save();
            }
            $contar = 0;

            $fechaActual = $mvSolIngDocumento->freshTimestamp();
            $anio = Carbon::parse($fechaActual)->year;
            $ruta = 'archivos/197/documentacion_solicitud/' . $anio . '/';

            // Actualizar las instancias de MvSolIngDocumentoArchivo
            foreach ($request->archivos as $archivo) {
                $nombreArchivo = $archivo->getClientOriginalName();
                $nombreArchivoUnico = uniqid() . '_' . $nombreArchivo;
                $archivo->storeAs($ruta, $nombreArchivoUnico);

                if ($archivo->isValid()) {
                    // Eliminar el archivo temporal
                    unlink($archivo->path());
                } else {
                    return response()->json(['mensaje' => 'Error al eliminar el archivo temporal y cargar el archivo al servidor'], 500);
                }

                $folio = $datosFolio->foliado . "_ADJ_0" . $contar . ".pdf";
                $nuevoArchivo = MvSolIngDocumentoArchivo::where('FOLIO', $datosFolio->foliado)->firstOrFail();
                $nuevoArchivo->fill([
                    'FOLIO_ADJUNTO' => $folio,
                    'DESCRIPCION' => $nombreArchivo,
                    'ACTIVO' => 'S',
                    'IP_CREA' => $request->ip_creacion,
                    'SERVIDOR_CREA' => $request->servidor_creacion
                ]);
                $nuevoArchivo->save();
            }

            DB::commit();


            /**
             * empecemos una transacion en la base de datos para manejar los errores del correo electronico
             */

            //Mail::to($emailTo)->send($email);


            return response()->json(['mensaje' => 'Parte actualizado correctamente'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['mensaje' => 'Error al actualizar el parte'], 500);
        }
    }
    public function destroy($id)
    {
        try {
            // Recuperar la instancia de MvSolIngDocumento
            $parte = MvSolIngDocumento::findOrFail($id);

            // Soft delete de la instancia de MvSolIngDocumento
            $parte->delete();

            return response()->json(['mensaje' => 'Parte eliminado correctamente'], 200);
        } catch (\Exception $e) {
            return response()->json(['mensaje' => 'Error al eliminar el parte'], 500);
        }
    }
    /**
     * Servicios
     */

    public function DesencriptarToken($token)
    {
        if ($token == 'tokenPrueba') {
            $tokenData['rut'] = '26335451';
            $tokenData['dv'] = '6';
            $tokenData['nombres'] = 'Gerso Luis';
            $tokenData['apellidos'] = 'Quijada Hennig';

            return response()->json($tokenData);
        }
        $pass = base64_encode('ssbiobiopass' . date("ymd"));
        $decryptToken = openssl_decrypt($token, "AES-256-CBC", $pass);
        if ($decryptToken === false) {
            return response()->json(['mensaje' => 'Error de desencriptación'], 500);
        }
        $tokenData = json_decode($decryptToken, true);
        if ($tokenData === null) {
            return response()->json(['mensaje' => 'Token invalido'], 500);
        }
        return response()->json($tokenData);
    }
    public function ListaOrigenes()
    {
        $origenes = Origen::select('ID', 'DESCRIPCION')
        ->where('ACTIVO', 'S')
        ->orderBy('DESCRIPCION', 'ASC')
        ->get();
        /*$origenes = collect([
            [
                'id' => 1,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 2,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 3,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 4,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 5,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 6,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 7,
                'descripcion' => 'Oficina Partes'
            ],
        ])->transform(function ($item, $key) {
            return (object) $item;
        });*/
        //dd($origenes);
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

        /*$establecimientos = collect([
            [
                'id' => 197,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 198,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 200,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 201,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 202,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 203,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 204,
                'descripcion' => 'Oficina Partes'
            ],
            [
                'id' => 205,
                'descripcion' => 'Oficina Partes'
            ]
        ])->transform(function ($item, $key) {
            return (object) $item;
        });*/
        return response()->json($establecimientos);
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
            'folio' => $folioActual,
            'foliado' => $folio->prefijo . $folioNuevo,
            'folioNuevo' => $folioNuevo,
        ], 200);

    }
    public function ActualizarCorrelativoFolio($folio, $formularioId)
    {
        $folio = DB::connection('oracle')
            ->table('GESTION_CENTRAL.FOLIOS')
            ->where('FORMULARIO_ID', $formularioId)
            ->update(['FOLIO' => $folio]);

        return response()->json($folio);
    }
    public function NombreOrigenSeleccionado($origenes, $id)
    {
        $key = array_search($id, array_column($origenes, 'id'));

        if ($key !== false) {
            return response()->json($origenes[$key]->descripcion);
        } else {
            return response()->json('Origen no encontrado', 404);
        }
    }
    public function NombreDestinosSelecionados($destinos, $listaDestinos)
    {
        $result = [];

        foreach ($listaDestinos as $destino) {
            $establecimiento_id = $destino['establecimiento_id'];
            $key = array_search($establecimiento_id, array_column($destinos, 'id'));

            if ($key !== false) {
                $result[] = $destinos[$key]->descripcion;
            } else {
                $result[] = 'Destino no encontrado';
            }
        }

        return response()->json($result);
    }
    public function download($id)
    {
        // Recuperar la instancia de MvSolIngDocumentoArchivo
        $archivo = MvSolIngDocumentoArchivo::findOrFail($id);

        // Descargar el archivo
        return Storage::download($archivo->ruta, $archivo->nombre);
    }




}
