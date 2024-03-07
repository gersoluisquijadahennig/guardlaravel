@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>'content_header'</h1>
@stop

@section('content') 
    <p>contenido del Dashboard.</p>
@stop

@section('css')
@stop

@section('js')
{{--<script src="{{ asset('datatable/jquery-3.6.4.min.js') }}"></script>--}}
{{--<script src="{{ asset('datatable/popper.min.js') }}"></script>--}}
{{--<script src="{{ asset('datatable/bootstrap.min.js') }}"></script>--}}
{{--<script src="{{ asset('datatable/jquery.dataTables.min.js') }}"></script>--}}
{{--<script src="{{ asset('datatable/dataTables.bootstrap4.min.js') }}"></script>--}}
<script src="{{ asset('datatable/cargarlistausuarios.js') }}"></script>
@stop