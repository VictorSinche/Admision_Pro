@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white shadow-xl rounded-xl overflow-hidden">
  <div class="bg-gradient-to-r from-blue-600 to-indigo-600 px-6 py-4">
    <h2 class="text-black text-2xl font-bold">📂 Control de Documentos del Postulante</h2>
  </div>

  <div class="px-6 py-4 text-gray-800">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-sm mb-4">
      <p><strong>DNI:</strong> {{ $postulante->c_numdoc }}</p>
      <p><strong>Nombre:</strong> {{ $postulante->c_nombres }} {{ $postulante->c_apepat }} {{ $postulante->c_apemat }}</p>
      <p><strong>Modalidad:</strong> {{ $nombreModalidad }}</p>
    </div>

    <hr class="my-4 border-gray-300">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($documentosRequeridos as $campo)
        @php
          $archivo = $postulante->documentos?->$campo;
          $bloqueado = $postulante->controlDocumentos?->$campo ?? false;
          $label = ucfirst($campo); // Puedes personalizar nombres si deseas
        @endphp

        <div class="bg-gray-50 p-4 border border-gray-200 rounded-lg shadow-sm hover:shadow-md transition duration-300">
          <h3 class="text-sm font-semibold text-gray-700 mb-2 flex items-center">
            <i class="fa-solid fa-file mr-2 text-blue-600"></i> {{ $label }}
          </h3>

          <p class="text-xs mb-2">
            <strong>Estado:</strong>
            @if ($archivo)
              <span class="text-green-600 font-medium">Subido</span>
            @else
              <span class="text-red-600 font-medium">No subido</span>
            @endif
          </p>

          @if ($archivo)
            <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $archivo) }}"
               target="_blank"
               class="inline-flex items-center text-sm text-blue-600 hover:underline">
              <i class="fa-solid fa-link mr-1"></i> Ver documento
            </a>
          @endif

          <form method="POST" action="{{ route('documentos.bloqueo.toggle', [$postulante->id, $campo]) }}" class="mt-3">
            @csrf
            @method('PUT')
              <button type="button"
                      class="btn-bloqueo flex items-center px-3 py-1 text-xs rounded font-semibold cursor-pointer
                            {{ $bloqueado ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }}
                            text-white shadow-md transition duration-300"
                      data-accion="{{ $bloqueado ? 'Desbloquear' : 'Bloquear' }}"
                      data-label="{{ $label }}">
                <i class="fa-solid {{ $bloqueado ? 'fa-lock-open' : 'fa-lock' }} mr-2"></i>
                {{ $bloqueado ? 'Desbloquear' : 'Bloquear' }}
              </button>
          </form>
        </div>
      @endforeach
    </div>
  </div>
</div>


<script>
  document.querySelectorAll('.btn-bloqueo').forEach(button => {
    button.addEventListener('click', function (e) {
      e.preventDefault();

      const form = this.closest('form');
      const accion = this.dataset.accion;
      const label = this.dataset.label;

      Swal.fire({
        title: `¿Confirmar ${accion}?`,
        text: `Estás a punto de ${accion.toLowerCase()} el documento "${label}".`,
        input: 'textarea',
        inputLabel: 'Comentario (requerido)',
        inputPlaceholder: 'Escribe aquí el motivo...',
        inputAttributes: {
          'aria-label': 'Comentario obligatorio'
        },
        showCancelButton: true,
        confirmButtonText: 'Sí, confirmar',
        cancelButtonText: 'Cancelar',
        inputValidator: (value) => {
          if (!value) {
            return 'Debes ingresar un comentario';
          }
        }
      }).then((result) => {
        if (result.isConfirmed) {
          // Añadir comentario como input oculto al form
          let input = document.createElement('input');
          input.type = 'hidden';
          input.name = 'observacion';
          input.value = result.value;
          form.appendChild(input);
          form.submit();
        }
      });
    });
  });
</script>
@endsection

