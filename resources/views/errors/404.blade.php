<!-- resources/views/errors/404.blade.php -->
@extends('layouts.theme.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card text-white bg-dark text-center">
                    <div class="card-header">El Recurso no existe</div>
                    <div class="card-body">
                        <h1 class="card-title text-white">Error 404</h1>
                        <p class="card-text text-white text-center"><B>
                            Lo siento, {{-- Auth::user()->name --}} El recurso no existe o fue removido.<B>
                        </p>
                        <p class="card-text text-white text-center">
                            Si crees que esto es un error, por favor, contacta al administrador del sistema.
                        </p>
                        <a href="{{ route('home') }}" class="btn btn-dark">Volver al Inicio</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
