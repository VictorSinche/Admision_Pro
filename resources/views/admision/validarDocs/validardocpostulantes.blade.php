@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- component -->
<div class="max-w-[100%] mx-auto">
    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between ">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Lista de usurios</h3>
                    <p class="text-slate-500">Revisar a cada persona antes de editar</p>
                </div>
                <div class="flex flex-col gap-2 shrink-0 sm:flex-row">
                    <div class="w-full md:w-72">
                        <div class="relative h-10 w-full min-w-[200px]">
                            <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z"></path>
                                </svg>
                            </div>
                            <input
                                class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                                placeholder=" " />
                            <label
                                class="before:content[' '] after:content[' '] pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all before:pointer-events-none before:mt-[6.5px] before:mr-1 before:box-border before:block before:h-1.5 before:w-2.5 before:rounded-tl-md before:border-t before:border-l before:border-blue-gray-200 before:transition-all after:pointer-events-none after:mt-[6.5px] after:ml-1 after:box-border after:block after:h-1.5 after:w-2.5 after:flex-grow after:rounded-tr-md after:border-t after:border-r after:border-blue-gray-200 after:transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-placeholder-shown:before:border-transparent peer-placeholder-shown:after:border-transparent peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900 peer-focus:before:border-t-2 peer-focus:before:border-l-2 peer-focus:before:!border-gray-900 peer-focus:after:border-t-2 peer-focus:after:border-r-2 peer-focus:after:!border-gray-900 peer-disabled:text-transparent peer-disabled:before:border-transparent peer-disabled:after:border-transparent peer-disabled:peer-placeholder-shown:text-blue-gray-500">
                                Search
                            </label>
                        </div>
                    </div>
            </div>
        </div>
        </div>
        <div class="p-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Nro
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        DNI
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Nombre Completo
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Carrera
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Ver docs.
                    
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Formulario
                        
                            
                            
                            
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Pago
                        
                            
                            
                            
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        DNI
                        
                            
                            
                            
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        DJ
                        
                            
                            
                            
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Acciones
                        </p>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                    1
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    {{-- {{ Str::title($post->c_nombres) }} {{ Str::title($post->c_apepat) }} {{ Str::title($post->c_apemat) }} --}}
                                </p>
                                <p
                                class="text-sm text-slate-500">
                    75986259
                                </p>
                            </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                    Victor Sinche Panduro
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    FARMACIA Y BIOQUIMICA
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex justify-center ">
                                <a 
                                {{-- href="{{ route('postulante.show', $post->id) }}" --}}
                                    class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700 transition">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex justify-center">
                                <input
                                    type="checkbox"
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:outline-none"
                                >
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex justify-center">
                                <input
                                    type="checkbox"
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:outline-none"
                                >
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex justify-center">
                                <input
                                    type="checkbox"
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:outline-none"
                                >
                            </div>
                        </td>

                        <td class="p-4 border-b border-slate-200">
                            <div class="flex justify-center">
                                <input
                                    type="checkbox"
                                    class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 focus:outline-none"
                                >
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                                <!-- Botón Validado -->
                                <a class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700 transition">
                                    <i class="fa-solid fa-circle-check"></i>
                                </a>

                                <!-- Botón No válido -->
                                <a 
                                    class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition"
                                    data-modal-target="modalNoValido"
                                    data-modal-toggle="modalNoValido"
                                    href="javascript:void(0);">
                                    <i class="fa-solid fa-circle-xmark"></i>
                                </a>
                            </div>
                        </td>

                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between p-3">
            <p class="block text-sm text-slate-500">
                Página 1 de 50
            </p>
                <div class="flex gap-1">
                <button 
                {{-- (click)="anteriorPagina()" [disabled]="paginaActual === 1" --}}
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 transition-all hover:opacity-75 disabled:opacity-50">
                    Anterior
                </button>
                <button 
                {{-- (click)="siguientePagina()" [disabled]="paginaActual === totalPaginas" --}}
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 transition-all hover:opacity-75 disabled:opacity-50">
                    Siguiente
                </button>
                </div>
            </div>
        </div>
</div>

<!-- Modal -->
    <div id="modalNoValido" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <!-- Cabecera -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Especificar documentos no válidos</h3>
            <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Campo de texto -->
        <div class="mb-4">
            <label for="motivo" class="block text-sm font-medium text-gray-700 mb-1">Motivo / documentos no válidos:</label>
            <textarea id="motivo" rows="4" class="w-full p-2 border rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <!-- Botón Notificar -->
        <div class="text-right">
            <button onclick="enviarNotificacion()" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                <i class="fa-solid fa-paper-plane"></i>
                Notificar
            </button>
        </div>
    </div>
</div>


<script>
    // Mostrar el modal
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            document.getElementById(modalId).classList.remove('hidden');
        });
    });

    // Cerrar el modal
    function cerrarModal() {
        document.getElementById('modalNoValido').classList.add('hidden');
    }

    // Lógica de notificación
    function enviarNotificacion() {
        const motivo = document.getElementById('motivo').value;
        if (motivo.trim() === '') {
            alert('Por favor, especifica qué documentos no son válidos.');
            return;
        }

        // Aquí puedes usar AJAX o redirigir a una ruta para enviar la notificación
        console.log("Notificando: " + motivo);
        cerrarModal();
        alert('Notificación enviada correctamente.');
    }
</script>


@endsection