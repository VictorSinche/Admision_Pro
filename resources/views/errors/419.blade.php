@extends('layouts.app') <!-- o usa 'layouts.error' si tienes una vista especial para errores -->

@section('title', 'Sesión expirada')

@section('content')
<div class="container text-center mt-5">
    <h1 class="display-4 text-danger">⚠️ ¡Oops! Sesión expirada</h1>
    <p class="lead">Por tu seguridad, la sesión ha caducado debido a inactividad o un problema con el formulario.</p>
    <p>Por favor, vuelve a intentarlo. Si el problema persiste, recarga la página o contacta al soporte.</p>

    <a href="{{ url()->previous() }}" class="btn btn-primary mt-4">🔄 Volver atrás</a>
    <a href="{{ url('/') }}" class="btn btn-outline-secondary mt-4">🏠 Ir al inicio</a>
</div>
@endsection
