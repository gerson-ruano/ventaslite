<!-- resources/views/errors/403.blade.php -->
@extends('layouts.theme.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-danger text-center">
                    <div class="card-header">Acceso Denegado</div>
                    <div class="card-body">
                        <h1 class="card-title">Error 403</h1>
                        <p class="card-text text-dark text-center"><B>
                            Lo siento, {{ Auth::user()->name }}, no tienes los permisos adecuados para acceder a esta página.<B>
                        </p>
                        <p class="card-text text-dark text-center">
                            Si crees que esto es un error, por favor, contacta al administrador del sistema.
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-dark">Volver al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
