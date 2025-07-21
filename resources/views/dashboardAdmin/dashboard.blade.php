@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Postulantes - UMA</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet"> --}}
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-md p-4 flex justify-between items-center">
        <h1 class="text-xl font-bold text-blue-700">MODULO DE ADMISION CACHIMBOS</h1>
        <div class="flex items-center gap-4">
            <span class="text-gray-700">Admin - {{ Str::title(session('nombre_completo') ?? 'Postulante') }}</span>
        </div>
    </nav>

    <main class="p-6">
        <!-- KPIs -->
          <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6 mb-8">
              <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                  <div class="text-3xl font-bold text-blue-700">{{ $total_postulantes }}</div>
                  <div class="text-gray-500">Total Postulantes</div>
              </div>
              <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                  <div class="text-3xl font-bold text-yellow-600">{{ $sin_declaracion }}</div>
                  <div class="text-gray-500">Sin Declaración Jurada</div>
              </div>
              <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                  <div class="text-3xl font-bold text-red-500">{{ $documentos_incompletos }}</div>
                  <div class="text-gray-500">Documentos Incompletos</div>
              </div>
              <div class="bg-white rounded-2xl shadow-md p-6 text-center">
                  <div class="text-3xl font-bold text-green-600">{{ $completos }}</div>
                  <div class="text-gray-500">Completos</div>
              </div>
          </div>
          
        <!-- Botones de reportes -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <h2 class="text-lg font-semibold text-gray-700 mb-4">Reportes Rápidos</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('reporte.general') }}" class="bg-blue-600 text-white px-4 py-2 rounded-xl shadow hover:bg-blue-700" target="_blank">📄 Consolidado General</a>
                <a href="{{ route('reporte.sin_declaracion') }}" class="bg-green-600 text-white px-4 py-2 rounded-xl shadow hover:bg-green-700" target="_blank">📋 Sin Declaración</a>
                <a href="{{ route('reporte.faltantes.detalle') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-xl shadow hover:bg-indigo-700" target="_blank">📊 Documentos Faltantes</a>
                <a href="#" class="bg-purple-600 text-white px-4 py-2 rounded-xl shadow hover:bg-purple-700">📈 Evolución Registros</a>
            </div>
        </div>

        <!-- Gráficos -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-md font-semibold text-gray-700 mb-2">Postulantes por Modalidad</h3>
                <canvas id="barChart" class="w-full max-h-64"></canvas>
            </div>
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-md font-semibold text-gray-700 mb-2">% Documentación Completa</h3>
                <canvas id="pieChart" class="w-full max-h-64"></canvas>
            </div>
        </div>

        <!-- Buscador Rápido -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <h3 class="text-md font-semibold text-gray-700 mb-4">Buscador de Postulantes</h3>
            <input type="text" placeholder="Buscar por DNI, Código o Apellidos" class="w-full px-4 py-2 border border-gray-300 rounded-xl shadow-sm focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>
    </main>

    <script>
        // Bar Chart
        new Chart(document.getElementById('barChart'), {
            type: 'bar',
            data: {
                labels: ['Ordinario', 'Primeros Puestos', 'Pre UMA', 'Traslados'],
                datasets: [{
                    label: 'Cantidad',
                    data: [210, 132, 85, 43],
                    backgroundColor: ['#3B82F6', '#10B981', '#6366F1', '#F59E0B']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false },
                }
            }
        });

        // Pie Chart
        new Chart(document.getElementById('pieChart'), {
            type: 'doughnut',
            data: {
                labels: ['Completos', 'Incompletos'],
                datasets: [{
                    data: [316, 196],
                    backgroundColor: ['#10B981', '#EF4444'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    </script>
</body>
</html>

  {{-- <a href="{{ url('/auth/microsoft') }}" class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2">
    Conectar con OneDrive
  </a>     --}}
@endsection
