@extends('layouts.dashboard.app')
@section('content')

<livewire:documentacion::guardar-firma-politica  :token="$token" />

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



      
    })
</script>


@endsection