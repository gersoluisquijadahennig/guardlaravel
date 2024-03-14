@extends('layouts.dashboard.app')

@section('content')

<livewire:documentacion::parte-index-livewire  :token="$token" :partes="$partes" :origenes="$origenes" />

@endsection

@push('js')
    
@endpush