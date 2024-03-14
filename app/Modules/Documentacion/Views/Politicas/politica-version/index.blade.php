@extends('layouts.portal')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Version de Políticas</div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-5 ml-5 mr-5">
                    <button type="button" class="btn btn-success btn-sm" onclick="window.location='{{ route('politica.crearPolitica') }}'">Crear</button>
                </div>

                <div class="card-body">
                    @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                    @endif

                </div>
                <div class="table-responsive">
                    <table class="table">
                        <caption>Lista de Version Políticas</caption>
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">TB_POLITICA_ID</th>
                                <th scope="col">ACTIVO</th>
                                <th scope="col">VERSION</th>
                                <th scope="col">COMPROBANTE</th>
                                <th scope="col">TIPO_POLITICA</th>
                                <th scope="col">RUTA_ARCHIVO</th>
                                <th scope="col">ARCHIVO_COMPROBANTE</th>
                                {{--<th scope="col">NOTIFICA__CORREO</th>
                                <th scope="col">FECHA_CREA</th>
                                <th scope="col">USUARIO_CREA_ID</th>
                                <th scope="col">IP_CREA</th>
                                <th scope="col">SERVIDOR_CREA</th>
                                <th scope="col">PERSONAS_CREA</th>
                                <th scope="col">FECHA_MOD</th>
                                <th scope="col">USUARIO_MOD_ID</th>
                                <th scope="col">SERVIDOR_MOD</th>
                                <th scope="col">PERSONAS_MOD</th>
                                <th scope="col">TB_TIPO_CORREO_ID</th>
                                <th scope="col">POLITICA_INTERNA</th>
                                <th scope="col">POLITICA_EXTERNA</th>
                                <th scope="col">ALCANCE</th>--}}    
                                <th scope="col">Acciones</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ( $versiones as $version )
                            <tr>
                                <th scope="row">{{ $version->id }}</th>
                                <td>{{ $version->tb_politica_id }}</td>
                                <td>{{ $version->activo }}</td>
                                <td>{{ $version->version }}</td>
                                <td>{{ $version->comprobante }}</td>
                                <td>{{ $version->tipo_politica }}</td>
                                <td>{{ $version->ruta_archivo }}</td>
                                <td>{{ $version->archivo_comprobante }}</td>
                                {{--<td>{{ $version->notifica__correo }}</td>
                                <td>{{ $version->fecha_crea }}</td>
                                <td>{{ $version->usuario_crea_id }}</td>
                                <td>{{ $version->ip_crea }}</td>
                                <td>{{ $version->servidor_crea }}</td>
                                <td>{{ $version->personas_crea }}</td>
                                <td>{{ $version->fecha_mod }}</td>
                                <td>{{ $version->usuario_mod_id }}</td>
                                <td>{{ $version->ip_mod }}</td>
                                <td>{{ $version->servidor_mod }}</td>
                                <td>{{ $version->personas_mod }}</td>
                                <td>{{ $version->tb_tipo_correo_id }}</td>
                                <td>{{ $version->politica_interna }}</td>
                                <td>{{ $version->politica_externa }}</td>
                                <td>{{ $version->alcance }}</td>--}}
                                <td>
                                    <div class="btn-group-sm mt-3" style="display: flex; gap: 5px;">
                                        {{--}} <a href="{{ route('politica.editarPolitica', $version->ID) }}" class="btn btn-primary btn-sm">Editar</a>--}}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@stop
