@extends('layouts.app')

@php
    $data = session('datos_postulante');
@endphp

@section('content')

<!-- Loader global -->
<div id="loader-wrapper" class="hidden fixed inset-0 z-[9999] bg-white/80 flex flex-col justify-center items-center">
  <img src="/uma/img/logo-uma.png" alt="Cargando UMA" class="w-16 h-16 mb-4 animate-pulse" />
  <div class="loader"></div>
  <p class="text-sm text-gray-700 mt-2">Procesando datos, por favor espera...</p>
</div>

<style>
.loader {
  width: 120px;
  height: 22px;
  border-radius: 20px;
  color: #e72352;
  border: 2px solid;
  position: relative;
}
.loader::before {
  content: "";
  position: absolute;
  margin: 2px;
  inset: 0 100% 0 0;
  border-radius: inherit;
  background: currentColor;
  animation: l6 2s infinite;
}
@keyframes l6 {
  100% { inset: 0 }
}
</style>


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

  <form method="POST" action="{{ url('/guardaroupdatear') }}" id="formPostulante">
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    let step = 1;
    const steps = ['tab-formdatos', 'tab-uploaddoc', 'tab-postulacion'];
    const btnNext = document.getElementById('btnNext');
    const btnPrev = document.getElementById('btnPrev');
    const stepItems = document.querySelectorAll('.step-item');
    const stepLines = document.querySelectorAll('.step-line');
    const stepLabels = document.querySelectorAll('[data-step-label]');

    function showStep() {
        steps.forEach(function (id, index) {
            const tab = document.getElementById(id);
            tab.classList.toggle('hidden', (index + 1) !== step);
        });
        // Permitir clic en los pasos superiores
        stepItems.forEach(function(item) {
            item.style.cursor = 'pointer';
            item.addEventListener('click', function() {
                const itemStep = parseInt(item.getAttribute('data-step'));
                if (itemStep <= steps.length) {
                    step = itemStep;
                    showStep();
                }
            });
        });

        stepItems.forEach(function (item) {
            const itemStep = parseInt(item.getAttribute('data-step'));
            item.classList.toggle('bg-white', itemStep > step);
            item.classList.toggle('border-gray-300', itemStep > step);
            item.classList.toggle('text-gray-500', itemStep > step);
            item.classList.toggle('bg-[#e72352]', itemStep <= step);
            item.classList.toggle('border-[#e72352]', itemStep <= step);
            item.classList.toggle('text-white', itemStep <= step);
        });

        stepLines.forEach(function (line, index) {
            line.classList.toggle('border-[#e72352]', index < step - 1);
            line.classList.toggle('border-gray-300', index >= step - 1);
        });

        stepLabels.forEach(function (label) {
            const labelStep = parseInt(label.getAttribute('data-step-label'));
            label.classList.toggle('text-[#e72352]', labelStep <= step);
            label.classList.toggle('text-gray-500', labelStep > step);
        });

        btnPrev.disabled = step === 1;
        btnPrev.classList.toggle('opacity-50', step === 1);
        btnPrev.classList.toggle('cursor-not-allowed', step === 1);

        btnNext.textContent = step === steps.length ? 'Confirmar' : 'Siguiente';
    }
  
    function validarFormulario() {
        const campos = [
            { name: 'c_tipdoc', label: 'Tipo de documento' },
            { name: 'c_numdoc', label: 'Número de documento' },
            { name: 'c_nombres', label: 'Nombres' },
            { name: 'c_apepat', label: 'Apellido paterno' },
            { name: 'c_apemat', label: 'Apellido materno' },
            { name: 'id_mod_ing', label: 'Modalidad de ingreso' },
            { name: 'c_codesp1', label: 'Programa de interés' },
            { name: 'id_proceso', label: 'Proceso de admisión' }
        ];


        let errores = [];

        campos.forEach(campo => {
            const input = document.querySelector(`[name="${campo.name}"]`);
            if (input && !input.value.trim()) {
                errores.push(`⚠️ ${campo.label} es obligatorio`);
                input.classList.add('border-red-500');
            } else if (input) {
                input.classList.remove('border-red-500');
            }
        });

        if (errores.length > 0) {
            Swal.fire({
                icon: 'error',
                title: 'Campos requeridos incompletos',
                html: errores.join('<br>'),
            });
            return false;
        }

        return true;
    }

  
      if (btnNext) {
        btnNext.addEventListener('click', async function () {
            if (step < steps.length) {
                step++;
                showStep();
            } else {
              
              if(!validarFormulario()) return;

							document.getElementById('loader-wrapper').classList.remove('hidden'); // ⬅️ Mostrar loader

                const form = document.getElementById('formPostulante');
                const formData = new FormData(form);

                try {
                    const response = await fetch(form.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                        }
                    });
                    const data = await response.json();

										  document.getElementById('loader-wrapper').classList.add('hidden'); // ⬅️ Ocultar loader

                    if (response.ok) {
                        if (data.actualizado) {
													Swal.fire({
															icon: 'success',
															title: 'Datos actualizados',
															text: 'Tus datos fueron actualizados correctamente.',
													}).then(() => {
															document.getElementById('loader-wrapper').classList.remove('hidden');
															setTimeout(() => {
																	window.location.href = '/registro';
															}, 500);
													});
                        } else {
													Swal.fire({
															icon: 'success',
															title: '¡Registro exitoso!',
															text: 'Tu información fue registrada correctamente.',
													}).then(() => {
															document.getElementById('loader-wrapper').classList.remove('hidden');
															setTimeout(() => {
																	window.location.href = '/registro';
															}, 500);
													});
                        }
                    } else {
											    document.getElementById('loader-wrapper').classList.add('hidden'); // También ocultar aquí por si hay error
                      if (data.errors) {
                          const errores = Object.values(data.errors).flat();

                          // Validación específica para número de documento duplicado
                            const documentoDuplicado = errores.find(msg =>
                                msg.toLowerCase().includes('documento') && msg.toLowerCase().includes('ya') && msg.toLowerCase().includes('registrado')
                            );
												
                          if (documentoDuplicado) {
                              Swal.fire({
                                  icon: 'error',
                                  title: 'Documento duplicado',
                                  text: 'Este número de documento ya fue registrado.',
                              });
                          } else {
                              Swal.fire({
                                  icon: 'warning',
                                  title: 'Campos incompletos o inválidos',
                                  html: errores.join('<br>'),
                              });
                          }

                      } else {
                          Swal.fire({
                              icon: 'error',
                              title: 'Error inesperado',
                              text: data.message || 'Ocurrió un error al guardar los datos.',
                          });
                      }
                    }
                } catch (error) {
                    console.error('Error en la solicitud:', error);
										  document.getElementById('loader-wrapper').classList.add('hidden'); // ⬅️ Asegurar que se oculte
                    Swal.fire({
                        icon: 'error',
                        title: 'Error del sistema',
                        text: 'No se pudo conectar con el servidor. Intenta más tarde.',
                    });
                }
            }
        });
      }
      if (btnPrev) {
          btnPrev.addEventListener('click', function () {
              if (step > 1) {
                  step--;
                  showStep();
              }
          });
      }
  
      showStep();
  });
  </script>