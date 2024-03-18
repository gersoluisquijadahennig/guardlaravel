@extends('layouts.dashboard.app')

@section('content')



    <livewire:documentacion::parte-create-livewire :token="$token" />





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
 });
</script>


@endsection