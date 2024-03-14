@extends('layouts.portal');

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Políticas</div>

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
                <table class="table">
                    <caption>Lista de Políticas</caption>
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Descripción</th>
                            <th scope="col">Dependencia Establecimiento id</th>
                            <th scope="col">Fecha Creación</th>
                            <th scope="col">Fecha Modificación</th>
                            <th scope="col">Usuario Modificación</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $politicas as $politica )
                        <tr>
                            <th scope="row">{{ $politica->id }}</th>
                            <td>{{ $politica->nombre }}</td>
                            <td>{{ $politica->descripcion }}</td>
                            <td>{{ $politica->dependencia_establecimiento_id }}</td>
                            <td>{{ $politica->fecha_crea }}</td>
                            <td>{{ $politica->fecha_mod }}</td>
                            <td>{{ $politica->usuario_mod_id }}</td>
                            <td>
                                <div class="btn-group-sm mt-3" style="display: flex; gap: 5px;">
                                    <a href="{{ route('politica.editarPolitica', $politica->id) }}" class="btn btn-primary btn-sm">Editar</a>
                                </div>
                            </td>


                        </tr>
                        @endforeach
            </div>
        </div>
    </div>
</div>
@endSection
