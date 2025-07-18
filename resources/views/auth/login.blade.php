<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="icon" href="{{ asset('uma/img/logo-uma.ico') }}" type="image/x-icon">
  <title>Login Admin - UMA</title>
</head>
<body>
<!-- fondo con imagen -->
<div class="relative flex h-screen w-full items-center justify-center bg-gray-900 bg-cover bg-no-repeat" style="background-image:url('uma/img/of_uma.jpeg')">

  <!-- capa superpuesta con blur y tinte rojo -->
  <div class="absolute inset-0 bg-red-900/30 backdrop-blur-sm"></div>

  <!-- contenido principal (formulario) -->
  <div class="relative z-10 rounded-xl bg-black bg-opacity-50 px-16 py-10 shadow-lg backdrop-blur-md max-sm:px-8">
    <div class="text-white">
      <div class="mb-8 flex flex-col items-center">
        {{-- <img src="uma/img/logo.png" width="150" alt="" /> --}}
        <h1 class="mb-2 text-2xl font-bold">ADMISION CACHIMBOS</h1>
        <span class="text-gray-300 font">Introducir datos de acceso</span>
      </div>
      <form method="POST" action="{{ route('login.postulante.submit') }}">
        @csrf
        @if(session('error'))
          <div class="text-red-200 bg-red-400 px-4 py-2 mb-4 rounded-lg">
            {{ session('error') }}
          </div>
        @endif
        <div class="mb-4 text-lg">
          <input 
            class="rounded-3xl border-none bg-white px-6 py-2 text-center placeholder-black shadow-lg outline-none backdrop-blur-md text-black"
            type="text"
            name="dni"
            placeholder="Nro° Documento"
            required
            autocomplete="username" />
        </div>
        <div class="mb-4 text-lg">
          <input 
            class="rounded-3xl border-none bg-white px-6 py-2 text-center placeholder-black shadow-lg outline-none backdrop-blur-md text-black"
            type="password"
            name="password"
            placeholder="Contraseña"
            required
            autocomplete="current-password" />
        </div>
        <div class="mt-8 flex justify-center text-lg text-black">
          <button type="submit" class="rounded-3xl bg-[#f7003a] bg-opacity-50 px-10 py-2 text-white shadow-xl backdrop-blur-md transition-colors duration-300 hover:bg-red-600">
            Login
          </button>
        </div>
        <div class="mt-4 text-center">
          <p class="text-gray-300">
            ¿No tienes una cuenta?
            <a href="{{ route('register.registro') }}" class="text-blue-400 hover:text-blue-600 underline transition duration-200 ease-in-out">
              Regístrate aquí
            </a>
          </p>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="/js/tailwindcss.js"></script>
<script src="/js/alpine.js"></script>

  
  
</body>
</html>