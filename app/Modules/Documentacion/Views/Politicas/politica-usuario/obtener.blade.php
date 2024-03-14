@extends('layouts.portal')

@section('content')
<h1>Mev Usuario Política</h1>
<h2>Obtener</h2>


@php
    dd($resultados,$usuarioPoliticas,$contarPoliticaFirmada,$contarPoliticaNoFirmada);
@endphp
@endsection