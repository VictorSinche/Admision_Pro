@php
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
@endphp

<link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
<script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- CDN Tom Select -->
<link href="/tom-select/tom-select.css" rel="stylesheet">
<script src="/tom-select/tom-select.complete.min.js"></script>

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
        <div class="flex items-center justify-between">
            <div class="flex items-center justify-start rtl:justify-end">
            <a href="https://uma.edu.pe" class="flex ms-2 md:me-24" target="black">
                <img src="/uma/img/logo-uma.ico" class="h-8 me-3" alt="FlowBite Logo" />
                <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">UMA</span>
            </a>
            </div>
            <div class="flex items-center">
                <div class="relative ms-3">
                    <div>
                        <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                            <img class="w-8 h-8 rounded-full" src="{{ asset('uma/img/students.png') }}" alt="user photo">
                        </button>
                    </div>
                    <!-- Menú de usuario -->
                    <div id="dropdown-user" class="absolute right-0 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow dark:bg-gray-700 dark:divide-gray-600">
                        <ul class="py-1" role="none">
                            <li>
                            <a href="{{ route('auth.login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Login</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="p-4 min-h-screen">
{{--  lOADER --}}
<div id="loader-wrapper" class="hidden fixed inset-0 z-[9999] bg-white/80 flex flex-col justify-center items-center">
    <img src="/uma/img/logo-uma.png" alt="Cargando UMA" class="w-16 h-16 mb-4 animate-pulse" />
    <div class="loader"></div>
    <p class="text-sm text-gray-700 mt-2">Cargando, por favor espera...</p>
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
{{--  ENDlOADER --}}
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 bg-white shadow-md">
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
            <form method="POST" action="{{ route('postulante.store') }}" id="formPostulante">
                @csrf
                <!-- Aquí dentro va absolutamente todo -->
                <div class="mt-8 p-4">
                    <div>
                        <div id="tab-formdatos" class="tab-content">
                        @include('register.formdatos')
                        </div>
                        
                        <div id="tab-uploaddoc" class="tab-content hidden">
                        @include('register.apoderados')
                        </div>
                        
                        <div id="tab-postulacion" class="tab-content hidden">
                        @include('register.postulacion')
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
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdownToggles = document.querySelectorAll('[data-dropdown-toggle]');
    
        dropdownToggles.forEach(function (toggle) {
            const targetId = toggle.getAttribute('data-dropdown-toggle');
            const targetElement = document.getElementById(targetId);
    
            toggle.addEventListener('click', function (event) {
                event.stopPropagation(); // evita cerrar instantáneamente
                targetElement.classList.toggle('hidden');
            });
    
            // Cerrar el dropdown si haces click afuera
            document.addEventListener('click', function (e) {
                if (!toggle.contains(e.target) && !targetElement.contains(e.target)) {
                    targetElement.classList.add('hidden');
                }
            });
        });
    });
</script>

<script>
    function mostrarLoader() {
        document.getElementById('loader-wrapper').classList.remove('hidden');
    }
    function ocultarLoader() {
        document.getElementById('loader-wrapper').classList.add('hidden');
    }
</script>

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
        // stepItems.forEach(function(item) {
        //     item.style.cursor = 'pointer';
        //     item.addEventListener('click', function() {
        //         const itemStep = parseInt(item.getAttribute('data-step'));
        //         if (itemStep <= steps.length) {
        //             step = itemStep;
        //             showStep();
        //         }
        //     });
        // });

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

    function validarPasoActual() {
        let campos = [];

        if (step === 1) {
            campos = [
                { name: 'tipo_documento', label: 'Tipo de documento' },
                { name: 'c_numdoc', label: 'Número de documento' },
                { name: 'c_nombres', label: 'Nombres' },
                { name: 'c_apepat', label: 'Apellido paterno' },
                { name: 'c_apemat', label: 'Apellido materno' },
                { name: 'c_email', label: 'Correo Electrónico' },
                { name: 'c_dir', label: 'Dirección' },
                { name: 'c_sexo', label: 'Genero' },
                { name: 'd_fecnac', label: 'Fecha de Nacimiento' },
                { name: 'c_ubigeo', label: 'Ubicación' },
                { name: 'c_celu', label: 'Celular' }         
            ];
        } else if (step === 2) {
            campos = [
                // { name: 'c_nomapo', label: 'Nombre del apoderado' },
                // { name: 'c_dniapo', label: 'DNI del apoderado' },
                // { name: 'c_celuapo', label: 'Celular del apoderado' }
            ];
        } else if (step === 3) {
            campos = [
                { name: 'c_anoegreso', label: 'Programa de estudio' },
                { name: 'c_sedcod', label: 'Sede' },
                { name: 'c_tippro', label: 'Seleccione Proceso de admisión' },
                { name: 'id_mod_ing', label: 'Modalidad de ingreso' },
                { name: 'c_codesp1', label: 'Seleccione el Programa de Interés' },
                { name: 'id_tab_turno', label: 'Turno' },
            ];
        }

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

        // Validación específica para correo electrónico
            const emailInput = document.querySelector('[name="c_email"]');
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

            if (emailInput && !emailRegex.test(emailInput.value.trim())) {
                errores.push('⚠️ Correo electrónico no es válido');
                emailInput.classList.add('border-red-500');
            }


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


    function validarFormulario() {
        const campos = [
            { name: 'c_anoegreso', label: 'Programa de estudio' },
            { name: 'c_sedcod', label: 'Sede' },
            { name: 'c_tippro', label: 'Seleccione Proceso de admisión' },
            { name: 'id_mod_ing', label: 'Modalidad de ingreso' },
            { name: 'c_codesp1', label: 'Seleccione el Programa de Interés' },
            { name: 'id_tab_turno', label: 'Turno' },
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
                if (!validarPasoActual()) return; // Solo avanza si pasa validación
                step++;
                showStep();
            } else {
                if (!validarFormulario()) return; // Último paso
                mostrarLoader()

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
                    ocultarLoader(

                    )
                    if (response.ok) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Confirmacion exitoso!',
                            text: data.message || 'Tu información fue registrada correctamente.',
                            confirmButtonText: 'Ir al login',
                        }).then(()=>{
                            window.location.href = '/'
                        });

                    } else {
                    if (data.errors) {
                        const errores = Object.values(data.errors).flat();

                        // Validación específica para número de documento duplicado
                        const documentoDuplicado = errores.find(msg => msg.includes('numero documento') && msg.includes('taken'));

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
                    ocultarLoader()
                    console.error('Error en la solicitud:', error);
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

    function aplicarTomSelectEnPasoActual() {
        // Esto aplicará TomSelect solo a los selects visibles
        document.querySelectorAll('.tab-content:not(.hidden) select.tom-select').forEach(function (el) {
            if (!el.tomselect) {
                new TomSelect(el, {
                    create: false,
                    sortField: {
                        field: "text",
                        direction: "asc"
                    },
                    placeholder: el.getAttribute('placeholder') || 'Seleccione una opción...'
                });
            }
        });
    }

    showStep();
    aplicarTomSelectEnPasoActual();
});
</script>
