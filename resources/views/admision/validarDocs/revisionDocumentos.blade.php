@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto mt-8 bg-white p-6 rounded shadow">
  <h2 class="text-2xl font-bold mb-4">Control de Documentos del Postulante</h2>

  <p class="mb-2 text-sm text-gray-600">
    <strong>DNI:</strong> {{ $postulante->c_numdoc }} <br>
    <strong>Nombre:</strong> {{ $postulante->c_nombres }} {{ $postulante->c_apepat }} {{ $postulante->c_apemat }} <br>
    <strong>Modalidad:</strong> {{ $nombreModalidad }}
  </p>

  <hr class="my-4">

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    @foreach ($documentosRequeridos as $campo)
      @php
        $archivo = $postulante->documentos?->$campo;
        $bloqueado = $postulante->controlDocumentos?->$campo ?? true;
        $label = ucfirst($campo); // Puedes mapearlo a nombres más bonitos si deseas
      @endphp

      <div class="bg-gray-50 p-4 border rounded shadow-sm">
        <h3 class="text-sm font-bold text-gray-800 mb-1">
          <i class="fa-solid fa-file mr-1 text-blue-600"></i> {{ $label }}
        </h3>

        <p class="text-xs text-gray-600 mb-2">
          Estado: 
          @if ($archivo)
            <span class="text-green-600 font-medium">Subido</span>
          @else
            <span class="text-red-600 font-medium">No subido</span>
          @endif
        </p>

        @if ($archivo)
          <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $archivo) }}" 
             class="text-blue-600 text-sm hover:underline" target="_blank">
            <i class="fa-solid fa-link mr-1"></i> Ver documento
          </a>
        @endif

        <form method="POST" action="{{ route('documentos.bloqueo.toggle', [$postulante->id, $campo]) }}" class="mt-3">
          @csrf
          @method('PUT')
          <button type="submit"
                  class="px-4 py-1 text-xs rounded font-medium cursor-pointer
                         {{ $bloqueado ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}
                         text-white">
            <i class="fa-solid {{ $bloqueado ? 'fa-lock-open' : 'fa-lock' }} mr-1"></i>
            {{ $bloqueado ? 'Desbloquear' : 'Bloquear' }}
          </button>
        </form>
      </div>
    @endforeach
  </div>
</div>
@endsection
