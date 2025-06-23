@php $doc = $postulante->documentos; @endphp

@foreach ([
    ['formulario', 'Formulario de inscripción', 'Formulario de inscripción virtual, debidamente llenado.'],
    ['pago', 'Comprobante de pago', 'Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión.'],
    ['dni', 'DNI del postulante/apoderado', 'Copia del D.N.I. y de su representante, de ser el caso de menores de edad.'],
    ['seguro', 'Seguro de salud', 'Constancia de seguro de salud (ESSALUD, SIS, seguro particular).'],
    ['foto', 'Foto tamaño carné', 'Fotografía tamaño carné sobre fondo blanco.']
] as [$campo, $label, $tooltip])

@php $archivoExiste = !empty($doc?->$campo); @endphp
@php
  $verificacion = $postulante->verificacion;
  $estado = $verificacion?->{$campo}; // valor de 1, 0 o null
@endphp

<div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 mb-6 w-full pb-4">

  <!-- Columna izquierda: Label + input -->
  <div class="w-full md:w-2/3">
    <label for="{{ $campo }}" class="block text-sm font-semibold text-gray-800 mb-1">
      {{ $label }}
      <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="{{ $tooltip }}"></i>
    </label>

    <input id="{{ $campo }}" type="file" name="{{ $campo }}"
          accept=".pdf, .jpg, .jpeg, .png"
          data-existe="{{ $archivoExiste ? '1' : '0' }}"
          class="block w-full text-sm text-gray-900 border border-gray-300 rounded-md cursor-pointer bg-gray-50 shadow-sm focus:ring-2 focus:ring-blue-300" />

    @if ($archivoExiste)
      <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->$campo) }}"
        target="_blank"
        class="text-blue-600 text-sm mt-2 underline inline-block hover:text-blue-800 transition">
        Ver documento actual
      </a>
    @endif
  </div>

  <!-- Columna derecha: Validación -->
<div class="w-full md:w-1/3">
<div class="w-full md:w-1/3 mt-2 md:mt-0">
  @if ($estado === 1)
    <span class="inline-flex items-center gap-2 text-sm font-medium text-green-700 bg-green-100 px-3 py-1 rounded-full">
      <i class="fa-solid fa-check-circle"></i> Válido
    </span>
  @elseif ($estado === 0)
    <span class="inline-flex items-center gap-2 text-sm font-medium text-red-700 bg-red-100 px-3 py-1 rounded-full">
      <i class="fa-solid fa-xmark-circle"></i> No válido
    </span>
  @else
    <span class="inline-flex items-center gap-2 text-sm font-medium text-white bg-white px-3 py-1 rounded-full">
    </span>
  @endif
</div>

</div>
</div>
@endforeach
