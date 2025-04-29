@extends('layouts.app')

@section('content')

<div class="mt-0 text-left bg-white shadow-md rounded-lg p-6">
  <h1 class="text-2xl font-bold text-[#e72352] mb-4">
      ¡Hola, Victor Sinche!
  </h1>
  <p class="text-gray-600 text-lg">
      Por favor, revisa cuidadosamente la información que se muestra a continuación. Si detectas algún error, actualízala antes de continuar con el proceso.
  </p>
</div>


<!-- Tabs Header -->
<div class="border-b border-gray-200 mt-5">
  <ul class="flex flex-wrap text-sm font-medium text-center text-black dark:text-black" id="tabs-nav">
    <li class="me-2">
      <button type="button" data-tab="formdatos"
        class="tab-link inline-block p-4 rounded-t-lg active text-black bg-black dark:bg-white dark:text-[#e72352]">
        Datos del interesado
      </button>
    </li>
    {{-- <li class="me-2">
      <button type="button" data-tab="uploaddoc"
        class="tab-link inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
        Procedencia del interesado
      </button>
    </li> --}}
    <li class="me-2">
      <button type="button" data-tab="postulacion"
        class="tab-link inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
        Postulacion del interesado
      </button>
    </li>
    <li class="me-2">
      <button type="button" data-tab="firmardoc"
        class="tab-link inline-block p-4 rounded-t-lg hover:text-gray-600 hover:bg-gray-50 dark:hover:bg-gray-800 dark:hover:text-gray-300">
        Datos del apoderado
      </button>
    </li>
  </ul>
</div>

<!-- Tabs Content -->
<div class="p-6 bg-white rounded-lg shadow-md">
  
  <!-- Formulario de datos presenciales -->
  <div id="tab-formdatos" class="tab-content">
    @include('student.formdatos')
  </div>

  <!-- Subir Documentos -->
  <div id="tab-uploaddoc" class="tab-content hidden">
    @include('student.uploaddoc')
  </div>

  <!-- Firmar Documentos -->
  <div id="tab-postulacion" class="tab-content hidden">
    @include('student.postulacion')
  </div>

</div>

@endsection

<!-- Script para manejar pestañas -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
      const tabLinks = document.querySelectorAll('.tab-link');
      const tabContents = document.querySelectorAll('.tab-content');
  
      tabLinks.forEach(link => {
          link.addEventListener('click', () => {
              const targetTab = link.getAttribute('data-tab');
  
              // Ocultar todos los contenidos
              tabContents.forEach(content => content.classList.add('hidden'));
  
              // Mostrar el contenido seleccionado
              document.getElementById('tab-' + targetTab).classList.remove('hidden');
  
              // Resetear todas las pestañas
              tabLinks.forEach(l => {
                  l.classList.remove('text-black', 'bg-black', 'dark:bg-white', 'dark:text-[#e72352]', 'active');
                  l.classList.add('hover:text-gray-600', 'hover:bg-gray-50', 'dark:hover:bg-gray-800', 'dark:hover:text-gray-300');
              });
  
              // Activar la pestaña seleccionada
              link.classList.add('text-black', 'bg-black', 'dark:bg-white', 'dark:text-[#e72352]', 'active');
              link.classList.remove('hover:text-gray-600', 'hover:bg-gray-50', 'dark:hover:bg-gray-800', 'dark:hover:text-gray-300');
          });
      });
  
      // Activar la primera pestaña al cargar
      if (tabLinks.length > 0) {
          tabLinks[0].click();
      }
  });
  </script>
  