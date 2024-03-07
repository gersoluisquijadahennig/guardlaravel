@extends('layouts.dashboard.app')
@section('content')
@php
//dd($politicas,$establecimientos);
@endphp
<div class="container">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab"
        aria-controls="home" aria-selected="true">Políticas por Firmar</button>
    </li>
    <li class="nav-item" role="presentation">
      <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab"
        aria-controls="profile" aria-selected="false">Politicas Firmadas</button>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      <div class="card card-primary mt-5">
        <div class="card-header">
          <h3 class="card-title">Políticas por Firmar</h3>
        </div>
        <div class="card-body">
          @if($contarPoliticaNoFirmada > 0)
          <form action="{{ route('firmar-politicas.firmarPoliticasWebSite') }}" method="POST" id="form_firmar" novalidate>
            @csrf
            <input type="hidden" name="rutFuncionario" value="{{ $rutFuncionario }}" />
            <input type="hidden" name="nombreFuncionario" value="{{ $nombreFuncionario }}" />
            <table class="table table-hover">
              <thead>
                <tr>
                  <th title="Seleccionar todos.">
                    <input type="checkbox" name="todos" id="todos"
                      style="cursor: pointer;vertical-align: middle; margin-left:2px;">
                  </th>
                  <th>Política</th>
                  <th width="10%">Versión actual.</th>
                  <th width="10%">Obs.</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>
                @foreach ( $politicas as $politica)
                <tr>
                  <td>
                    <input type="checkbox" name="politicas_seleccionadas_id[{{ $politica->usuario_politica_id }}][politica_id]"
                      id="politicas_seleccionadas_id"
                      style="cursor: pointer; vertical-align: middle; margin-left: 2px;"
                      value="{{ $politica->usuario_politica_id }}" class="politica-checkbox" {{ in_array($politica->politica_id,
                    old('politicas_seleccionadas_id', [])) ? 'checked' :
                    '' }}>
                    <input type="hidden" name="politicas_seleccionadas_id[{{$politica->usuario_politica_id}}][tipo_correo]" value="{{ $politica->tb_tipo_correo_id }}">
                    <input type="hidden" name="politicas_seleccionadas_id[{{$politica->usuario_politica_id}}][nombre]" value="{{ $politica->nombre }}">
                    <input type="hidden" name="politicas_seleccionadas_id[{{$politica->usuario_politica_id}}][notifica_correo]" value="{{ $politica->notifica_correo }}">
                    <input type="hidden" name="politicas_seleccionadas_id[{{$politica->usuario_politica_id}}][nombre_archivo_politica]" value="{{ $politica->ruta_archivo }}">
                    <input type="hidden" name="politicas_seleccionadas_id[{{$politica->usuario_politica_id}}][nombre_archivo_comprobante]" value="{{ $politica->archivo_comprobante }}">
                    <input type="hidden" name="politicas_seleccionadas_id[{{$politica->usuario_politica_id}}][genera_comprobante]" value="{{ $politica->comprobante }}">
                  </td>
                  <td>
                    {{ $politica->nombre }}
                  </td>
                  <td>
                    <p class="text-center"> {{ $politica->version }}</p>
                  </td>
                  <td>
                    @if($politica->comprobante == 'S' && $politica->tb_tipo_correo_id != 1)
                      <i class="fas fa-lg fa-envelope" style="color: #3c8dbc;" tabindex="0" data-bs-toggle="popover"
                      title="Notificación"
                      data-bs-content="Se enviará una copia de este documento y comprobante @if($politica->tb_tipo_correo_id == 2)a su correo personal indicado. @else a su correo institucional. @endif"
                      data-bs-trigger="hover">
                    </i>
                    @endif
                  </td>
                  <td>
                    <a href="#" id="descargar_doc" data-archivo="Reglamento_Interno_O,H_y_S.pdf" data-estab_id="197"
                      class="btn btn-success form-control">
                      <em class="fa fa-file-pdf-o"></em>&nbsp;Política
                    </a>
                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>

            <x-adminlte-input name="cargo" label="Cargo :" placeholder="Escriba su cargo, Ej: Doctor" value-old="{{ old('cargo') }}" />

            <x-adminlte-select name="establecimiento_id" id="establecimiento_id" label="Establecimiento :"
              class="form-select form-select-sm">
              <option value="">-- Seleccione --</option>
              @foreach ($establecimientos as $establecimiento)
              <option value="{{ $establecimiento->id }}">{{ $establecimiento->descripcion }}</option>
              @endforeach
            </x-adminlte-select>

            <x-adminlte-input name="email" type="email" label="Correo Electrónico :" placeholder="Ej: juan@ssbibio.cl">
              <x-slot name="prependSlot">
                <div class="input-group-text">
                  <i class="fas fa-lg fa-envelope text-lightblue"></i>
                </div>
              </x-slot>
            </x-adminlte-input>
            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" name="confirmacion" id="confirmacion" value="1"
                  required>
                <label class="form-check-label">Declaro haber leido y revisado todas las políticas.</label>
                @error('confirmacion')
                <span class="invalid-feedback d-block" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
            </div>
            {{-- enviamos lass us_pol_id de las politicas seleccionadas al servidor para actualizar el estado de la politica --}}           
            <x-adminlte-button class="btn-flat" type="submit" label="Firmar" id="btn_firmar" theme="success"
              icon="fas fa-save" disabled />
          </form>
          @else
          <div class="alert alert-danger" role="alert">
            No se encontraron politicas pendientes por firmar.
          </div>
          @endif
        </div>
      </div>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
      @if($contarPoliticaFirmada > 0)
      <table class="table table-hover" id="listado_politicas">
        <thead>
          <tr>
            <th class="w-25">Nombre de la Política </th>
            <th class="w-25">Version Firmada.</th>
            <th class="w-50"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ( $politicas as $politica)
          <tr class="tr_tabla" id="tr_1">
            <td>
              {{ $politica->nombre }}
            </td>
            <td>
              {{ $politica->version }}
            </td>
            <td>
              <div class="row">
                <div class="col col-md-6">
                  <a href="{{asset('storage/documentos/documento.pdf')}}}" id="descargar_doc" data-archivo="Reglamento_Interno_O,H_y_S.pdf" data-estab_id="197" class="btn btn-success btn-block"> <i class="fa fa-500px"></i> Política</a>
                </div>
                <div class="col col-md-6">
                  <a href="{{asset('storage/documentos/documento.pdf')}}" id="descargar_pdf" data-archivo="Reglamento_Interno_O,H_y_S.pdf" data-estab_id="197" class="btn btn-success btn-block fa fa-download">Comprobante</a>
                </div>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @else
      <div class="alert alert-danger mt-5" role="alert">
        No se encontraron resultados.
      </div>
      @endif
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
  integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
<script>
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'))
    var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
      return new bootstrap.Popover(popoverTriggerEl)
    })

    $(function () {
        $('[data-bs-toggle="popover"]').popover();
    });

    var checkboxTodos = document.getElementById('todos');
    var checkboxesPolitica = document.getElementsByClassName('politica-checkbox');
    var botonFirmar = document.getElementById('btn_firmar');

    // Escucha el cambio en el estado del checkbox "todos"
    checkboxTodos.addEventListener('change', function () {
        // Establece el estado de todos los checkboxes "politica-checkbox" según el estado del checkbox "todos"
        for (var i = 0; i < checkboxesPolitica.length; i++) {
            checkboxesPolitica[i].checked = this.checked;
        }

        // Habilita o deshabilita el botón según el estado del checkbox "todos"
        botonFirmar.disabled = !this.checked;
    });

    // Escucha el cambio en el estado de cualquier checkbox "politica-checkbox"
    for (var i = 0; i < checkboxesPolitica.length; i++) {
        checkboxesPolitica[i].addEventListener('change', function () {
            // Si todos los checkboxes "politica-checkbox" están marcados, marca también el checkbox "todos"
            checkboxTodos.checked = Array.from(checkboxesPolitica).every(function (checkbox) {
                return checkbox.checked;
            });

            // Si al menos uno de los checkboxes "politica-checkbox" está marcado, habilita el botón
            botonFirmar.disabled = Array.from(checkboxesPolitica).every(function (checkbox) {
                return !checkbox.checked;
            });
        });
    } 
</script>


@endsection