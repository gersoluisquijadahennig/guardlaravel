@extends('layouts.dashboard.app')

@section('content')
      <livewire:Asistente::Livewire.MvSolicitudEstab.FormularioVerificacionLivewire/>
@endsection
@section('js')

  <script>
  document.addEventListener('livewire:init', () => {
      Livewire.on('EmiteAlerta', (event) => {

      //console.log(event.mensaje);
      //console.log(event.estatus);

      if(event.estatus == 'success'){
        Swal.fire({
          position: "center",
          icon: "success",
          title: event.mensaje,
          showConfirmButton: false,
          timer: 1500
        });
      }

      if(event.estatus == 'error'){
        Swal.fire({
          icon: "error",
          title: "Por la Xuxa...",
          text: event.mensaje,
          footer: '<a href="#">¿desea abrir un ticket de asistencía?</a>'
        });
      }
    }); // Cierre de la función de callback de Livewire.on
  }); // Cierre de la función de callback de addEventListener
  </script>
@endsection

@section('js')
<script>
  document.addEventListener('livewire:init', () => {
    Livewire.on('mostrarFormulario', formulario => {
      if (formulario === 'Create1Livewire') {
        Livewire.dispatch('setFormularioVisible', 1);
      } else if (formulario === 'Create2Livewire') {
        Livewire.dispatch('setFormularioVisible', 2);
      }
    });
  });
</script>
@endsection