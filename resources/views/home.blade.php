
@extends('layouts.app')

@section('content')
    <div class="text-center py-8">
        <h1 class="text-3xl font-bold text-gray-800 dark:text-white">Bienvenido al Sistema de Admisión UMA</h1>
        <p class="mt-2 text-gray-600 dark:text-gray-300">Gracias por confiar en nosotros, postulante.</p>

        <div class="mt-6">
            <a href="{{ route('student.registro') }}" 
               class="inline-block px-6 py-3 text-white bg-blue-700 rounded-lg hover:bg-blue-800 transition">
               Completa tu registro
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        // Script exclusivo para esta vista
        console.log("Página de inicio cargada correctamente");

        // Ejemplo: Mostrar SweetAlert si algo se pasa por sesión
        @if(session('bienvenida'))
            Swal.fire('¡Hola postulante!', '{{ session('bienvenida') }}', 'success');
        @endif
    </script>
@endsection
