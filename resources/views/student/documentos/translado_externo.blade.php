@php
  $doc = $postulante->documentos;
  $verificacion = $postulante->verificacion;
  $control = $postulante->controlDocumentos;
  $bloqueoPorFecha = $postulante->fecha_limite_docs
                    ? \Carbon\Carbon::now()->gt(\Carbon\Carbon::parse($postulante->fecha_limite_docs))
                    : false;
@endphp

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">

  @foreach ([
      ['constancianotas', 'Certificado académico', 'Certificado o constancia de notas original firmada por autoridad competente de la universidad de origen.'],
      ['syllabus', 'Syllabus visados', 'Certificado o constancia de notas original firmada por autoridad competente de la universidad de origen.']
  ] as [$campo, $label, $tooltip])

  @php
    $archivoExiste = !empty($doc?->$campo);
    $estado = $verificacion?->{$campo};
    $bloqueado = optional($postulante->controlDocumentos)->$campo ?? false;
  @endphp

  <div class="relative bg-white rounded-xl border border-gray-200 p-5 shadow-sm hover:shadow-md transition-all duration-200 group">
    <!-- Título y tooltip -->
    <div class="flex justify-between items-start">
      <div>
        <h3 class="text-sm font-semibold text-gray-800">
          <i class="fa-solid fa-file-lines mr-1 text-blue-600"></i> {{ $label }}
        </h3>
        <p class="text-xs text-gray-500 mt-1" title="{{ $tooltip }}">
          {{ $tooltip }}
        </p>
      </div>
            <!-- Estado -->
      <div>
        @switch($estado)
          @case(2)
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">
              <i class="fa-solid fa-check-circle"></i> Válido
            </span>
            @break
          @case(1)
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-[#E72352] text-xs font-medium rounded-full">
              <i class="fa-solid fa-xmark-circle"></i> No válido
            </span>
            @break
          @default
            <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">
              <i class="fa-regular fa-clock"></i> Pendiente
            </span>
        @endswitch
      </div>
    </div>

    <!-- Subida -->
    <div class="relative mt-5">
      <div class="flex items-stretch w-full max-w-full rounded-md overflow-hidden border border-blue-600 bg-white">
        <input type="file" name="{{ $campo }}" id="{{ $campo }}"
              class="sr-only"
              accept=".png, .jpg, .jpeg, .pdf"
              onchange="mostrarNombreArchivo(event, '{{ $campo }}')"
              data-existe="{{ $archivoExiste ? 1 : 0 }}"
              {{ ($bloqueado || $bloqueoPorFecha) ? 'disabled' : '' }} />

        <label for="{{ $campo }}"
              class="inline-flex items-center justify-center px-4 py-2 text-white text-sm font-medium border-r transition whitespace-nowrap
                {{ ($bloqueado || $bloqueoPorFecha) ? 'bg-gray-400 cursor-not-allowed' : 'bg-blue-600 hover:bg-blue-700 cursor-pointer' }}">
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

      @if ($archivoExiste && $bloqueado)
        <div class="mt-2 text-xs text-red-500 flex items-center gap-2">
          <i class="fa-solid fa-lock"></i> Documento bloqueado
        </div>
      @elseif (!$archivoExiste && $bloqueoPorFecha)
        <div class="mt-2 text-xs text-red-500 flex items-center gap-2">
          <i class="fa-solid fa-clock"></i> Plazo vencido para subir documentos
        </div>
      @endif
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

