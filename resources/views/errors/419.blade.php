@extends('layouts.app')

@section('title', '419 | Sesión expirada')

@section('content')
<div class="flex flex-col items-center justify-center min-h-screen bg-gradient-to-br from-slate-100 via-sky-100 to-indigo-100 text-center p-6">
    
    {{-- Icono animado --}}
    <div class="animate-bounce mb-6">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-24 w-24 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M12 20c4.418 0 8-3.582 8-8s-3.582-8-8-8-8 3.582-8 8 3.582 8 8 8z" />
        </svg>
    </div>

    {{-- Título llamativo --}}
    <h1 class="text-4xl font-bold text-red-600 drop-shadow-sm mb-2">¡Oops! Sesión expirada</h1>
    <p class="text-gray-700 text-lg mb-4">Por seguridad, tu sesión ha finalizado. Es posible que haya pasado mucho tiempo o se produjo un error.</p>

    {{-- Tips y ayuda --}}
    <div class="bg-white shadow-md rounded-lg p-4 max-w-md w-full mb-6">
        <p class="text-gray-600">🔐 Para continuar, vuelve a iniciar sesión o recarga la página.</p>
        <p class="text-gray-600 mt-1">🛠️ Si el problema persiste, contacta con soporte técnico.</p>
    </div>

    {{-- Botones con transiciones --}}
    <div class="flex gap-4">
        <a href="{{ url()->previous() }}"
           class="px-6 py-3 bg-indigo-600 text-white rounded-lg shadow-lg hover:bg-indigo-700 transition duration-300 transform hover:scale-105">
            🔄 Volver atrás
        </a>
        <a href="{{ url('/') }}"
           class="px-6 py-3 border border-indigo-600 text-indigo-600 rounded-lg hover:bg-indigo-50 transition duration-300 transform hover:scale-105">
            🏠 Ir al inicio
        </a>
    </div>
</div>
@endsection
