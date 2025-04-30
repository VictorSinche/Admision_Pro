@vite('resources/css/app.css')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
    <div class="px-3 py-3 lg:px-5 lg:pl-3">
      <div class="flex items-center justify-between">
        <div class="flex items-center justify-start rtl:justify-end">
          <a href="https://uma.edu.pe" class="flex ms-2 md:me-24" target="black">
            <img src="/uma/img/logo-uma.ico" class="h-8 me-3" alt="FlowBite Logo" />
            <span class="self-center text-xl font-semibold sm:text-2xl whitespace-nowrap dark:text-white">UMA</span>
          </a>
        </div>
        <div class="flex items-center">
          <div class="relative ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Abrir el menú de usuario</span>
                <img class="w-8 h-8 rounded-full" src="{{ asset('uma/img/students.png') }}" alt="user photo">
              </button>
            </div>
            <!-- Menú de usuario -->
            <div id="dropdown-user" class="absolute right-0 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow dark:bg-gray-700 dark:divide-gray-600">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">Victor Sinche
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                  victor@gmail.com
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <a href="{{ route('auth.login') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">Cerrar sesión</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
</nav>
  
  <aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
        <ul class="space-y-2 font-medium">
          <li>
            <a href="{{ route('dashboard.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
          </li>
          <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-estudiante" data-collapse-toggle="submenu-estudiante">
              <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
              </svg>
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Estudiante</span>
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>
            <ul id="submenu-estudiante" class="py-2 space-y-2 {{ Request::routeIs('student.*') ? '' : 'hidden' }}">
              <li>
                <a href="{{ route('student.registro') }}" 
                class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                {{ Request::routeIs('student.registro') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Información
                </a>              
              </li>
              <li>
                <a href="{{ route('student.pagosinscripcion') }}" 
                class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                {{ Request::routeIs('student.pagosinscripcion') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Pagos inscripción
                </a>              
              </li>
              <li>
                <a href="{{ route('student.subirdocumentos') }}" 
                class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                {{ Request::routeIs('student.subirdocumentos') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Adjuntar documentos
                </a>              
              </li>
              <li>
                <a href="{{ route('student.verhorario') }}" 
                class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                {{ Request::routeIs('student.verhorario') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                Ver horario
                </a>              
              </li>
            </ul>
          </li>
          <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-admision" data-collapse-toggle="submenu-admision">
              <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" fill="currentColor" viewBox="0 0 18 18" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z"/>
              </svg>
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Admisión</span>
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>
            <ul id="submenu-admision" class="py-2 space-y-2 {{ Request::routeIs('admision.*') ? '' : 'hidden' }}">
              <li>
                <a href="{{ route('admision.listpostulante') }}" 
                class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                {{ Request::routeIs('admision.listapostulante') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                  Lista Postulantes
              </a>              
              </li>
            </ul>
          </li>
          <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-director" data-collapse-toggle="submenu-director">
              
              <i class="fa-solid fa-user-tie fa-lg text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
              
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Director</span>
              
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>
          
            <ul id="submenu-director" class="py-2 space-y-2 {{ Request::routeIs('director.*') ? '' : 'hidden' }}">
              <li>
                <a href="{{ route('director.convalidacion') }}" 
                  class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                  {{ Request::routeIs('director.convalidacion') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                  Convalidación
                </a>              
              </li>
            </ul>
          </li>
          
        </ul>
    </div>
  </aside>

  <div class="p-4 sm:ml-64 bg-gray-200 min-h-screen">
    <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14 bg-white shadow-md">
      @yield('content')
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
        const toggles = document.querySelectorAll('[data-collapse-toggle]');
    
        toggles.forEach(function (toggle) {
            const targetId = toggle.getAttribute('data-collapse-toggle');
            const targetElement = document.getElementById(targetId);
    
            toggle.addEventListener('click', function () {
                if (targetElement.classList.contains('hidden')) {
                    targetElement.classList.remove('hidden');
                } else {
                    targetElement.classList.add('hidden');
                }
            });
        });
    });
    </script>
    <script>
      document.addEventListener('DOMContentLoaded', function () {
          const dropdownToggles = document.querySelectorAll('[data-dropdown-toggle]');
      
          dropdownToggles.forEach(function (toggle) {
              const targetId = toggle.getAttribute('data-dropdown-toggle');
              const targetElement = document.getElementById(targetId);
      
              toggle.addEventListener('click', function (event) {
                  event.stopPropagation(); // evita cerrar instantáneamente
                  targetElement.classList.toggle('hidden');
              });
      
              // Cerrar el dropdown si haces click afuera
              document.addEventListener('click', function (e) {
                  if (!toggle.contains(e.target) && !targetElement.contains(e.target)) {
                      targetElement.classList.add('hidden');
                  }
              });
          });
      });
      </script>
      