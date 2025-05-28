@extends('layouts.app')


@section('content')
<div class="max-w-5xl mx-auto mt-10 bg-white p-8 shadow-lg rounded-lg border border-gray-200">
    <h2 class="text-3xl font-extrabold mb-6 text-gray-800 flex items-center gap-2">
        <i class="fa-solid fa-shield-halved text-[#E72352]"></i> Gestión de Permisos - Postulante
    </h2>

    {{-- Formulario de búsqueda --}}
    <form method="GET" action="{{ route('user.listPermisos') }}" class="mb-8">
        <div class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="buscar" placeholder="Buscar por DNI o correo" class="border border-gray-300 px-4 py-2 rounded w-full shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ request('buscar') }}">
            <button type="submit" class="bg-[#E72352] text-white px-5 py-2 rounded hover:bg-green-600 shadow flex items-center gap-2">
                <i class="fa-solid fa-search"></i> Buscar
            </button>
        </div>
    </form>

@if($usuario)
    <form method="POST" action="{{ route('user.updatePermisos') }}">
        @csrf
        <input type="hidden" name="{{ $usuario->tipo === 'postulante' ? 'postulante_id' : 'user_id' }}" value="{{ $usuario->id }}">

        <h3 class="text-xl font-semibold mb-4 text-gray-700">
            Permisos para: 
            <strong>{{ $usuario->nombres }} {{ $usuario->apellidos }}</strong> 
            ({{ $usuario->tipo === 'postulante' ? 'DNI' : 'Correo' }}: 
            {{ $usuario->tipo === 'postulante' ? $usuario->dni : $usuario->email }})
        </h3>

        @php
            $agrupados = $items->groupBy('modulo');
        @endphp

        @foreach($agrupados as $modulo => $subitems)
            <div class="mb-6 border-l-4 border-[#E72352] pl-5">
                <h4 class="text-[#E72352] font-bold text-lg mb-3 uppercase tracking-wide">{{ $modulo }}</h4>

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    @foreach($subitems as $item)
                        <label class="flex items-center gap-3 bg-gray-50 border border-gray-200 px-4 py-2 rounded shadow-sm hover:bg-gray-100 transition-all">
                            <input type="checkbox" name="items[]" value="{{ $item->id }}"
                                    {{ in_array($item->id, $permisosActuales) ? 'checked' : '' }}>
                            <span class="text-gray-800">{{ $item->item }} <small class="text-gray-500">({{ $item->codigo }})</small></span>
                        </label>
                    @endforeach
                </div>
            </div>
        @endforeach
        <button type="submit" class="mt-6 px-6 py-3 bg-green-600 text-white font-medium rounded hover:bg-green-700 transition shadow flex items-center gap-2">
            <i class="fa-solid fa-floppy-disk"></i> Guardar cambios
        </button>
    </form>
        
    @elseif(request('buscar'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Postulante no encontrado',
                text: '❌ No se encontró un postulante con esos datos.',
                confirmButtonColor: '#e3342f'
            });
        </script>
    @endif
</div>
@endsection

@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: '¡Éxito!',
        text: '{{ session('success') }}',
        confirmButtonColor: '#38a169'
    });
</script>
@endif


