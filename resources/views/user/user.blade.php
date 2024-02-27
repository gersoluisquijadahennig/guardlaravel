@extends($layout)

@php
$heads = [
    'id',
    'usuario',
    ['label' => 'Email', 'width' => 40],
    ['label' => 'Activo','width' => 5],
  
];
@endphp

@section('content')
  <x-adminlte-datatable id="Table" :heads="$heads" />
@endsection
 
@section('none-js')
<script>
    $(document).ready( function () {
        $('#Table').DataTable({
                ajax: {
                    url: '/datosListaUsuarios',
                    dataSrc: 'data'
                },
                columns: [
                    { data: 'id' },
                    { data: 'usuario' },
                    { data: 'correo_electronico' },
                    { data: 'activo' },
                ]
            })
    } );
</script>
@endsection
                    