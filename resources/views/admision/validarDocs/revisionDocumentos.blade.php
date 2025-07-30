@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto mt-12 bg-white shadow-2xl rounded-xl overflow-hidden">
  <div class="bg-gradient-to-r from-blue-700 to-indigo-700 px-8 py-5">
    <h2 class="text-2xl font-bold flex items-center gap-2">
      <i class="fa-solid fa-folder-open" style="color: #FFD43B;"></i> Control de Documentos del Postulante
    </h2>
  </div>

  <div class="px-8 py-6 text-gray-800">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-base font-medium mb-6">
      <p><span class="font-semibold text-gray-600">📌 <strong>DNI:</strong></span> {{ $postulante->c_numdoc }}</p>
      <p><span class="font-semibold text-gray-600">👤 <strong>Nombre:</strong></span> {{ $postulante->c_nombres }} {{ $postulante->c_apepat }} {{ $postulante->c_apemat }}</p>
      <p><span class="font-semibold text-gray-600">🎓 <strong>Modalidad:</strong></span> {{ $nombreModalidad }}</p>
    </div>

    <hr class="my-6 border-gray-300">

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
      @foreach ($documentosRequeridos as $campo)
        @php
          $archivo = $postulante->documentos?->$campo;
          $bloqueado = $postulante->controlDocumentos?->$campo ?? false;
          $label = ucfirst($campo);
          $verificacion = $postulante->verificacion;
          $estado = $verificacion?->{$campo};
        @endphp

        <div class="relative bg-white p-5 border border-gray-200 rounded-xl shadow hover:shadow-lg transition duration-300 flex flex-col justify-between">
          
          {{-- BADGE DE ESTADO EN ESQUINA SUPERIOR DERECHA --}}
          <div class="absolute top-3 right-3">
            @switch($estado)
              @case(2)
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 text-xs font-semibold rounded-full shadow">
                  <i class="fa-solid fa-check-circle"></i> Válido
                </span>
                @break
              @case(1)
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-red-100 text-red-600 text-xs font-semibold rounded-full shadow">
                  <i class="fa-solid fa-xmark-circle"></i> No válido
                </span>
                @break
              @default
                <span class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full shadow">
                  <i class="fa-regular fa-clock"></i> Pendiente
                </span>
            @endswitch
          </div>

          <div>
            <h3 class="text-base font-bold text-blue-800 mb-3 flex items-center gap-2">
              <i class="fa-solid fa-file text-blue-600"></i> {{ $label }}
            </h3>

            <p class="text-sm mb-2">
              <span class="font-bold">🚦 Estado:</span>
              @if ($archivo)
                <span class="text-green-600 font-semibold">Subido</span>
              @else
                <span class="text-red-600 font-semibold">No subido</span>
              @endif
            </p>

            @if ($archivo)
              <a href="{{ asset('storage/postulantes/' . $postulante->c_numdoc . '/' . $archivo) }}"
                 target="_blank"
                 class="inline-flex items-center text-sm text-blue-600 hover:underline">
                <i class="fa-solid fa-link mr-1"></i> Ver documento
              </a>
            @endif
          </div>

          <form method="POST" action="{{ route('documentos.bloqueo.toggle', [$postulante->id, $campo]) }}" class="mt-4">
            @csrf
            @method('PUT')
            <button type="submit"
                    class="w-full flex items-center justify-center gap-2 px-3 py-2 text-xs font-bold rounded-lg transition 
                    {{ $bloqueado ? 'bg-green-600 hover:bg-green-700' : 'bg-red-600 hover:bg-red-700' }} text-white shadow">
              <i class="fa-solid {{ $bloqueado ? 'fa-lock-open' : 'fa-lock' }}"></i>
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

