@extends('layouts.dashboard.app')

@section('content')

@php
$nombreBoton = 'Crear';
$tituloCard = 'Crear Parte';
@endphp

<x-form-card title="{{$tituloCard}}">

    <livewire:documentacion::parte-create-livewire :token="$token" />

    <x-slot name="footer">
        <button type="submit" class="btn btn-primary">{{$nombreBoton}}</button>
        <!-- Agrega más botones aquí -->
    </x-slot>
</x-form-card>



@endsection

@push('js')

@endpush