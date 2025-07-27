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
                    <h3 class="text-lg font-semibold text-slate-800">Lista de usuarios</h3>
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
                <button id="btn-abrir-modal" class="bg-slate-800 text-white px-4 py-2 rounded-md text-sm hover:bg-slate-700">
                    Añadir usuario
                </button>
            </div>
        </div>
        </div>
        <div class="overflow-y-auto max-h-[70vh] mt-4">
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
                        Grado
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
                        Estado
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
                        </p>
                    </th>

                    </tr>
                </thead>
                <tbody>
                    @forelse ($usuarios as $usuario)
                        <tr>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $usuario->id }}
                                    </p>
                                </div>
                            </td>

                            <td class="p-4 border-b border-slate-200">
                                <div class="flex items-center gap-3">
                                    <div class="flex flex-col">
                                        <p class="text-sm font-semibold text-slate-700">
                                            {{ $usuario->nombre }} {{ $usuario->apellidos }}
                                        </p>
                                        <p class="text-sm text-slate-500">
                                            {{ $usuario->email }}
                                        </p>
                                    </div>
                                </div>
                            </td>

                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $usuario->grado ?? '---' }}
                                    </p>
                                </div>
                            </td>

                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <span class="w-max px-2 py-1 rounded text-xs font-bold uppercase text-center
                                        {{ $usuario->estado ? 'bg-green-200 text-green-800' : 'bg-red-200 text-red-800' }}">
                                        {{ $usuario->estado ? 'Activo' : 'Inactivo' }}
                                    </span>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm text-slate-500">
                                        {{ $usuario->created_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-sm text-slate-500 p-4">
                                No hay usuarios registrados.
                            </td>
                        </tr>
                    @endforelse
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

<!-- Modal para registrar nuevo usuario -->
<div id="modal-crear-usuario" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl p-6 w-full max-w-3xl shadow-xl">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-xl font-semibold text-gray-800">Añadir Usuario</h2>
            <button type="button" onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600 text-xl">&times;</button>
        </div>

        <form action="{{ route('usuarios.admin.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Nombre</label>
                    <input type="text" name="nombre" class="w-full border rounded px-3 py-2 mt-1" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Apellidos Completos</label>
                    <input type="text" name="apellidos" class="w-full border rounded px-3 py-2 mt-1" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" name="email" class="w-full border rounded px-3 py-2 mt-1" required>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Género</label>
                    <select name="genero" class="w-full border rounded px-3 py-2 mt-1" required>
                        <option value="">Selecciona</option>
                        <option value="Masculino">Masculino</option>
                        <option value="Femenino">Femenino</option>
                        <option value="Otro">Otro</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Grado</label>
                    <input type="text" name="grado" class="w-full border rounded px-3 py-2 mt-1">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Estado</label>
                    <select name="estado" class="w-full border rounded px-3 py-2 mt-1" required>
                        <option value="1">Activo</option>
                        <option value="0">Inactivo</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Contraseña</label>
                    <input type="password" name="password" class="w-full border rounded px-3 py-2 mt-1" required>
                </div>
            </div>

            <div class="mt-6 flex justify-end gap-2">
                <button type="button" onclick="cerrarModal()" class="px-4 py-2 text-sm bg-gray-200 text-gray-700 rounded hover:bg-gray-300">Cancelar</button>
                <button type="submit" class="px-4 py-2 text-sm bg-blue-600 text-white rounded hover:bg-blue-700">Guardar</button>
            </div>
        </form>
    </div>
</div>

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#3085d6'
    });
</script>
@endif

@if ($errors->any())
<script>
    Swal.fire({
        icon: 'error',
        title: 'Errores en el formulario',
        html: `<ul style="text-align:left;">{!! implode('', $errors->all('<li>• :message</li>')) !!}</ul>`,
        confirmButtonColor: '#d33'
    });
</script>
@endif

<script>
    function cerrarModal() {
        document.getElementById('modal-crear-usuario').classList.add('hidden');
    }

    // Si tienes un botón con id="btn-abrir-modal", puedes usar esto
    document.getElementById('btn-abrir-modal')?.addEventListener('click', function () {
        document.getElementById('modal-crear-usuario').classList.remove('hidden');
    });
</script>

@endsection

