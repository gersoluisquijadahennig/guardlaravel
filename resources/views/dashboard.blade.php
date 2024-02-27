@extends('layouts.dashboard.app')

@section('content')
<div class="container">
    <div class="row justify-content-left">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Módulo Piloto</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    
                    {{ __('Hola!') }} {{ Auth::user()->alias }}
                    {{ __('Estamos logueados en la aplicación!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
