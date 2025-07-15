@extends('layouts.app')

@section('content')

{{-- <div class="text-center max-w-3xl mx-auto px-4 mt-12 mb-8">
    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-800 leading-tight">
        Bienvenido 
        <span class="text-[#E72352]">
          {{ Str::title(session('nombre_completo') ?? 'Postulante') }}
        </span>
    </h1>
    <p class="mt-3 text-base md:text-lg text-gray-500">
        Aquí podrá visualizar el estado de su información personal, documentación académica y situación de pago.
    </p>
</div>

<div class="max-w-7xl mx-auto px-4">
  <div class="flex flex-col md:flex-row gap-6 justify-center items-start">
		@foreach ($postulantes as $post)		
			@php
					switch ($post->estado_info) {
							case 1:
									$cardBg = 'bg-green-50 border-green-300';
									$titleBg = 'bg-green-700 ring-offset-green-700';
									$iconBg = 'bg-green-100 text-green-600';
									$badgeText = 'Completado';
									$badgeClass = 'bg-green-100 text-green-700';
									$buttonClass = 'bg-green-600 hover:bg-green-700';
									$message = 'Tu información ha sido registrada correctamente en el sistema.';
									break;
							case 0:
									$cardBg = 'bg-yellow-50 border-yellow-300';
									$titleBg = 'bg-yellow-600 ring-offset-yellow-600';
									$iconBg = 'bg-yellow-100 text-yellow-600';
									$badgeText = 'Falta confirmar';
									$badgeClass = 'bg-yellow-100 text-yellow-800';
									$buttonClass = 'bg-yellow-600 hover:bg-yellow-700';
									$message = 'Falta confirmar tu información personal.';
									break;
							default:
									$cardBg = 'bg-gray-50 border-gray-300';
									$titleBg = 'bg-gray-600 ring-offset-gray-600';
									$iconBg = 'bg-gray-200 text-gray-500';
									$badgeText = 'Sin información';
									$badgeClass = 'bg-gray-100 text-gray-500';
									$buttonClass = 'bg-gray-600 hover:bg-gray-700';
									$message = 'Aún no se ha registrado tu información.';
									break;
					}
			@endphp

			<div class="max-w-md mx-auto mt-5">
				<div class="relative rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300 ease-in-out {{ $cardBg }} border">
					<!-- TÍTULO -->
					<div class="absolute -top-5 left-1/2 transform -translate-x-1/2 z-10">
						<div class="px-6 py-1 rounded-full text-sm font-bold text-white shadow-xl border border-gray-300
												{{ $titleBg }} ring-4 ring-white {{ $titleBg }}
												drop-shadow-md hover:scale-105 transition-all duration-300">
								Información Personal
						</div>
					</div>
					<!-- CONTENIDO -->
					<div class="p-6 pt-10 text-center">
							<!-- ÍCONO -->
							<div class="flex justify-center mb-4">
								<div class="{{ $iconBg }} rounded-full p-4 shadow-inner">
									<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
										viewBox="0 0 24 24" stroke="currentColor">
										<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.779.753 6.879 2.046M15 10a3 3 0 11-6 0 3 3 0 016 0z"/>
									</svg>
								</div>
							</div>
							<!-- DESCRIPCIÓN -->
							<h3 class="text-xl font-bold text-gray-800 mb-2">
									Estado de Información
							</h3>
							<p class="text-gray-500 text-sm mb-4">
									{{ $message }}
							</p>
							<!-- BADGE -->
							<div class="mb-4">
								<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
									<svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
										viewBox="0 0 24 24">
										<path stroke-linecap="round" stroke-linejoin="round"
													d="M5 13l4 4L19 7"/>
									</svg>
									{{ $badgeText }}
								</span>
							</div>
							<!-- BOTÓN -->
							<a href="{{ route('student.registro') }}">
									<button class="mt-2 {{ $buttonClass }} text-white px-6 py-2 rounded-full text-sm font-semibold shadow-sm transition-all duration-200">
											Ver Detalles
									</button>
							</a>
					</div>
				</div>
			</div>
	
			@php
				$cNumdoc = $post->c_numdoc ?? session('dni_postulante');
				$yaConfirmo = isset($post->c_numdoc);
				// Verificamos si hay DJ (eso fuerza a considerar estado_docs como 2 visualmente)
				$estadoDocsVisual = $post->estado_docs;

				if ($post->estado_dj !== null && $estadoDocsVisual != 2) {
						$estadoDocsVisual = 2; // Fuerza a completo visualmente mientras espera revisión
				}

				// Ahora evaluamos el estado de verificación (verificacion_documentos.estado)
				switch ($estadoDocsVisual) {
						case 2:
								if ($post->estado_verificacion === 2) {
										// Documentos revisados y verificados
										$cardBg = 'bg-green-50 border-green-300';
										$titleBg = 'bg-green-700 ring-offset-green-700';
										$iconBg = 'bg-green-100 text-green-600';
										$badgeText = 'Completo';
										$badgeClass = 'bg-green-100 text-green-700';
										$buttonClass = 'bg-green-600 hover:bg-green-700';
										$message = 'Todos los documentos han sido verificados correctamente.';
								} else {
										// Archivos completos pero en revisión
										$cardBg = 'bg-yellow-50 border-yellow-300';
										$titleBg = 'bg-yellow-600 ring-offset-yellow-600';
										$iconBg = 'bg-yellow-100 text-yellow-600';
										$badgeText = 'En revisión';
										$badgeClass = 'bg-yellow-100 text-yellow-800';
										$buttonClass = 'bg-yellow-600 hover:bg-yellow-700';
										$message = 'Hemos recibido tus archivos. Se encuentran en proceso de validación.';
								}
								break;
						case 1:
								$cardBg = 'bg-yellow-50 border-yellow-300';
								$titleBg = 'bg-yellow-600 ring-offset-yellow-600';
								$iconBg = 'bg-yellow-100 text-yellow-600';
								$badgeText = 'Incompleto';
								$badgeClass = 'bg-yellow-100 text-yellow-800';
								$buttonClass = 'bg-yellow-600 hover:bg-yellow-700';
								$message = 'Te falta subir algunos documentos. Puedes completar este proceso generando tu Declaración Jurada.';
								break;
						default:
								$cardBg = 'bg-gray-50 border-gray-300';
								$titleBg = 'bg-gray-600 ring-offset-gray-600';
								$iconBg = 'bg-gray-200 text-gray-500';
								$badgeText = 'Pendiente';
								$badgeClass = 'bg-gray-100 text-gray-500';
								$buttonClass = 'bg-gray-600 hover:bg-gray-700';
								$message = 'Aún no has iniciado el proceso de carga de documentos.';
								break;
				}
			@endphp

			<div class="max-w-md mx-auto mt-5">
					<div class="relative rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300 ease-in-out {{ $cardBg }} border">

							<!-- TÍTULO -->
							<div class="absolute -top-5 left-1/2 transform -translate-x-1/2 z-10">
									<div class="px-6 py-1 rounded-full text-sm font-bold text-white shadow-xl border border-gray-300
															{{ $titleBg }} ring-4 ring-white {{ $titleBg }}
															drop-shadow-md hover:scale-105 transition-all duration-300">
											Documentación
									</div>
							</div>

							<!-- CONTENIDO -->
							<div class="p-6 pt-10 text-center">
									<!-- ÍCONO -->
									<div class="flex justify-center mb-4">
											<div class="{{ $iconBg }} rounded-full p-4 shadow-inner">
													<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
															viewBox="0 0 24 24" stroke="currentColor">
															<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
																		d="M15.172 7l-6.586 6.586a2 2 0 002.828 2.828l6.586-6.586a4 4 0 00-5.656-5.656l-8.486 8.486a6 6 0 108.486 8.486L20 13"/>
													</svg>
											</div>
									</div>

									<!-- DESCRIPCIÓN -->
									<h3 class="text-xl font-bold text-gray-800 mb-2">Estado de Documentación</h3>
									<p class="text-gray-500 text-sm mb-4">
											{{ $message }}
									</p>

									<!-- BADGE -->
									<div class="mb-4">
											<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $badgeClass }}">
													<svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
															viewBox="0 0 24 24">
															<path stroke-linecap="round" stroke-linejoin="round"
																		d="{{ $estadoDocsVisual === 2 && $post->estado_verificacion === 2 ? 'M5 13l4 4L19 7' : 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z' }}" />
													</svg>
													{{ $badgeText }}
											</span>
									</div>

									@if ($yaConfirmo)
									<a href="{{ route('student.subirdocumentos', ['c_numdoc' => $cNumdoc]) }}">
										<button class="mt-2 {{ $buttonClass }} text-white px-6 py-2 rounded-full text-sm font-semibold shadow-sm transition-all duration-200">
											@switch($estadoDocsVisual)
												@case(2)
													{{ $post->estado_verificacion === 2 ? 'Ver documentos' : 'Esperando validación' }}
													@break
												@case(1)
													Subir más documentos
													@break
												@default
													Subir documentos
											@endswitch
										</button>
									</a>
								@else
									<button onclick="alertarConfirmacion()" class="mt-2 {{ $buttonClass }} text-white px-6 py-2 rounded-full text-sm font-semibold shadow-sm transition-all duration-200">
										Subir documentos
									</button>
								@endif
							</div>
					</div>
			</div>

			<div class="max-w-md mx-auto mt-5">
				<div class="relative rounded-2xl shadow-xl hover:shadow-2xl transition-shadow duration-300 ease-in-out bg-gray-50 border border-gray-300">

					<!-- TÍTULO -->
					<div class="absolute -top-5 left-1/2 transform -translate-x-1/2 z-10">
						<div class="px-6 py-1 rounded-full text-sm font-bold text-white shadow-xl border border-gray-300
												bg-gray-600 ring-4 ring-white ring-offset-gray-600
												drop-shadow-md hover:scale-105 transition-all duration-300">
							Pago
						</div>
					</div>

					<!-- CONTENIDO -->
					<div class="p-6 pt-10 text-center">
						
						<!-- ÍCONO -->
						<div class="flex justify-center mb-4">
							<div class="bg-gray-100 text-gray-600 rounded-full p-4 shadow-inner">
								<svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none"
										viewBox="0 0 24 24" stroke="currentColor">
									<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v2m14 0v6a2 2 0 01-2 2H5a2 2 0 01-2-2V9m14 0H3"/>
								</svg>
							</div>
						</div>

						<!-- TEXTO -->
						<h3 class="text-xl font-bold text-gray-800 mb-2">Estado de Pago</h3>
						<p class="text-gray-500 text-sm mb-4">
						Por favor, realice el pago para continuar con el proceso.
						</p>

						<!-- BADGE -->
						<div class="mb-4">
							<span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
								<svg class="h-4 w-4 mr-1" fill="none" stroke="currentColor" stroke-width="2"
										viewBox="0 0 24 24">
									<path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
								</svg>
								Pago observado
							</span>
						</div>

						<!-- BOTÓN -->
						<button class="mt-2 bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-full text-sm font-semibold shadow-sm transition-all duration-200">
							Subir comprobante
						</button>
					</div>
				</div>
			</div>
		@endforeach

  </div>
</div>


<script>
    function alertarConfirmacion() {
        Swal.fire({
            icon: 'warning',
            title: 'Primero debes confirmar su información',
            confirmButtonText: 'Entendido',
            confirmButtonColor: '#3085d6'
        });
    }
</script> --}}

<body class="bg-gray-100 text-gray-800">
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="text-center mb-8">
      	<h2 class="text-3xl font-bold">👋 Bienvenida, <span class="text-blue-600">Valeria Isabel Lopez Flores</span></h2>
      	<p class="text-gray-600">Consulta el estado de tu información personal, documentación y pagos.</p>
    </div>

    <!-- Línea de progreso -->
    <div class="w-full bg-gray-300 rounded-full h-6 mb-8">
    	<div class="bg-green-500 h-6 rounded-full text-white text-sm flex items-center justify-center" style="width: 33%">33% completado</div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
		@php
			$estadoInfo = $postulantes[0]->estado_info ?? null;
			$colorInfo = 'bg-gray-300 text-gray-700';
			$textoInfo = '❔ Pendiente';

			if ($estadoInfo == 1) {
				$colorInfo = 'bg-green-500 text-white';
				$textoInfo = '✔ Completado';
			}
		@endphp

		<div class="bg-white rounded-2xl shadow p-6 border border-gray-300">
		<h5 class="text-lg font-semibold flex items-center gap-2 mb-4">
			<i class="fas fa-user-check {{ $estadoInfo == 1 ? 'text-green-500' : 'text-gray-500' }}"></i> Información Personal
		</h5>
		<span class="block w-full {{ $colorInfo }} py-2 rounded-lg text-center text-sm font-semibold">
			{{ $textoInfo }}
		</span>
		<p class="mt-4 text-sm text-gray-500">📅 Registrado:
			{{-- Aquí puedes mostrar la fecha si la tienes --}}
			{{ optional($postulantes[0])->fecha_registro ?? '---' }}
		</p>
		<p class="text-sm mt-1">
			{{ $estadoInfo == 1 ? '✅ Tu información fue registrada exitosamente.' : '❕ Aún no has completado tu información personal.' }}
		</p>
		<a href="{{ route('student.registro') }}" class="mt-6 inline-block w-full text-center {{ $estadoInfo == 1 ? 'bg-white border border-green-600 text-green-600 hover:bg-green-50' : 'bg-white border border-gray-400 text-gray-600 hover:bg-gray-50' }} py-2 rounded-xl transition">
			<i class="fas fa-search"></i> Ver detalles
		</a>
		</div>


		<!-- Documentación -->
		@php
			$postulante = $postulantes[0] ?? null;

			$estadoDocs = $postulante->estado_docs ?? 0;
			$tieneDJ = $postulante->estado_dj !== null;
			$estadoVerificacion = $postulante->estado_verificacion ?? null;
			$fechaUltima = optional($postulante)->fecha_registro ? \Carbon\Carbon::parse($postulante->fecha_registro)->format('d/m/Y') : '---';

			$yaConfirmo = isset($postulante->c_numdoc);
			$cNumdoc = $postulante->c_numdoc ?? session('dni_postulante');
			$estadoConfirmado = $postulante->estado_info == 1;

			// Valores por defecto
			$bgColor = 'bg-gray-300 text-gray-700';
			$estadoTexto = '❔ Sin información';
			$mensaje = 'Confirma tus datos personales para poder subir tu documentación.';
			$buttonColor = 'bg-gray-500 hover:bg-gray-600 text-white';
			$buttonText = 'Subir documentos';
			$icono = 'fas fa-file-alt text-gray-500';
			$verRequisitos = true;

			// Ajuste por estados
		if (!$estadoConfirmado) {
				$bgColor = 'bg-gray-300 text-gray-700';
				$estadoTexto = '❔ Aún no confirmas tu información';
				$mensaje = 'Confirma tus datos personales para poder subir tu documentación.';
				$buttonColor = 'border border-gray-400 text-gray-500 hover:bg-gray-100';
				$buttonText = 'Subir documentos';
				$icono = 'fas fa-file-alt text-gray-500';
				$verRequisitos = false;
		    } elseif ($estadoVerificacion === 1) {
				// Nuevo estado de documentos observados
				$bgColor = 'bg-red-100 text-red-700';
				$estadoTexto = '❗ Tienes documentos observados';
				$mensaje = '🔍 Revisa y corrige los documentos observados por el área de admisión.';
				$buttonColor = 'border border-red-500 text-red-600 hover:bg-red-100';
				$buttonText = 'Revisar observaciones';
				$icono = 'fas fa-times-circle text-red-500';
				$verRequisitos = true;
			} elseif ($estadoVerificacion === 2) {
				$bgColor = 'bg-green-100 text-green-700';
				$estadoTexto = '✔ Documentación validada';
				$mensaje = '✅ Tus documentos fueron revisados y validados por el área de admisión.';
				$buttonColor = 'border border-green-600 text-green-600 hover:bg-green-50';
				$buttonText = 'Ver documentos validados';
				$icono = 'fas fa-check-circle text-green-600';
				$verRequisitos = true;
			} elseif ($estadoDocs == 2) {
				$bgColor = 'bg-yellow-400 text-black';
				$estadoTexto = '⏳ En revisión';
				$mensaje = '📂 Has subido todos los documentos. Estamos validándolos.';
				$buttonColor = 'border border-yellow-500 text-yellow-600 hover:bg-yellow-50';
				$buttonText = 'Ver documentos';
				$icono = 'fas fa-clock text-yellow-500';
				$verRequisitos = true;
			} elseif ($estadoDocs == 1 && $tieneDJ) {
				$bgColor = 'bg-yellow-400 text-black';
				$estadoTexto = '⏳ En revisión';
				$mensaje = '⌛ Estamos validando tu documentación.';
				$buttonColor = 'border border-yellow-500 text-yellow-600 hover:bg-yellow-50';
				$buttonText = 'Subir nuevo documento';
				$icono = 'fas fa-file-alt text-yellow-500';
				$verRequisitos = true;
			} elseif ($estadoDocs == 1 && !$tieneDJ) {
				$bgColor = 'bg-red-500 text-white';
				$estadoTexto = '❗ Faltan documentos';
				$mensaje = '🔍 Aún no se ha subido tu declaración jurada.';
				$buttonColor = 'border border-red-600 text-red-600 hover:bg-red-50';
				$buttonText = 'Subir declaración';
				$icono = 'fas fa-exclamation-circle text-red-600';
				$verRequisitos = true;
			} else {
				$bgColor = 'bg-gray-300 text-gray-700';
				$estadoTexto = '📥 Sube tus documentos';
				$mensaje = 'Ya puedes comenzar a subir tu documentación.';
				$buttonColor = 'border border-blue-600 text-blue-600 hover:bg-blue-50';
				$buttonText = 'Subir documentos';
				$icono = 'fas fa-upload text-blue-600';
				$verRequisitos = true;
			}
		@endphp

		<!-- Documentación -->
		<div class="bg-white rounded-2xl shadow p-6 border border-gray-300">
			<h5 class="text-lg font-semibold flex items-center gap-2 mb-4">
				<i class="{{ $icono }}"></i> Documentación
			</h5>

			<span class="block w-full {{ $bgColor }} py-2 rounded-lg text-center text-sm font-semibold">
				{{ $estadoTexto }}
			</span>

			<p class="mt-4 text-sm text-gray-500">📂 Último documento recibido: {{ $fechaUltima }}</p>
			<p class="text-sm mt-1">{{ $mensaje }}</p>

			<div class="mt-6 flex flex-col gap-2">
				@if($yaConfirmo && $estadoConfirmado)
					<a href="{{ route('student.subirdocumentos', ['c_numdoc' => $cNumdoc]) }}" 
					class="w-full text-center bg-white {{ $buttonColor }} py-2 rounded-xl transition">
						<i class="{{ $icono }}"></i> {{ $buttonText }}
					</a>
				@else
					<button onclick="alertarConfirmacion()" 
						class="w-full text-center bg-white {{ $buttonColor }} py-2 rounded-xl transition">
						<i class="{{ $icono }}"></i> {{ $buttonText }}
					</button>
				@endif
			</div>
		</div>

		<script>
			function alertarConfirmacion() {
				Swal.fire({
					icon: 'warning',
					title: 'Primero debes confirmar tu información',
					confirmButtonText: 'Entendido',
					confirmButtonColor: '#3085d6'
				});
			}
		</script>


		<!-- Pago -->
		<div class="bg-white rounded-2xl shadow p-6 border border-gray-300">
		<h5 class="text-lg font-semibold flex items-center gap-2 mb-4">
			<i class="fas fa-credit-card text-red-500"></i> Pago
		</h5>
		<span class="block w-full bg-red-500 text-white py-2 rounded-lg text-center text-sm font-semibold">❗ Pago observado</span>
		<p class="mt-4 text-sm">💬 Aún no hemos recibido confirmación de pago.</p>
			<div class="mt-6 flex flex-col gap-2">
				<a href="#" class="w-full text-center bg-red-600 hover:bg-red-700 text-white py-2 rounded-xl transition">
				<i class="fas fa-upload"></i> Subir comprobante
				</a>
				<a href="#" class="w-full text-center bg-white border border-gray-400 text-gray-700 hover:bg-gray-50 py-2 rounded-xl transition">
				<i class="fas fa-question-circle"></i> Ver instrucciones
				</a>
			</div>
		</div>
	</div>

    <!-- Ayuda -->
<div class="mt-10 text-center text-sm text-gray-600">
    ¿Necesitas ayuda? 
    <a href="#" class="text-blue-500 hover:underline">Consulta nuestras preguntas frecuentes</a> 
    o 
    <a href="https://wa.me/+51982888601" target="_blank" class="text-blue-500 hover:underline">chatea con soporte</a>.
</div>

</div>
</body>


@endsection