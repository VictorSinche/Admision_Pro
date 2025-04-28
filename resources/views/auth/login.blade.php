<!-- component -->
<link
  href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css"
  rel="stylesheet"
/>
<div
  class="absolute top-0 left-0 bottom-0 leading-5 h-full w-full overflow-hidden bg-gradient-to-b"
  style="background-image: linear-gradient(to bottom, #ffffff, #d81e65, #ff0a68);"
></div>

<div>
  <img
    src="uma/img/logo.png"
    alt="Imagen decorativa"
    class="absolute top-10 left-10 w-40 z-10"
    />
</div>

<div
  class="relative min-h-screen sm:flex sm:flex-row justify-center bg-transparent rounded-3xl shadow-xl"
>
  <div class="flex-col flex self-center lg:px-14 sm:max-w-4xl xl:max-w-4xl z-10">
    <div class="self-start hidden lg:flex flex-col text-gray-300">
      <h1 class="my-3 font-semibold text-4xl text-white">
        GESTIÓN DE ADMISIÓN ACADÉMICOS
      </h1>
      <!-- <h2 class="my-3 font-semibold text-4xl text-white">
        Postulación y administración
      </h2>
      <p class="pr-3 text-sm opacity-75">
        Consulte los documentos electrónicos disponibles
      </p> -->
    </div>
  </div>
  <div class="flex justify-center self-center z-10">
    <div class="p-12 bg-white mx-auto rounded-3xl w-96">
      <div class="mb-7">
        <h3 class="font-semibold text-2xl text-gray-800">Iniciar sesión</h3>
        <!-- <p class="text-gray-400">
          ¿No tiene cuenta?
          <a href="#" class="text-sm text-purple-700 hover:text-purple-700"
            >Inscribirse</a
          >
        </p> -->
      </div>
      <div class="space-y-6">
        <form>
          <div class="">
            <input
              formControlName="email"
              class="text-sm text-black-200 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400"
              type=""
              placeholder="Email"
            />
            {{-- <div>
              <span
                class="text-red-500 text-sm margin"
              >
                El email es obligatorio.
              </span>
              <span
                class="text-red-500 text-sm"
              >
                Ingresa un email válido.
              </span>
            </div> --}}
          </div>

          <div class="relative mt-5">
            <!-- Campo de contraseña -->
            <input
              class="text-sm text-black-200 px-4 py-3 rounded-lg w-full bg-gray-200 focus:bg-gray-100 border border-gray-200 focus:outline-none focus:border-purple-400"
              placeholder="Contreña"
              />
          
            <!-- Validación de errores -->
            {{-- <div>
              <span class="text-red-500 text-sm">
                La contraseña es obligatoria.
              </span>
            </div> --}}
          
            <!-- Botón para alternar visibilidad de contraseña -->
            {{-- <div class="flex items-center absolute inset-y-0 right-3 cursor-pointer">
              <svg
                class="h-5 w-5 text-purple-700"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 576 512"
              >
                <path
                  fill="currentColor"
                  d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z"
                />
              </svg>
          
              <svg
                class="h-5 w-5 text-purple-700"
                fill="none"
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 640 512"
              >
                <path
                  fill="currentColor"
                  d="M320 400c-75.85 0-137.25-58.71-142.9-133.11L72.2 185.82c-13.79 17.3-26.48 35.59-36.72 55.59a32.35 32.35 0 0 0 0 29.19C89.71 376.41 197.07 448 320 448c26.91 0 52.87-4 77.89-10.46L346 397.39a144.13 144.13 0 0 1-26 2.61zm313.82 58.1l-110.55-85.44a331.25 331.25 0 0 0 81.25-102.07 32.35 32.35 0 0 0 0-29.19C550.29 135.59 442.93 64 320 64a308.15 308.15 0 0 0-147.32 37.7L45.46 3.37A16 16 0 0 0 23 6.18L3.37 31.45A16 16 0 0 0 6.18 53.9l588.36 454.73a16 16 0 0 0 22.46-2.81l19.64-25.27a16 16 0 0 0-2.82-22.45zm-183.72-142l-39.3-30.38A94.75 94.75 0 0 0 416 256a94.76 94.76 0 0 0-121.31-92.21A47.65 47.65 0 0 1 304 192a46.64 46.64 0 0 1-1.54 10l-73.61-56.89A142.31 142.31 0 0 1 320 112a143.92 143.92 0 0 1 144 144c0 21.63-5.29 41.79-13.9 60.11z"
                />
              </svg>
            </div>
          </div>           --}}

          <!-- <div class="flex items-center justify-between">
            <div class="text-sm ml-auto">
              <a href="#" class="text-purple-700 hover:text-purple-600">
                ¿Ha olvidado su contraseña?
              </a>
            </div>
          </div> -->
        </form>

        <div>
          <button
            type="button"
            onclick="window.location.href='{{ route('student.registro') }}';"
            class="w-full flex justify-center text-white p-3 rounded-lg tracking-wide font-semibold cursor-pointer transition ease-in duration-500 mt-5"
            style="background-color: #ff0a68; box-shadow: 0 4px 14px rgba(255, 10, 104, 0.4);"
          >
            Sign in
          </button>
        </div>
        
      <div class="mt-5 text-center text-black text-[15px] font-semibold">
        <span>
          © {{ date('Y') }} Developed by -
          <a href="https://github.com/VictorSinche?tab=repositories" rel="" target="_blank" title="" class="text-purple-500 hover:text-purple-600 ">Team TI.</a>
          </span>
      </div>
    </div>
  </div>
</div>
<footer class="bg-transparent absolute w-full bottom-0 left-0 z-30">
  <div class="container p-5 mx-auto flex items-center justify-between">
    <div class="flex mr-auto">
      <!-- <a href="https://codepen.io/uidesignhub" target="_blank" title="codepen aji" class="text-center text-gray-700 focus:outline-none"><img src="/storage/avatars/njkIbPhyZCftc4g9XbMWwVsa7aGVPajYLRXhEeoo.jpg" alt="aji" class="object-cover mx-auto w-8 h-8 rounded-full w-10 h-10"><p class="text-xl">aji<strong>mon</strong></p> </a> -->
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.js"></script>
