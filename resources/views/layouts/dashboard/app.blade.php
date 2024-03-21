@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1></h1>
@stop

@section('content') 
    <p>contenido del Dashboard.</p>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('custom/custom.css') }}">
@stop

@section('js')
<script src="{{ asset('datatable/cargarlistausuarios.js') }}"></script>
@stop