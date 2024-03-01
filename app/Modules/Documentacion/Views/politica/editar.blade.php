@extends('layouts.portal')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Actualizar Política') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('politica.actualizarPolitica', ['id' => $politica->id]) }}" class="needs-validation" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" name="nombre" id="nombre" class="form-control @error('nombre') is-invalid @enderror" value="{{ $politica->nombre }}" required>
                                @error('nombre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea name="descripcion" id="descripcion" class="form-control @error('descripcion') is-invalid @enderror"  required>{{ $politica->descripcion }}</textarea>
                                @error('descripcion')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="activo">Activo:</label>
                                <select name="activo" id="activo" class="form-control @error('activo') is-invalid @enderror" value="{{ $politica->activo }}" required>
                                    <option value="S" {{ old('activo') == 'S' ? 'selected' : '' }}>Sí</option>
                                    <option value="N" {{ old('activo') == 'N' ? 'selected' : '' }}>No</option>
                                </select>
                                @error('activo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="dependencia_establecimiento_id">ID de Dependencia Establecimiento:</label>
                                <input type="number" name="dependencia_establecimiento_id" id="dependencia_establecimiento_id" class="form-control @error('dependencia_establecimiento_id') is-invalid @enderror" value="{{ $politica->dependencia_establecimiento_id }}" required>
                                @error('dependencia_establecimiento_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                   

                            <div class="btn-group-sm mt-3" style="display: flex; gap: 5px;">
                                <button type="submit" class="btn btn-primary mt-3 btn-sm">Actualizar</button>
                            </form>
                                <form action="{{ route('politica.eliminarPolitica', $politica->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-3 btn-sm" >Eliminar</button>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

