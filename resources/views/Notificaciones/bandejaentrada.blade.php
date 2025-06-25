@extends('layouts.app')

@section('content')
@php
  $mensajes = [
    (object)[
      'id' => 1,
      'remitente_nombre' => 'María Gómez',
      'asunto' => 'Bienvenido a la plataforma',
      'contenido' => 'Hola, te damos la bienvenida a nuestra plataforma. Esperamos que tengas una excelente experiencia.',
      'created_at' => now()->subHours(2),
      'leido' => false,
    ],
    (object)[
      'id' => 2,
      'remitente_nombre' => 'Juan Torres',
      'asunto' => 'Recordatorio de reunión',
      'contenido' => 'Te recordamos que tienes una reunión programada para mañana a las 9:00 a.m.',
      'created_at' => now()->subDays(1),
      'leido' => true,
    ],
    (object)[
      'id' => 3,
      'remitente_nombre' => 'Soporte UMA',
      'asunto' => 'Actualización del sistema',
      'contenido' => 'El sistema se actualizará este fin de semana. No habrá acceso desde el sábado 10 p.m. hasta el domingo 6 a.m.',
      'created_at' => now()->subDays(3),
      'leido' => false,
    ],
  ];
@endphp

<div x-data="{ mensajeActivo: @json($mensajes[0]) }" class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-8 max-w-7xl mx-auto">
  
  <!-- Lista de mensajes -->
  <div class="md:col-span-1 bg-white dark:bg-gray-800 shadow rounded-md overflow-y-auto max-h-[75vh]">
    <h2 class="p-4 font-bold text-lg text-gray-800 dark:text-white border-b dark:border-gray-700">📨 Mensajes</h2>
    <ul class="divide-y dark:divide-gray-700">
      @foreach($mensajes as $mensaje)
        <li>
          <button @click="mensajeActivo = {{ json_encode($mensaje) }}" class="w-full text-left px-4 py-3 hover:bg-gray-100 dark:hover:bg-gray-700 transition">
            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $mensaje->remitente_nombre }}</p>
            <p class="font-semibold text-gray-800 dark:text-white">{{ $mensaje->asunto }}</p>
            <p class="text-sm text-gray-500 truncate dark:text-gray-300">{{ Str::limit($mensaje->contenido, 50) }}</p>
            <div class="text-xs text-right text-gray-400 dark:text-gray-500">{{ $mensaje->created_at->diffForHumans() }}</div>
          </button>
        </li>
      @endforeach
    </ul>
  </div>

  <!-- Vista previa -->
  <div class="md:col-span-2 bg-white dark:bg-gray-900 shadow rounded-md p-6 overflow-y-auto max-h-[75vh]">
    <template x-if="mensajeActivo">
      <div>
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-2" x-text="mensajeActivo.asunto"></h2>
        <p class="text-sm text-gray-600 dark:text-gray-400 mb-1">De: <span x-text="mensajeActivo.remitente_nombre"></span></p>
        <p class="text-xs text-gray-400 dark:text-gray-500 mb-4" x-text="new Date(mensajeActivo.created_at).toLocaleString()"></p>
        <hr class="my-4 border-gray-300 dark:border-gray-700">
        <div class="text-gray-700 dark:text-gray-300 leading-relaxed" x-text="mensajeActivo.contenido"></div>
      </div>
    </template>
  </div>
</div>
@endsection