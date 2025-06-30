@php
  $doc = $postulante->documentos;
  $verificacion = $postulante->verificacion;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
  {{-- Constancia de estudios --}}
  @foreach ([
      ['constancia', 'Constancia de estudios', 'Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria'],
      ['constancianotas', 'Certificado académico', 'Certificado o constancia de notas original firmada por autoridad competente de la universidad de origen.'],
      ['constmatricula', 'Constancia matrícula', 'Constancia de primera matrícula de primer periodo de la universidad de origen.'],
      ['syllabus', 'Syllabus visados', 'Certificado o constancia de notas original firmada por autoridad competente de la universidad de origen.']
  ] as [$campo, $label, $tooltip])

  @php
    $archivoExiste = !empty($doc?->$campo);
    $estado = $verificacion?->{$campo};
  @endphp

  <div class="relative bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition-all duration-200 group">
    <!-- Título y tooltip -->
    <div class="flex justify-between items-start">
      <div>
        <h3 class="text-sm font-semibold text-gray-800">
          <i class="fa-solid fa-file-lines mr-1 text-red-600"></i> {{ $label }}
        </h3>
        <p class="text-xs text-gray-500 mt-1" title="{{ $tooltip }}">
          {{ $tooltip }}
        </p>
      </div>
    </div>

    <!-- Subida -->
    <div class="relative mt-5">
      <div class="flex items-stretch w-full max-w-full rounded-md overflow-hidden border border-blue-600 bg-white">
        <input type="file" name="{{ $campo }}" id="{{ $campo }}"
               class="sr-only"
               onchange="mostrarNombreArchivo(event, '{{ $campo }}')" />
        <label for="{{ $campo }}"
               class="inline-flex items-center justify-center px-4 py-2 bg-blue-600 text-white text-sm font-medium border-r border-blue-600 cursor-pointer hover:bg-blue-700 transition whitespace-nowrap">
          <i class="fa-solid fa-upload mr-2"></i> Subir archivo
        </label>
        <span id="nombre-archivo-{{ $campo }}"
              class="flex items-center px-3 text-sm text-gray-800 truncate w-full">
          @if ($archivoExiste)
            {{ $doc->$campo }}
          @else
            Ningún archivo seleccionado
          @endif
        </span>
      </div>
    </div>

    <!-- Enlace -->
    @if ($archivoExiste)
      <div class="mt-3">
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->$campo) }}"
           target="_blank"
           class="text-sm text-blue-600 hover:text-blue-800 underline transition-all duration-200 font-semibold">
          <i class="fa-solid fa-link mr-1"></i> Ver documento actual
        </a>
      </div>
    @endif
  </div>
  @endforeach

  {{-- Documentos comunes --}}
  @include('student.documentos.partials.documentos_comunes')
</div>

<script>
  function mostrarNombreArchivo(event, campo) {
    const input = event.target;
    const nombreArchivo = input.files.length ? input.files[0].name : 'Ningún archivo seleccionado';
    document.getElementById(`nombre-archivo-${campo}`).textContent = nombreArchivo;
  }
</script>
