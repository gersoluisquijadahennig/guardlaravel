@extends('layouts.dashboard.app')

@section('content')
    <livewire:AsistenteEducacion::Livewire.MvSolicitudEstab.CreateLivewire/>
@endsection

@section('js')
  <script>
  document.addEventListener('livewire:init', () => {
      Livewire.on('EmiteAlerta', (event) => {

      console.log(event.mensaje);
      console.log(event.estatus);

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
          title: "Oops...",
          text: event.mensaje,
          footer: '<a href="#">¿desea abrir un ticket de asistencía?</a>'
        });
      }
    }); // Cierre de la función de callback de Livewire.on
  }); // Cierre de la función de callback de addEventListener
  </script>
@endsection