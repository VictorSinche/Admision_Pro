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
    Adjunta cada uno de los siguientes archivos requeridos. Coloque el mouse encima de <i class="fa-solid fa-circle-info text-blue-500"></i> para ver más información.
  </p>

  <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Campo 1 -->
    <div>
      <label for="formulario" class="block text-sm font-medium text-gray-900 mb-1">
        Formulario de inscripción
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Formulario de inscripción virtual, debidamente llenado."></i>
      </label>
      <input id="formulario" type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
    </div>

    <!-- Campo 2 -->
    <div>
      <label for="pago" class="block text-sm font-medium text-gray-900 mb-1">
        Comprobante de pago
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión."></i>
      </label>
      <input id="pago" type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
    </div>

    <!-- Campo 3 -->
    <div>
      <label for="constancia" class="block text-sm font-medium text-gray-900 mb-1">
        Constancia de estudios
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria">
        </i>
      </label>
      <input id="constancia" type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
    </div>

    <!-- Campo 4 -->
    <div>
      <label for="merito" class="block text-sm font-medium text-gray-900 mb-1">
        Constancia de mérito
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Constancia o resolución original del director del colegio de procedencia que acredite el orden de mérito requerido. (debe haber egresado los dos últimos años inmediatos a la fecha de admisión).">
        </i>
      </label>
      <input id="merito" type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
    </div>

    <!-- Campo 5 -->
    <div>
      <label for="dni" class="block text-sm font-medium text-gray-900 mb-1">
        DNI del postulante/apoderado
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Copia del D.N.I. del postulante y del apoderado si es menor de edad."></i>
      </label>
      <input id="dni" type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
    </div>

    <!-- Campo 6 -->
    <div>
      <label for="seguro" class="block text-sm font-medium text-gray-900 mb-1">
        Seguro de salud
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Constancia de ESSALUD, SIS u otro seguro."></i>
      </label>
      <input id="seguro" type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
    </div>

    <!-- Campo 7 -->
    <div>
      <label for="foto" class="block text-sm font-medium text-gray-900 mb-1">
        Foto tamaño carné
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Fotografía tamaño carné sobre fondo blanco."></i>
      </label>
      <input id="foto" type="file"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
    </div>

  </div>
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