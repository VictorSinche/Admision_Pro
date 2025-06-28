@php
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
@endphp

<link rel="stylesheet" href="{{ asset('build/' . $manifest['resources/css/app.css']['file']) }}">
<meta name="csrf-token" content="{{ csrf_token() }}">
<script type="module" src="{{ asset('build/' . $manifest['resources/js/app.js']['file']) }}"></script>

<link rel="icon" href="{{ asset('uma/img/logo-uma.ico') }}" type="image/x-icon">
<title>UMA | INFORMES</title>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- CDN Tom Select -->
<link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>

@php
  use App\Models\InfoPostulante;

  $numeroDocumento = session('c_numdoc');
  $estadoConfirmado = false;

  if ($numeroDocumento) {
      $postulante = InfoPostulante::where('c_numdoc', $numeroDocumento)->first();
      $estadoConfirmado = $postulante && $postulante->estado === 1;
  }
@endphp

<!-- Loader Global con Imagen -->
<div id="loader-wrapper" class="hidden fixed inset-0 z-[9999] bg-white/80 flex flex-col justify-center items-center">
  <!-- Imagen arriba -->
  <img src="/uma/img/logo-uma.png" alt="Cargando UMA" class="w-16 h-16 mb-4 animate-pulse" />
  
  <!-- Loader animado -->
  <div class="loader"></div>
  
  <!-- Texto -->
  <p class="text-sm text-gray-700 mt-2">Cargando, por favor espera...</p>
</div>

<style>
  .loader {
    width: 120px;
    height: 22px;
    border-radius: 20px;
    color: #e72352;
    border: 2px solid;
    position: relative;
  }
  .loader::before {
    content: "";
    position: absolute;
    margin: 2px;
    inset: 0 100% 0 0;
    border-radius: inherit;
    background: currentColor;
    animation: l6 2s infinite;
  }
  @keyframes l6 {
    100% { inset: 0 }
  }
</style>

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
          <!-- Botón de notificaciones -->
          @php
            $c_numdoc = session('c_numdoc');
            $notificaciones = [];
            if ($c_numdoc) {
                $postulante = InfoPostulante::with('verificacion')->where('c_numdoc', $c_numdoc)->first();
                if ($postulante && $postulante->verificacion && $postulante->verificacion->notificado) {
                    $notificaciones[] = (object) [
                        'mensaje' => '📬 Se encontraron observaciones en tus documentos. Revisa y vuelve a subirlos.',
                    ];
                }
            }
            $cantidadNotificaciones = count($notificaciones);
          @endphp
          <div class="flex items-center me-3">
            <div class="relative">
              <button type="button"
                      class="relative inline-flex items-center p-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300"
                      data-dropdown-toggle="dropdown-notificaciones">
                <i class="fa-solid fa-bell"></i>
                <span class="sr-only">Notificaciones</span>

                @if($cantidadNotificaciones > 0)
                  <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2">
                    {{ $cantidadNotificaciones }}
                  </div>
                @endif
              </button>
              <!-- Dropdown -->
              <div id="dropdown-notificaciones" class="absolute right-0 z-50 hidden mt-2 w-72 text-sm text-gray-700 bg-white border border-gray-200 rounded-md shadow-lg dark:bg-gray-800 dark:text-gray-200 dark:border-gray-700">
                <div class="p-4 font-semibold border-b border-gray-200 dark:border-gray-600">
                  Notificaciones
                </div>
                <ul class="max-h-64 overflow-y-auto">
                  @forelse($notificaciones as $notificacion)
                    <li class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-700">
                      {{ $notificacion->mensaje }}
                    </li>
                  @empty
                    <li class="px-4 py-2 text-gray-500 dark:text-gray-400">
                      No tienes nuevas notificaciones.
                    </li>
                  @endforelse
                </ul>
              </div>
            </div>
          </div>

          <!-- Menú de usuario -->
          <div class="relative ms-3">
            <div>
              <button type="button" class="flex text-sm bg-gray-800 rounded-full focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600" aria-expanded="false" data-dropdown-toggle="dropdown-user">
                <span class="sr-only">Abrir el menú de usuario</span>
                <img class="w-8 h-8 rounded-full" src="{{ asset('uma/img/students.png') }}" alt="user photo">
              </button>
            </div>
            <div id="dropdown-user" class="absolute right-0 z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded-sm shadow dark:bg-gray-700 dark:divide-gray-600">
              <div class="px-4 py-3" role="none">
                <p class="text-sm text-gray-900 dark:text-white" role="none">
                  {{ Str::title(session('nombre_completo') ?? 'Postulante') }}
                </p>
                <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                  {{ session('correo') ?? 'correo@ejemplo.com' }}
                </p>
              </div>
              <ul class="py-1" role="none">
                <li>
                  <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white" role="menuitem">
                      <i class="fa-solid fa-right-from-bracket mr-2"></i> Cerrar sesión
                    </button>
                  </form>
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
          @if(tieneAlgunPermisoGlobal(['DASH.1']))
          <li>
            <a href="{{ route('dashboard.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
          </li>
        @endif
        @if (tieneAlgunPermisoGlobal(['DASH.2']))
          <li>
            <a href="{{ route('dashboardPost.dashboard') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
                </svg>
                <span class="ms-3">Dashboard</span>
            </a>
          </li>
        @endif
          @if(tieneAlgunPermisoGlobal(['PER.1', 'PER.2']))
          <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-user" data-collapse-toggle="submenu-user">
              
              <i class="fa-solid fa-users-gear text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
              
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Gestion de usuarios</span>
              
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>

            <ul id="submenu-user" class="py-2 space-y-2 {{ Request::routeIs('user.*') ? '' : 'hidden' }}">
              @if(tienePermisoGlobal('PER.1'))
                <li>
                  <a href="{{ route('usuarios') }}" 
                    class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                    {{ Request::routeIs('usuarios') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Lista de usuarios
                  </a>              
                </li>              
              @endif

              @if(tienePermisoGlobal('PER.2'))
                <li>
                <a href="{{ route('user.listPermisos') }}" 
                  class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                  {{ Request::routeIs('user.listPermisos') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                  Lista de permisos
                </a>              
              </li>
              @endif
            </ul>            
          </li>
          @endif

          @if(tieneAlgunPermisoGlobal(['POS.1', 'POS.2', 'POS.3']))
            <li>
              <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-estudiante" data-collapse-toggle="submenu-estudiante">
                <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
                  <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z"/>
                </svg>
                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Postulante</span>
                <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
                </svg>
              </button>

              <ul id="submenu-estudiante" class="py-2 space-y-2 {{ Request::routeIs('student.*') ? '' : 'hidden' }}">
                
                @if(tienePermisoGlobal('POS.1'))
                  <li>
                    <a href="{{ route('student.registro') }}" 
                    class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                    {{ Request::routeIs('student.registro') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Información
                    </a>              
                  </li>
                @endif

                @if(tienePermisoGlobal('POS.2'))
                  <li>
                    <a href="{{ route('student.pagosinscripcion') }}" 
                    class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                    {{ Request::routeIs('student.pagosinscripcion') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Pagos inscripción
                    </a>              
                  </li>
                @endif

                @if(tienePermisoGlobal('POS.3'))
                  @if($estadoConfirmado)
                    <li>
                      <a href="{{ route('student.subirdocumentos', ['c_numdoc' => $numeroDocumento]) }}"
                        class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group
                        {{ Request::routeIs('student.subirdocumentos') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                        Adjuntar documentos
                      </a>
                    </li>
                  @else
                    <li>
                      <a href="#"
                        onclick="Swal.fire('Primero debe confirmar su información', '', 'warning')"
                        class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group text-gray-400 cursor-not-allowed">
                        Adjuntar documentos
                      </a>
                    </li>
                  @endif
                @endif
                @if(tienePermisoGlobal('POS.4'))
                  <li>
                    <a href="{{ route('student.verhorario') }}" 
                    class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                    {{ Request::routeIs('student.verhorario') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Ver horario
                    </a>              
                  </li>
                @endif
              </ul>
            </li>
          @endif

          @if (tieneAlgunPermisoGlobal(['ADM.1', 'ADM.2', 'ADM.3', 'ADM.4']))
            <li>
              <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-admision" data-collapse-toggle="submenu-admision">
                <!-- ícono -->
                <i class="fa-solid fa-file-signature text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>

                <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Admisión</span>
                <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
                </svg>
              </button>

              <ul id="submenu-admision" class="py-2 space-y-2 {{ Request::routeIs('admision.*') ? '' : 'hidden' }}">
                @if(tienePermisoGlobal('ADM.1'))
                  <li>
                    <a href="{{ route('admision.listpostulante') }}" 
                      class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                      {{ Request::routeIs('admision.listpostulante') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                      Lista Postulantes
                    </a>              
                  </li>
                @endif
                @if(tienePermisoGlobal('ADM.2'))
                  <li>
                    <a href="{{ route('admision.responsable') }}" 
                      class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                      {{ Request::routeIs('admision.responsable') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                      Validar Docs. Postulantes R.
                    </a>              
                  </li>
                @endif
                @if(tienePermisoGlobal('ADM.3'))                  
                  <li>
                    <a href="{{ route('admision.verificar') }}" 
                      class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                      {{ Request::routeIs('admision.verificar') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                      Validar Docs. Postulantes
                    </a>              
                  </li>
                @endif
                @if(tienePermisoGlobal('ADM.4'))
                  <li>
                    <a href="{{ route('admision.historialDj') }}" 
                      class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                      {{ Request::routeIs('admision.historialDj') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                      Historial Declaración Jurada
                    </a>            
                  </li>
                @endif
              </ul>
            </li>
          @endif

          @if (tieneAlgunPermisoGlobal(['DIR.1']))
            <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-director" data-collapse-toggle="submenu-director">
              
              <i class="fa-solid fa-user-tie fa-lg text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
              
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Director</span>
              
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>
          
            <ul id="submenu-director" class="py-2 space-y-2 {{ Request::routeIs('director.*') ? '' : 'hidden' }}">
              @if (tienePermisoGlobal('DIR.1'))
                <li>
                  <a href="{{ route('director.convalidacion') }}" 
                    class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                    {{ Request::routeIs('director.convalidacion') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Convalidación
                  </a>              
                </li>
              @endif
            </ul>
          </li>
          @endif

          @if (tieneAlgunPermisoGlobal(['COA.1']))
            <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-coa" data-collapse-toggle="submenu-coa">
              
              <i class="fa-solid fa-folder-tree text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
              
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Coa</span>
              
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>
          
            <ul id="submenu-coa" class="py-2 space-y-2 {{ Request::routeIs('coa.*') ? '' : 'hidden' }}">
              @if (tienePermisoGlobal('COA.1'))
                <li>
                  <a href="{{ route('coa.listado') }}" 
                    class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                    {{ Request::routeIs('coa.listado') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                    Listado
                  </a>              
                </li>
              @endif
            </ul>
          </li>
          @endif

          @if (tieneAlgunPermisoGlobal(['OSA.1']))
            <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-osar" data-collapse-toggle="submenu-osar">
              
              <i class="fa-solid fa-file-lines text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
              
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Osar</span>
              
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>
          
            <ul id="submenu-osar" class="py-2 space-y-2 {{ Request::routeIs('osar.*') ? '' : 'hidden' }}">
            @if (tienePermisoGlobal('OSA.1'))
              <li>
                <a href="{{ route('osar.listado') }}" 
                  class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                  {{ Request::routeIs('osar.listado') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                  Listado
                </a>
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if (tieneAlgunPermisoGlobal(['TES.1']))
            <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-tesoreria" data-collapse-toggle="submenu-tesoreria">
              <i class="fa-solid fa-wallet text-gray-500 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"></i>
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Tesoreria</span>
              <svg class="w-3 h-3 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1 5 5 1 1"/>
              </svg>
            </button>
          
            <ul id="submenu-tesoreria" class="py-2 space-y-2 {{ Request::routeIs('tesoreria.*') ? '' : 'hidden' }}">
              @if (tienePermisoGlobal('TES.1'))
                <li>
                <a href="{{ route('tesoreria.listado') }}" 
                  class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                  {{ Request::routeIs('tesoreria.listado') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                  Listado
                </a>              
              </li>
              @endif
            </ul>
          </li>
          @endif

          @if (tieneAlgunPermisoGlobal(['NT.1']))
            <li>
            <button type="button" class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700" aria-controls="submenu-notificaciones" data-collapse-toggle="submenu-notificaciones">
              <svg class="shrink-0 w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                  <path d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z"/>
              </svg>
              <span class="flex-1 ms-3 text-left rtl:text-right whitespace-nowrap">Inbox</span>
                <span class="inline-flex items-center justify-center w-3 h-3 p-3 ms-3 text-sm font-medium text-blue-800 bg-blue-100 rounded-full dark:bg-blue-900 dark:text-blue-300">3</span>
            </button>
          
            <ul id="submenu-notificaciones" class="py-2 space-y-2 {{ Request::routeIs('notificaciones.*') ? '' : 'hidden' }}">
              @if (tienePermisoGlobal('NT.1'))
                <li>
                <a href="{{ route('notificaciones.list') }}" 
                  class="rounded-2xl flex items-center w-full p-2 pl-11 transition duration-75 group 
                  {{ Request::routeIs('notificaciones.list') ? 'bg-gray-100 text-blue-700 dark:bg-gray-700 dark:text-white' : 'text-gray-900 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700' }}">
                  Bandeja de entrada
                </a>              
              </li>
              @endif
            </ul>
          </li>
          @endif
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
        
  <script>
    function mostrarLoader() {
      document.getElementById('loader-wrapper')?.classList.remove('hidden');
    }
    function ocultarLoader() {
      document.getElementById('loader-wrapper')?.classList.add('hidden');
    }
  </script>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const enlaces = document.querySelectorAll('a[href]:not([href^="#"]):not([target])');

      enlaces.forEach(link => {
        link.addEventListener('click', function (e) {
          const href = this.getAttribute('href');
          if (href && !href.startsWith('javascript:') && !this.classList.contains('no-loader')) {
            mostrarLoader();
          }
        });
      });
    });
  </script>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const btnNotificaciones = document.querySelector('[data-dropdown-toggle="dropdown-notificaciones"]');
    
    if (btnNotificaciones) {
      btnNotificaciones.addEventListener('click', () => {
        fetch("{{ route('notificaciones.reset') }}", {
          method: "POST",
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
          }
        })
        .then(res => res.json())
        .then(data => {
          console.log("🔄 Notificación reseteada:", data.message);
          // Opcional: ocultar el contador
          const contador = btnNotificaciones.querySelector('div.absolute');
          if (contador) contador.remove();
        });
      });
    }
  });
</script>

