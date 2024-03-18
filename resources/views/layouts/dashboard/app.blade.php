@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content') 
    <p>contenido del Dashboard.</p>
@stop

@section('css')
@stop

@section('js')
<script src="{{ asset('datatable/cargarlistausuarios.js') }}"></script>
@stop