@extends('layouts.portal')

@section('content')
<h1>Mev Usuario Política</h1>
@foreach ( $usuariosPoliticas as $usuarioPolitica)
    {{ $usuarioPolitica->rut_funcionario }}
@endforeach
@endsection