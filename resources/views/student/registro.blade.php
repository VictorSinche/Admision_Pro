@extends('layouts.app')

@section('content')

<div class="mt-0 text-left bg-white shadow-lg border border-gray-300 rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">
        ¡Hola, <span class="text-[#e72352]">Victor Sinche</span>!
    </h1>      
  <p class="text-gray-600 text-lg">
      Por favor, revisa cuidadosamente la información que se muestra a continuación. Si detectas algún error, actualízala antes de continuar con el proceso.
  </p>
</div>

<!-- component -->
<div class="mt-5 text-left bg-white shadow-lg border border-gray-300 rounded-lg p-6">
  <div class="mx-4 p-4">
      <div class="flex items-center">
        <div class="flex items-center text-[#e72352] relative">
          <div data-step="1" class="step-item rounded-full flex items-center justify-center transition duration-500 ease-in-out h-12 w-12 border-2 border-[#e72352]">
            <i class="fa-solid fa-user-plus"></i>
          </div>
          <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-[#e72352]" data-step-label="1">Datos del interasado</div>
        </div>        
        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300 step-line "></div>
        
        <div class="flex items-center text-gray-500 relative">
          <div data-step="2" class="step-item rounded-full flex items-center justify-center transition duration-500 ease-in-out h-12 w-12 border-2 border-gray-300">
            <i class="fa-solid fa-users"></i>
          </div>
          <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-gray-500"  data-step-label="2">Apoderados</div>
        </div>
        <div class="flex-auto border-t-2 transition duration-500 ease-in-out border-gray-300 step-line"></div>
        
        <div class="flex items-center text-gray-500 relative">
          <div data-step="3" class="step-item rounded-full flex items-center justify-center transition duration-500 ease-in-out h-12 w-12 border-2 border-gray-300">
            <i class="fa-solid fa-book"></i>
          </div>
          <div class="absolute top-0 -ml-10 text-center mt-16 w-32 text-xs font-medium uppercase text-gray-500"  data-step-label="3">Postulacion</div>
        </div>        
      </div>
  </div>

  <form method="POST" action="{{ url('/registrar-postulante') }}" id="formPostulante">
    @csrf

    <!-- Aquí dentro va absolutamente todo -->

    <div class="mt-8 p-4">
        <div>
            <div id="tab-formdatos" class="tab-content">
              @include('student.formdatos')
            </div>
            
            <div id="tab-uploaddoc" class="tab-content hidden">
              @include('student.apoderados')
            </div>
            
            <div id="tab-postulacion" class="tab-content hidden">
              @include('student.postulacion')
            </div>      
        </div>
    </div>

    <div class="flex p-2 mt-4">
        <button id="btnPrev" type="button"
        class="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer 
        hover:bg-gray-200 bg-gray-100 text-gray-700 border duration-200 ease-in-out border-gray-600 transition">
            Anterior
        </button>

        <div class="flex-auto flex flex-row-reverse">
            <button id="btnNext" type="button"
            class="text-base ml-2 hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer 
            hover:bg-[#e72352] bg-[#e72352] text-pink-100 border duration-200 ease-in-out border-[#e72352] transition">
                Siguiente
            </button>
        </div>
    </div>
  </form>

</div>

@endsection


{{-- Scripts de SweetAlert por fuera del contenido --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function () {
      @if (session('success'))
          Swal.fire({
              icon: 'success',
              title: '¡Éxito!',
              text: '{{ session('success') }}',
              confirmButtonColor: '#e72352',
          });
      @elseif (session('error'))
          Swal.fire({
              icon: 'error',
              title: '¡Error!',
              text: '{{ session('error') }}',
              confirmButtonColor: '#e72352',
          });
      @endif
  });
</script>

  
<script>
  document.addEventListener('DOMContentLoaded', function() {
      let step = 1;
      const steps = ['tab-formdatos', 'tab-uploaddoc', 'tab-postulacion'];
      const btnNext = document.getElementById('btnNext');
      const btnPrev = document.getElementById('btnPrev');
      const stepItems = document.querySelectorAll('.step-item');
      const stepLines = document.querySelectorAll('.step-line');
      const stepLabels = document.querySelectorAll('[data-step-label]');
  
      function showStep() {
          // Mostrar contenido de los tabs
          steps.forEach(function(id, index) {
              const tab = document.getElementById(id);
              if ((index + 1) === step) {
                  tab.classList.remove('hidden');
              } else {
                  tab.classList.add('hidden');
              }
          });
  
          // Actualizar circulitos (steps arriba)
          stepItems.forEach(function(item) {
              const itemStep = parseInt(item.getAttribute('data-step'));
              if (itemStep < step) {
                  item.classList.remove('bg-white', 'border-gray-300', 'text-gray-500');
                  item.classList.add('bg-[#e72352]', 'border-[#e72352]', 'text-white');
              } else if (itemStep === step) {
                  item.classList.remove('bg-white', 'border-gray-300', 'text-gray-500');
                  item.classList.add('bg-[#e72352]', 'border-[#e72352]', 'text-white');
              } else {
                  item.classList.remove('bg-[#e72352]', 'border-[#e72352]', 'text-white');
                  item.classList.add('bg-white', 'border-gray-300', 'text-gray-500');
              }
          });
  
          // Actualizar líneas (line connecting circles)
          stepLines.forEach(function(line, index) {
              if (index < step - 1) {
                  line.classList.remove('border-gray-300');
                  line.classList.add('border-[#e72352]');
              } else {
                  line.classList.remove('border-[#e72352]');
                  line.classList.add('border-gray-300');
              }
          });

          // Actualizar los textos debajo de los círculos
          stepLabels.forEach(function(label) {
              const labelStep = parseInt(label.getAttribute('data-step-label'));
              if (labelStep <= step) {
                  label.classList.remove('text-gray-500');
                  label.classList.add('text-[#e72352]');
              } else {
                  label.classList.remove('text-[#e72352]');
                  label.classList.add('text-gray-500');
              }
          });
          // Botones de navegación
          if (step === 1) {
              btnPrev.disabled = true;
              btnPrev.classList.add('opacity-50', 'cursor-not-allowed');
          } else {
              btnPrev.disabled = false;
              btnPrev.classList.remove('opacity-50', 'cursor-not-allowed');
          }
  
          if (step === steps.length) {
              btnNext.textContent = 'Confirmar';
          } else {
              btnNext.textContent = 'Siguiente';
          }
      }
      if (btnNext) {
          btnNext.addEventListener('click', function() {
              if (step < steps.length) {
                  step++;
                  showStep();
              } else {
                  console.log('✅ Botón Confirmar clickeado: enviando el formulario...');
                  const form = document.getElementById('formPostulante');
                  if (form) {
                    Swal.fire({
                      icon: 'info',
                      title: 'Enviando...',
                      text: 'Estamos registrando tu información.',
                      timer: 1000,
                      showConfirmButton: false,
                  });
                  setTimeout(() => {
                      form.submit();
                  }, 1000);
                  } else {
                      console.error('❌ No se encontró el formulario con id="formPostulante"');
                  }
              }
          });
      }
      if (btnPrev) {
          btnPrev.addEventListener('click', function() {
              if (step > 1) {
                  step--;
                  showStep();
              }
          });
      }
      showStep();
  });
  </script>