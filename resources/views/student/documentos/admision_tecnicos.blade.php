<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
    <!-- Campo 1 -->
    <div>
      <label for="formulario" class="block text-sm font-medium text-gray-900 mb-1">
        Formulario de inscripción
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Formulario de inscripción virtual, debidamente llenado."></i>
      </label>
      @php
          $doc = $postulante->documentos; // solo hay una fila
          $archivoExiste = !empty($doc?->formulario);
      @endphp
      <input id="formulario" type="file" name="formulario"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
          <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->formulario) }}" 
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
            $doc = $postulante->documentos; // Es solo una fila ahora
            $archivoExiste = !empty($doc?->pago);
      @endphp

      <input id="pago" type="file" name="pago"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"  
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
          <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->pago) }}"
            target="_blank"
            class="text-blue-600 text-sm mt-1 underline inline-block">
            Ver documento actual
          </a>
      @endif
    </div>

    <!-- Campo 3 -->
    <div>
      <label for="constancianotas" class="block text-sm font-medium text-gray-900 mb-1">
        Certificado de Notas
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Certificado o constancia de notas en original y firmado por autoridad competente del centro de estudios (de la carrera técnica o profesional).">
        </i>
      </label>
      @php
        $doc = $postulante->documentos; // solo hay una fila
        $archivoExiste = !empty($doc?->constancianotas);
      @endphp
      <input id="constancianotas" type="file" name="constancianotas"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->constancianotas) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 4 -->
    <div>
      <label for="constmatricula" class="block text-sm font-medium text-gray-900 mb-1">
        Constancia de matrícula
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Constancia de primera matrícula de primer periodo de la institución o universidad.">
        </i>
      </label>
      @php
        $doc = $postulante->documentos; // solo hay una fila
        $archivoExiste = !empty($doc?->constmatricula);
      @endphp
      <input id="constmatricula" type="file" name="constmatricula"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->constmatricula) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 5 -->
    <div>
      <label for="syllabus" class="block text-sm font-medium text-gray-900 mb-1">
        Syllabus visados.
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Syllabus visados.">
        </i>
      </label>
      @php
        $doc = $postulante->documentos; // solo hay una fila
        $archivoExiste = !empty($doc?->syllabus);
      @endphp
      <input id="syllabus" type="file" name="syllabus"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->syllabus) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 6 -->
    <div>
      <label for="certprofecional" class="block text-sm font-medium text-gray-900 mb-1">
        Certificado profesional
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Título técnico o profesional o Constancia de Egresado o Graduado en copia certificada.">
        </i>
      </label>
      @php
        $doc = $postulante->documentos; // solo hay una fila
        $archivoExiste = !empty($doc?->foto);
      @endphp
      <input id="certprofecional" type="file" name="certprofecional"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->foto) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 7 -->
    <div>
      <label for="dni" class="block text-sm font-medium text-gray-900 mb-1">
        DNI del postulante/apoderado
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 c
        ursor-pointer" title="Copia del D.N.I. y de su representante, de ser el caso de menores de edad."></i>
      </label>
      @php
        $doc = $postulante->documentos; // solo hay una fila
        $archivoExiste = !empty($doc?->dni);
      @endphp
      <input id="dni" type="file" name="dni"
            data-existe="{{ $archivoExiste ? '1' : '0' }}"
            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->dni) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 8 -->
    <div>
      <label for="seguro" class="block text-sm font-medium text-gray-900 mb-1">
        Seguro de salud
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Constancia de seguro de salud (ESSALUD, SIS, seguro particular)."></i>
      </label>
      @php
        $doc = $postulante->documentos; // solo hay una fila
        $archivoExiste = !empty($doc?->seguro);
      @endphp
      <input id="seguro" type="file" name="seguro"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->seguro) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>

    <!-- Campo 9 -->
    <div>
      <label for="foto" class="block text-sm font-medium text-gray-900 mb-1">
        Foto tamaño carné
        <i class="fa-solid fa-circle-info text-blue-500 ml-1 cursor-pointer" title="Fotografía tamaño carné sobre fondo blanco."></i>
      </label>
      @php
        $doc = $postulante->documentos; // solo hay una fila
        $archivoExiste = !empty($doc?->foto);
      @endphp
      <input id="foto" type="file" name="foto"
        data-existe="{{ $archivoExiste ? '1' : '0' }}"
        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50" />
      @if ($archivoExiste)
        <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $doc->foto) }}"
          target="_blank"
          class="text-blue-600 text-sm mt-1 underline inline-block">
          Ver documento actual
        </a>
      @endif
    </div>
  </div>