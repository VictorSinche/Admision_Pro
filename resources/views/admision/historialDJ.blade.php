@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- component -->
<div class="max-w-[100%] mx-auto">
    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Título -->
            <div>
                <h3 class="text-2xl font-semibold text-slate-800">Historial de Declaraciones Juradas</h3>
                <p class="text-slate-500"> </p>
            </div>

            <!-- Contenedor derecho: buscador + formulario -->
            <div class="flex flex-col sm:flex-row items-center gap-3">
                <!-- Select + botón -->
                <form action="{{ route('exceldj') }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <select id="tipo_admision" name="tipo_admision[]" class="select2 w-80" multiple></select>

                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg shadow-sm transition">
                        <i class="fas fa-file-excel mr-2"></i> Exportar
                    </button>
                </form>
                                <!-- Buscador -->
                <div class="w-full md:w-72">
                    <div class="relative h-10 w-full min-w-[200px]">
                        <div class="absolute grid w-5 h-5 top-2/4 right-3 -translate-y-2/4 place-items-center text-blue-gray-500">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" aria-hidden="true" class="w-5 h-5">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z">
                                </path>
                            </svg>
                        </div>
                        <input
                            class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 font-sans text-sm font-normal text-blue-gray-700 outline-0 transition-all placeholder-shown:border placeholder-shown:border-blue-gray-200 placeholder-shown:border-t-blue-gray-200 focus:border-2 focus:border-gray-900 focus:border-t-transparent focus:outline-0 disabled:border-0 disabled:bg-blue-gray-50"
                            placeholder=" " />
                        <label
                            class="pointer-events-none absolute left-0 -top-1.5 flex h-full w-full select-none !overflow-visible truncate text-[11px] font-normal leading-tight text-gray-500 transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:leading-[3.75] peer-placeholder-shown:text-blue-gray-500 peer-focus:text-[11px] peer-focus:leading-tight peer-focus:text-gray-900">
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
                        ID
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
                        Tipo de Admisión
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
                        Fecha registro
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
                        Acciones
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
                        </p>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($postulantes as $post)
                        <tr>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ $post->id }}
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex items-center gap-3">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ Str::title($post->c_nombres) }} {{ Str::title($post->c_apepat) }} {{ Str::title($post->c_apemat) }}
                                </p>
                                <p
                                class="text-sm text-slate-500">
                                    {{ $post->c_email }}
                                </p>
                            </div>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ $post->c_numdoc }}
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ Str::title($post->nomesp) }}
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    {{ Str::title($post->nombre_modalidad) }}
                                </p>
                            </div>
                        </td>
                        <td class="p-4 border-b border-slate-200">
                            <div class="flex flex-col">
                                <p class="text-sm font-semibold text-slate-700">
                                    @if ($post->dj_fecha)
                                        {{ \Carbon\Carbon::parse($post->dj_fecha)->format('Y-m-d') }}
                                    @else
                                        <span class="text-muted">Sin fecha</span>
                                    @endif                                </p>
                            </div>
                        </td>
                            <td class="p-4 border-b border-slate-200 text-center">
                                @if ($post->dj_id)
                                    <a href="{{ route('declaracionJurada.descargar', ['dni' => $post->c_numdoc]) }}"
                                        class="inline-flex items-center justify-center h-10 w-10 rounded-lg text-slate-900 hover:bg-slate-900/10 transition no-loader"
                                        title="Descargar DJ"
                                        target="_blank">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path d="M12 16l4-5h-3V4h-2v7H8l4 5zm8 2H4v2h16v-2z"/>
                                        </svg>
                                    </a>
                                @else
                                    <span class="text-slate-400 text-sm">No disponible</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
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

<!-- Script personalizado con valores locales -->
<script>
    const tiposAdmisiones = [
        { label: 'Ordinario', value: 'A' },
        { label: 'Pre-UMA', value: 'C' },
        { label: 'Traslado Externo', value: 'D' },
        { label: 'Técnicos', value: 'L' },
        { label: 'Alto Rendimiento', value: 'O' },
        { label: 'Primeros Puestos', value: 'B' },

    ];

    $(document).ready(function () {
        const $select = $('#tipo_admision');

        // Agrega las opciones directamente al select
        tiposAdmisiones.forEach(op => {
            const option = new Option(op.label, op.value, false, false);
            $select.append(option);
        });

        // Inicializa Select2
        $select.select2({
            placeholder: "Selecciona uno o más tipos de admisión",
            allowClear: true
        });
    });
</script>
@endsection