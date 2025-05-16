
<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Campo 1 -->
    <div>
      <label for="formulario" class="block text-sm font-medium text-gray-900 mb-1">
        Formulario de inscripción
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Formulario de inscripción virtual, debidamente llenado."></i>
      </label>
      @php
        $docExistente = $postulante->documentos->where('tipo_documento', 'Formulario de inscripción')->first();
        $archivoExiste = $docExistente && $docExistente->archivo; // Solo true si hay archivo
      @endphp
      <input id="formulario" type="file" name="formulario" data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $docExistente->archivo) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 2 -->
    <div>
      <label for="pago" class="block text-sm font-medium text-gray-900 mb-1">
        Comprobante de pago
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión."></i>
      </label>
      @php
        $docExistente = $postulante->documentos->where('tipo_documento', 'Comprobante de pago')->first();
        $archivoExiste = $docExistente && $docExistente->archivo; // Solo true si hay archivo
      @endphp
      <input id="pago" type="file" name="pago" data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $docExistente->archivo) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 3 -->
    <div>
      <label for="constancia" class="block text-sm font-medium text-gray-900 mb-1">
        Constancia de estudios
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria.">
        </i>
      </label>
      @php
        $docExistente = $postulante->documentos->where('tipo_documento', 'Constancia de estudios')->first();
        $archivoExiste = $docExistente && $docExistente->archivo; // Solo true si hay archivo
      @endphp
      <input id="constancia" type="file" name="constancia" data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gra-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $docExistente->archivo) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 4 -->
    <div>
      <label for="dni" class="block text-sm font-medium text-gray-900 mb-1">
        DNI del postulante/apoderado
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Copia del D.N.I. del postulante y del apoderado si es menor de edad."></i>
      </label>
      @php
        $docExistente = $postulante->documentos->where('tipo_documento', 'DNI')->first();
        $archivoExiste = $docExistente && $docExistente->archivo; // Solo true si hay archivo
      @endphp
      <input id="dni" type="file" name="dni" data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
        @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $docExistente->archivo) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 5 -->
    <div>
      <label for="seguro" class="block text-sm font-medium text-gray-900 mb-1">
        Seguro de salud
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Constancia de seguro de salud (ESSALUD, SIS, seguro particular)."></i>
      </label>
      @php
        $docExistente = $postulante->documentos->where('tipo_documento', 'Seguro de salud')->first();
        $archivoExiste = $docExistente && $docExistente->archivo; // Solo true si hay archivo
      @endphp
      <input id="seguro" type="file" name="seguro" data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
        @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $docExistente->archivo) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 6s -->
    <div>
      <label for="foto" class="block text-sm font-medium text-gray-900 mb-1">
        Foto tamaño carné
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Fotografía tamaño carné sobre fondo blanco."></i>
      </label>
      @php
        $docExistente = $postulante->documentos->where('tipo_documento', 'Foto tamaño carné')->first();
        $archivoExiste = $docExistente && $docExistente->archivo; // Solo true si hay archivo
      @endphp
      <input id="foto" type="file" name="foto" data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
        @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $docExistente->archivo) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

  </div>