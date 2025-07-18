@extends('layouts.app')
@section('content')
    <h1>Repotes</h1>

    <a href="{{ route('exportar.consolidado') }}" class="btn btn-success" target="_blank">
            <i class="fas fa-file-excel"></i>  <!-- Ícono de Excel -->
        📥 Descargar Consolidado General
    </a>

    <form method="GET" action="{{ route('exportar.faltantes') }}">
        <select name="modalidad">
            <option value="A">Ordinario</option>
            <option value="B">Primeros Puestos</option>
            <option value="C">Pre-UMA</option>
            <option value="D">Traslado</option>
            <option value="O">Alto Rendimiento</option>
            <option value="L">Técnicos</option>
        </select>
        <button type="submit" class="btn btn-warning">📥 Faltantes por Modalidad</button>
    </form>
@endsection