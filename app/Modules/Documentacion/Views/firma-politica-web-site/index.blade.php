@extends('layouts.dashboard.app')
@section('content')
@php
dd($politicas);
@endphp

<livewire:documentacion::guardar-firma-politica 
  :contarPoliticaNoFirmada="$contarPoliticaNoFirmada"
  :contarPoliticaFirmada="$contarPoliticaFirmada"
  :establecimientos="$establecimientos"
  :rutFuncionario="$rutFuncionario"
  :nombreFuncionario="$nombreFuncionario"
  :politicas="$politicas" />

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