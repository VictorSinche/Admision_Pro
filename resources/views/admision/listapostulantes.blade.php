@extends('layouts.app')

@section('content')
<!-- component -->
<div class="max-w-[100%] mx-auto">
    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between ">
                <div>
                    <h3 class="text-2xl font-semibold text-slate-800">Lista de Postulantes</h3>
                    <p class="text-slate-500">Estados de los proceso de los Postulantes</p>
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
                        <th class="p-4 border-y border-slate-200 bg-slate-50">
                            <input type="checkbox" class="w-4 h-4 text-blue-700 rounded" />
                        </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Postulante
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
                        Informacion
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
                        Pago Incripción
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
                        Documentación
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
                        Declaración Jurada
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
                        Acción
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>

                    </tr>
                </thead>
                    <tbody>
                        @foreach ($postulantes as $post)
                            <tr>
                                <td class="p-4 border-b border-slate-200">
                                    <input type="checkbox" class="w-4 h-4 text-blue-700 rounded focus:ring-blue-700" />
                                </td>

                                <td class="p-4 border-b border-slate-200">
                                    <div class="flex items-center gap-3">
                                        <img src="https://demos.creative-tim.com/test/corporate-ui-dashboard/assets/img/team-3.jpg"
                                            alt="Avatar" class="relative inline-block h-9 w-9 !rounded-full object-cover object-center" />
                                        <div class="flex flex-col">
                                            <p class="text-sm font-semibold text-slate-700">
                                                {{ Str::title($post->nombre_completo) }}
                                            </p>
                                            <p class="text-sm text-slate-500">
                                                {{ $post->email }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                {{-- Estado Información --}}
                                <td class="p-4 border-b border-slate-200">
                                    <div class="w-max">
                                        @if ($post->estado_info === 1)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-green-900 bg-green-500/20 rounded-md uppercase">
                                                Completado
                                            </span>
                                        @elseif ($post->estado_info === 0)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-yellow-500 bg-yellow-500/20 rounded-md uppercase">
                                                Falta confirmar
                                            </span>
                                        @else
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-slate-400 bg-slate-300/20 rounded-md uppercase">
                                                Falta confirmar
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Estado Pago --}}
                                <td class="p-4 border-b border-slate-200">
                                    <div class="w-max">
                                        {{-- @if ($post->estado_dj === 1)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-green-900 bg-green-500/20 rounded-md uppercase">
                                                Declaración OK
                                            </span>
                                        @elseif ($post->estado_dj === 0)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-yellow-500 bg-yellow-500/20 rounded-md uppercase">
                                                Pendiente
                                            </span>
                                        @else --}}
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-slate-400 bg-slate-300/20 rounded-md uppercase">
                                                Sinc registro
                                            </span>
                                        {{-- @endif --}}
                                    </div>
                                </td>

                                {{-- Estado Documentación --}}
                                <td class="p-4 border-b border-slate-200">
                                    <div class="w-max">
                                        @if ($post->estado_docs === 2)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-green-900 bg-green-500/20 rounded-md uppercase">
                                                Completo
                                            </span>
                                        @elseif ($post->estado_docs === 1)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-yellow-500 bg-yellow-500/20 rounded-md uppercase">
                                                Incompleto
                                            </span>
                                        @else
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-slate-400 bg-slate-300/20 rounded-md uppercase">
                                                Pendiente
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Estado Declaración Jurada --}}
                                <td class="p-4 border-b border-slate-200">
                                    <div class="w-max">
                                        @if ($post->estado_dj === 1)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-green-900 bg-green-500/20 rounded-md uppercase">
                                                Declaración OK
                                            </span>
                                        @elseif ($post->estado_dj === 0)
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-yellow-500 bg-yellow-500/20 rounded-md uppercase">
                                                Pendiente
                                            </span>
                                        @else
                                            <span class="relative grid items-center px-2 py-1 text-xs font-bold text-slate-400 bg-slate-300/20 rounded-md uppercase">
                                                Pendiente
                                            </span>
                                        @endif
                                    </div>
                                </td>

                                {{-- Botones de acción --}}
                                <td class="p-4 border-b border-slate-200">
                                    {{-- <button title="Generar código"
                                        class="relative h-10 w-10 rounded-lg text-slate-900 hover:bg-slate-900/10 transition">
                                        <span class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                            <i class="fa-solid fa-square-binary text-2xl"></i>
                                        </span>
                                    </button> --}}

                                    <button 
                                        onclick="abrirModalDocumentos('{{ $post->c_numdoc }}')" 
                                        title="Ver Documentos"
                                        class="relative h-10 w-10 rounded-lg text-slate-900 hover:bg-slate-900/10 transition">
                                        <span class="absolute -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2">
                                            <i class="fa-solid fa-floppy-disk text-2xl"></i>
                                        </span>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

            </table>
        </div>
        <div class="flex items-center justify-between p-3">
            <p class="block text-sm text-slate-500">
                Página 1 de 10
            </p>
                <div class="flex gap-1">
                <button
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 transition-all hover:opacity-75 disabled:opacity-50">
                    Anterior
                </button>
                <button
                    class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 transition-all hover:opacity-75 disabled:opacity-50">
                    Siguiente
                </button>
                </div>
            </div>
        </div>
</div>


<div id="modal-documentos" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white w-full max-w-3xl mx-auto p-6 rounded-lg shadow-2xl relative">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📁 Documentos Adjuntos</h2>

        <label class="block mb-2 text-sm font-medium text-gray-700">Tipo de documento:</label>
        <select id="select-doc" onchange="mostrarDocumento()" class="w-full mb-4 p-2 border rounded">
            <option value="" disabled selected>Seleccione un documento</option>
        </select>

        <div id="preview-doc" class="h-[500px] bg-gray-50 rounded p-4 flex items-center justify-center text-gray-500 border">
            <span>Selecciona un documento para visualizar</span>
        </div>

        <button onclick="cerrarModalDocumentos()" class="absolute top-4 right-4 text-gray-600 hover:text-red-600">
            <i class="fa-solid fa-xmark text-2xl"></i>
        </button>
    </div>
</div>
@endsection

<script>
    function abrirModalDocumentos(dni) {
        fetch(`/documentos-json/${dni}`)
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('select-doc');
                select.setAttribute('data-dni', dni); // 💥 ESTA LÍNEA ES CLAVE
                select.innerHTML = `<option value="" disabled selected>Seleccione un documento</option>`;

                Object.entries(data).forEach(([campo, ruta]) => {
                    if (ruta) {
                        const option = document.createElement('option');
                        option.value = ruta;
                        option.text = campo.toUpperCase();
                        select.appendChild(option);
                    }
                });

                document.getElementById('preview-doc').innerHTML = `<span>Selecciona un documento para visualizar</span>`;
                document.getElementById('modal-documentos').classList.remove('hidden');
            })
            .catch(err => {
                console.error(err);
                alert('Error al cargar documentos.');
            });
    }

    function cerrarModalDocumentos() {
        document.getElementById('modal-documentos').classList.add('hidden');
    }

    function mostrarDocumento() {
        const ruta = document.getElementById('select-doc').value;
        const ext = ruta.split('.').pop().toLowerCase();
        const container = document.getElementById('preview-doc');
        const dni = document.getElementById('select-doc').getAttribute('data-dni');

        const fullRuta = `/storage/postulantes/${dni}/${ruta}`;

        if (['pdf'].includes(ext)) {
            container.innerHTML = `<iframe src="${fullRuta}" class="w-full h-96 border rounded" frameborder="0"></iframe>`;
        } else {
            container.innerHTML = `<a href="${fullRuta}" target="_blank" class="text-blue-600 underline">Ver/descargar documento</a>`;
        }
    }
</script>
