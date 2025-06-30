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
    Documentos requeridos para la modalidad.
    <span class="font-semibold text-[#e72352]">{{ $nombreModalidad }}</span>
    Una vez que los hayas subido, no podrás volver a cargarlos.
  </p>

  <hr class="my-4 border-t border-gray-300" />

  {{-- Incluir solo el formulario de la modalidad actual --}}
  <form action="{{ route('student.guardar.documentos', ['c_numdoc' => $postulante->c_numdoc]) }}" method="POST" enctype="multipart/form-data">
    @csrf
  
    {{-- Se incluye la vista según modalidad --}}
    @includeIf('student.documentos.' . strtolower($modalidad))


  {{-- <div class="mt-8">
  <h3 class="text-lg font-semibold text-gray-800 mb-2">Resumen de documentos cargados</h3>
  <table class="w-full border border-gray-300 text-sm text-center shadow-sm rounded-md overflow-hidden">
    <thead class="bg-gray-100 text-gray-700">
      <tr>
        <th class="px-3 py-2 text-left">Documento</th>
        <th class="px-3 py-2">¿Cargado?</th>
        <th class="px-3 py-2">Enlace</th>
      </tr>
    </thead>
    <tbody>
      @foreach ([
          'formulario' => 'Formulario de inscripción',
          'pago' => 'Comprobante de pago',
          'dni' => 'DNI del postulante/apoderado',
          'seguro' => 'Seguro de salud',
          'foto' => 'Foto tamaño carné'
      ] as $campo => $label)
        @php
          $archivo = $postulante->documentos?->$campo ?? null;
          $cargado = !empty($archivo);
        @endphp
        <tr class="border-t hover:bg-gray-50">
          <td class="text-left px-3 py-2">{{ $label }}</td>
          <td class="px-3 py-2">
            @if ($cargado)
              <span class="text-green-600 font-medium">Sí</span>
            @else
              <span class="text-red-600 font-medium">No</span>
            @endif
          </td>
          <td class="px-3 py-2">
            @if ($cargado)
              <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $archivo) }}"
                 target="_blank"
                 class="text-blue-600 underline">Ver</a>
            @else
              <span class="text-gray-400 italic">Sin archivo</span>
            @endif
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
</div> --}}

  
    <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-lg cursor-pointer hover:bg-green-700 transition duration-200">
      <i class="fa-solid fa-file-upload mr-2"></i>	
      Guardar Documentos
    </button>
  </form>



  @if ($documentosCompletos)
    {{-- ✅ Documentos completos, no necesita declaración jurada --}}
    <div class="bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded shadow-sm mt-6">
        <div class="flex items-start">
            <i class="fa-solid fa-circle-check text-green-600 mt-1 mr-3"></i>
            <div>
                <h3 class="font-semibold text-base mb-1">Documentación completa</h3>
                <p class="text-sm leading-relaxed">
                    Ya cargaste todos los documentos requeridos. <br>
                    <strong>No necesitas presentar una declaración jurada.</strong>
                </p>
            </div>
        </div>
    </div>
    @elseif($declaracionExiste)
      {{-- ✅ Ya tiene declaración jurada, mostramos solo botón de descarga --}}
      <div class="mt-8 bg-green-100 border-l-4 border-green-600 text-green-800 p-4 rounded-lg shadow-sm">
        <div class="flex items-start">
          <i class="fa-solid fa-circle-check text-green-600 mt-1 mr-3"></i>
          <div>
            <h3 class="font-semibold text-base mb-1">Ya enviaste tu declaración jurada</h3>
            <p class="text-sm leading-relaxed">
              Puedes descargar una copia en PDF si lo necesitas.
            </p>
              <div class="mt-3 flex items-center gap-4 flex-wrap">
                <a href="{{ route('declaracionJurada.descargar',['dni' => $postulante->c_numdoc]) }}" target="_blank"
                  class="inline-flex items-center px-4 py-2 bg-green-600 text-white text-sm font-semibold rounded-md shadow hover:bg-green-700 transition">
                  <i class="fa-solid fa-file-pdf mr-2"></i> Descargar declaración jurada
                </a>

                  {{-- Estado de validación --}}
                  @if(!is_null($djValidado))
                    <span class="inline-flex items-center gap-2 px-3 py-1 rounded-3xl
                                @switch($djValidado)
                                  @case(0) bg-gray-100 text-gray-800 @break
                                  @case(1) bg-red-100 text-red-800 @break
                                  @case(2) bg-green-300 text-green-800 @break
                                @endswitch">
                      <i class="fa-solid
                                @switch($djValidado)
                                  @case(0) fa-clock @break
                                  @case(1) fa-xmark-circle @break
                                  @case(2) fa-check-circle @break
                                @endswitch"></i>
                      @switch($djValidado)
                        @case(0) Pendiente @break
                        @case(1) No válido @break
                        @case(2) Válido @break
                      @endswitch
                    </span>
                  @endif

              </div>
          </div>
        </div>
      </div>
    @else
    {{-- ⚠️ Aún no tiene declaración, mostrar mensaje normal --}}
    <div class="col-span-1 md:col-span-2 mt-8 bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded-lg shadow-sm">
      <div class="flex items-start">
        <i class="fa-solid fa-triangle-exclamation text-yellow-500 mt-1 mr-3"></i>
        <div>
          <h3 class="font-semibold text-base mb-1">¿No cuentas con alguno de los documentos requeridos?</h3>
          <p class="text-sm leading-relaxed">
            Puedes completar una <strong>declaración jurada</strong> comprometiéndote a presentarlos más adelante.
          </p>
          <div class="mt-3">
            <a href="{{ route('declaracionJurada.formulario', ['modalidad' => $modalidad]) }}" target="_blank"
              class="inline-flex items-center px-4 py-2 bg-[#e72352] text-white text-sm font-semibold rounded-md shadow hover:bg-[#c91e45] transition">
              <i class="fa-solid fa-file-signature mr-2"></i> Ir a la declaración jurada
            </a>
          </div>
        </div>
      </div>
    </div>
  @endif
  
</div>
@endsection

<script>
  document.addEventListener('DOMContentLoaded', function () {
      // 1. Documentos cargados (éxito)
      @if (session('success'))
          Swal.fire({
              icon: 'success',
              title: '¡Documentos enviados!',
              text: '{{ session('success') }}',
              confirmButtonColor: '#e72352'
          });
      @endif
  
      // 2. Faltan documentos
      @if (session('documentos_incompletos'))
          Swal.fire({
              icon: 'info',
              title: 'Faltan algunos documentos',
              html: 'Puedes presentar una <strong>declaración jurada</strong> y entregarlos más adelante.',
              confirmButtonColor: '#e72352'
          });
      @endif
  
      // 3. Reemplazo de archivo
      document.querySelectorAll('input[type="file"]').forEach(input => {
          input.addEventListener('change', function () {
              if (this.dataset.existe === "1") {
                  Swal.fire({
                      icon: 'question',
                      title: '¿Deseas reemplazar este archivo?',
                      text: 'Ya has enviado este documento. Si continúas, se actualizará con el nuevo archivo seleccionado.',
                      showCancelButton: true,
                      confirmButtonText: 'Sí, reemplazar',
                      cancelButtonText: 'Cancelar',
                      confirmButtonColor: '#e72352',
                  });
              }
          });
      });
  });
  </script>

  <script>
  document.addEventListener('DOMContentLoaded', function () {
      @if(session('declaracion_enviada'))
          Swal.fire({
              icon: 'success',
              title: '¡Declaración jurada enviada!',
              text: 'Tu declaración fue registrada correctamente. Ahora puedes continuar con la carga de documentos.',
              confirmButtonColor: '#e72352'
          });
      @endif
  });
</script>
