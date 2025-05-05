@extends('layouts.app')

@section('content')

<style>
  input[type="file"]::file-selector-button {
    background-color: #818181;

  }
  input[type="file"]::file-selector-button:hover {
    background-color: #c91e46;
  }
</style>


<div class="bg-white shadow-lg border border-gray-300 rounded-lg p-6">
  <h1 class="text-2xl font-bold text-black mb-6">Adjunta tus documentos</h1>

  <p class="text-gray-600 text-base mb-6">
    Documentos requeridos para la modalidad <span class="font-semibold text-[#e72352]">Primeros Puestos</span>.
    Pasa el mouse sobre <i class="fa-solid fa-circle-info text-blue-500"></i> para más detalles.
  </p>

  <hr class="my-4 border-t border-gray-300" />

@include('student.primeros_puestos')
  {{-- @include('student.ordinario')
  @include('student.translado_externo')
  @include('student.alto_rendimiento')
  @include('student.admision_tecnicos')
  @include('student.admision_pre_uma') --}}

  <!-- Mensaje informativo -->
  <div class="col-span-1 md:col-span-2 mt-8 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-sm">
    <div class="flex items-start">
      <i class="fa-solid fa-triangle-exclamation text-yellow-500 mt-1 mr-3"></i>
      <div>
        <h3 class="font-semibold text-base mb-1">¿No cuentas con alguno de los documentos requeridos?</h3>
        <p class="text-sm leading-relaxed">
          Si por motivos de demora, trámites en curso u otra causa justificada aún no puedes adjuntar algún documento, puedes completar una <strong>declaración jurada</strong> comprometiéndote a presentarlo en los plazos establecidos.
          <br>
          <span class="text-sm text-gray-700 mt-2 block">Haz clic en el siguiente enlace para acceder al formulario:</span>
        </p>
      </div>
    </div
    <!-- Enlace a la otra página -->
    <div class="mt-4">
      <a href="#" target="_blank"
        class="inline-flex items-center px-4 py-2 bg-[#e72352] text-white text-sm font-semibold rounded-md shadow hover:bg-[#c91e45] transition">
        <i class="fa-solid fa-file-signature mr-2"></i> Ir a la declaración jurada
      </a>
    </div>
  </div>
</div>
@endsection