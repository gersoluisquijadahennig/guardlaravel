@extends('layouts.dashboard.app')
@section('content')
    <livewire:AsistenteEducacion::Livewire.MvSolicitudEstab.FormularioVerificacionLivewire />
@endsection
@section('js')
    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('EmiteAlerta', (event) => {

                //console.log(event.mensaje);
                //console.log(event.estatus);
                //si event.title no está definido, se le asigna un valor por defecto
                if (event.title == undefined) {
                    event.title = '¡Error!';
                }

                if (event.estatus == 'success') {
                    Swal.fire({
                        position: "center"
                        , icon: "success"
                        , title: event.mensaje
                        , showConfirmButton: false
                        , timer: 1500
                    });
                }

                if (event.estatus == 'error') {
                    Swal.fire({
                        icon: "error"
                        , title: event.title
                        , text: event.mensaje
                        , footer: '<a href="#">¿desea abrir un ticket de asistencía?</a>'
                    });
                }
            }); // Cierre de la función de callback de Livewire.on

            Livewire.on('AlertConsulta', (event) => {
                console.log(event);
                Swal.fire({
                    title: event.title
                    , text: event.text
                    , icon: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: "#3085d6"
                    , cancelButtonColor: "#d33"
                    , confirmButtonText: "Si, voy a hacer la solicitud"
                }).then((result) => {
                console.log(result);
                    if (result.isConfirmed) {
                    console.log('isConfirmed');
                    Livewire.dispatch('MostrarFormulario',{ 
                        formulario: 2
                    });
                    }
                    if (result.dismiss ) {
                    Livewire.dispatch('MostrarFormulario',{ formulario: 0 });
                    }
                });
            }); // Cierre de la función de callback de Livewire.on

            Livewire.on('AlertConsulta2', (event) => {
                console.log(event);
                Swal.fire({
                    title: event.title
                    , text: event.text
                    , icon: "warning"
                    , showCancelButton: true
                    , confirmButtonColor: "#3085d6"
                    , cancelButtonColor: "#d33"
                    , confirmButtonText: "Si, voy a hacer la solicitud"
                }).then((result) => {
                console.log(result);
                    if (result.isConfirmed) {
                    console.log('isConfirmed');

                    }
                    if (result.dismiss ) {
                    Livewire.dispatch('MostrarFormulario',{ formulario: 0 });
                    }
                });
            }); // Cierre de la función de callback de Livewire.on


        }); // Cierre de la función de callback de addEventListener
        
    </script>
@endsection
