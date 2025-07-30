@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-center text-gray-800 mb-8">📊 Reportes de Admisión</h1>

    {{-- Tarjeta: Consolidado General --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-700">📥 Consolidado General</h2>
            <p class="text-sm text-gray-500">Todos los postulantes con su documentación registrada.</p>
        </div>
        <a href="{{ route('reporte.general') }}" target="_blank"
           class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
            <i class="fas fa-file-excel mr-2"></i> Exportar Excel
        </a>
    </div>

    {{-- Tarjeta: Detalle de Faltantes --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">📋 Reporte Detallado de Documentos Faltantes</h2>
        <form action="{{ route('reporte.faltantes.detalle') }}" method="GET" target="_blank" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="modalidadDetalle" class="block text-sm font-medium text-gray-700">Modalidad</label>
                <select id="modalidadDetalle" name="modalidad"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                    <option value="ALL">📄 Todas las modalidades</option>
                    <option value="A">A - Ordinario</option>
                    <option value="B">B - Primeros Puestos</option>
                    <option value="C">C - Admisión Pre-UMA</option>
                    <option value="D">D - Traslado externo</option>
                    <option value="L">L - Titulos y Graduados</option>
                    <option value="O">O - Alto Rendimiento</option>
                </select>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                    <i class="fas fa-file-excel mr-2"></i> Exportar Excel
                </button>
            </div>
        </form>
    </div>

    {{-- Tarjeta: Sin Declaración Jurada --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">📄 Postulantes Sin Declaración Jurada</h2>
        <form action="{{ route('reporte.sin_declaracion') }}" method="GET" target="_blank" class="grid grid-cols-1 md:grid-cols-3 gap-4 items-end">
            <div>
                <label for="modalidadDeclaracion" class="block text-sm font-medium text-gray-700">Modalidad</label>
                <select id="modalidadDeclaracion" name="modalidad"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-green-500 focus:border-green-500 text-sm">
                    <option value="">📄 Todas las modalidades</option>
                    <option value="A">A - Ordinario</option>
                    <option value="B">B - Primeros Puestos</option>
                    <option value="C">C - Admisión Pre-UMA</option>
                    <option value="D">D - Traslado externo</option>
                    <option value="L">L - Titulos y Graduados</option>
                    <option value="O">O - Alto Rendimiento</option>
                </select>
            </div>
            <div class="md:col-span-2 flex justify-end">
                <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
                    <i class="fas fa-file-excel mr-2"></i> Exportar Excel
                </button>
            </div>
        </form>
    </div>
        {{-- Tarjeta: Evolución de Registros de Postulantes --}}
    <div class="bg-white shadow-md rounded-2xl p-6 mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-lg font-semibold text-gray-700">📥 Evolución de Postulantes</h2>
            <p class="text-sm text-gray-500">Todos los postulantes con registros en el sistema.</p>
        </div>
        <a href="{{ route('reporte.evolucion') }}" target="_blank"
            class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-medium rounded-lg transition">
            <i class="fas fa-file-excel mr-2"></i> Exportar Excel
        </a>
    </div>
</div>
@endsection
