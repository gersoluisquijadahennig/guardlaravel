<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="{{ asset('vendor/bootstrap/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('datatable/dataTables.dataTables.css') }}">


    <title>Layout none</title>
    @livewireStyles
</head>
<body>
    @yield('content')

    
    <!--<script src="{{ asset('datatable/jquery-3.6.4.min.js') }}"></script>-->
    <script src="{{ asset('datatable/jquery-3.7.1.js') }}"></script>
    <script src="{{ asset('datatable/popper.min.js') }}"></script>
    <script src="{{ asset('datatable/bootstrap.min.js') }}"></script>
    <script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('datatable/cargarlistausuarios.js') }}"></script>
    @yield('js')
    @livewireScripts
</body>
</html>





