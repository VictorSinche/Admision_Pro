@extends('layouts.app')

@section('content')


@php
    $postulante = $postulantes[0] ?? null;

    $estadoDocs = $postulante->estado_docs ?? 0;
    $tieneDJ = $postulante->estado_dj !== null;
    $estadoVerificacion = $postulante->estado_verificacion ?? null;
    $estadoConfirmado = $postulante->estado_info == 1;
    $modalidad = $postulante->modalidad ?? '';

    $documentosPorModalidad = [
        'A' => ['formulario', 'pago', 'seguro', 'dni', 'constancia'],
        'C' => ['formulario', 'pago', 'seguro', 'dni', 'constancia'],
        'B' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito'],
        'O' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito'],
        'D' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'syllabus'],
        'L' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'syllabus', 'certprofesional'],
    ];

    $documentosRequeridos = $documentosPorModalidad[$modalidad] ?? [];

    $documentosSubidos = (object) collect([
        'formulario', 'pago', 'dni', 'seguro', 'constancia', 'merito',
        'constancianotas', 'constmatricula', 'syllabus', 'certprofesional'
    ])->mapWithKeys(fn($campo) => [$campo => $postulante->$campo ?? null])->toArray();

    $documentosCompletos = 0;
    foreach ($documentosRequeridos as $doc) {
        if (!empty($documentosSubidos->$doc) && $documentosSubidos->$doc == 2) {
            $documentosCompletos++;
        }
    }

    $faltanDocs = count($documentosRequeridos) > $documentosCompletos;

    $documentosObservados = collect($documentosRequeridos)->filter(function ($doc) use ($documentosSubidos) {
        return isset($documentosSubidos->$doc) && (int)$documentosSubidos->$doc === 1;
    })->count();

    // Continúa luego con tu lógica de progreso...
@endphp


<body class="bg-gray-100 text-gray-800">
<div class="max-w-6xl mx-auto py-10 px-4">
    <div class="text-center mb-8">
      	<h2 class="text-3xl font-bold">👋 Bienvenida, 
			<span class="text-blue-600">
	        	{{ Str::title(session('nombre_completo') ?? 'Postulante') }}
			</span>
		</h2>
      	<p class="text-gray-600">Consulta el estado de tu información personal y documentación.</p>
    </div>

	@php
		// $postulante = $postulantes[0] ?? null;

		// $estadoDocs = $postulante->estado_docs ?? 0;
		// $tieneDJ = $postulante->estado_dj !== null;
		// $estadoVerificacion = $postulante->estado_verificacion ?? null;
		// $estadoConfirmado = $postulante->estado_info == 1;
		$progreso = 0;

		if ($estadoConfirmado) {
			$progreso += 50; // Confirmación completa
		}

		// Lógica de documentación
		if ($estadoVerificacion === 2) {
			$progreso += 50; // Validado completamente
		} elseif ($estadoVerificacion === 1 && $tieneDJ && !$faltanDocs && $documentosObservados === 0) {
			$progreso += 45; // DJ + sin faltantes + sin observados
		} elseif ($estadoVerificacion === 1 && $tieneDJ && $faltanDocs && $documentosObservados === 0) {
			$progreso += 30; // DJ + faltan docs pero sin observados
		} elseif ($estadoVerificacion === 1 && $documentosObservados > 0) {
			$progreso += 25; // Observados
		} elseif ($estadoDocs == 2) {
			$progreso += 20; // Subido, en revisión
		} elseif ($estadoDocs == 1 && $tieneDJ) {
			$progreso += 15; // Carga parcial + DJ
		} elseif ($estadoDocs == 1 && !$tieneDJ) {
			$progreso += 10; // Solo algunos subidos
		}

	@endphp
	@php

	@endphp

	@php
		$colorBarra = 'bg-gray-400';

		if ($progreso >= 90) {
			$colorBarra = 'bg-green-500';
		} elseif ($progreso >= 70) {
			$colorBarra = 'bg-blue-500';
		} elseif ($progreso >= 40) {
			$colorBarra = 'bg-yellow-500';
		} elseif ($progreso > 0) {
			$colorBarra = 'bg-red-400';
		}

		switch (true) {
			case $progreso < 20:
				$fraseMotivacional = '🚀 ¡Vamos! Da el primer paso.';
				$colorTextoFrase = 'text-red-500';
				break;
			case $progreso < 40:
				$fraseMotivacional = '💡 Estás avanzando, sigue así.';
				$colorTextoFrase = 'text-orange-500';
				break;
			case $progreso < 60:
				$fraseMotivacional = '🔥 Vas por la mitad. No te detengas.';
				$colorTextoFrase = 'text-yellow-600';
				break;
			case $progreso < 80:
				$fraseMotivacional = '⚡ ¡Ya casi! Un esfuerzo más.';
				$colorTextoFrase = 'text-green-600';
				break;
			case $progreso < 100:
				$fraseMotivacional = '🔍 Revisa tus documentos. Estás a un paso.';
				$colorTextoFrase = 'text-blue-600';
				break;
			case $progreso === 100:
				$fraseMotivacional = '🎉 ¡Todo listo! Tu proceso está completo.';
				$colorTextoFrase = 'text-emerald-600';
				break;
			default:
				$fraseMotivacional = '';
				$colorTextoFrase = 'text-gray-600';
				break;
		}
	@endphp

	<div class="w-full bg-gray-200 rounded-full h-6 mt-4 shadow-inner mb-2 relative overflow-hidden">
		<div class="{{ $colorBarra }} h-6 rounded-full transition-all duration-500 ease-in-out flex items-center justify-center text-white text-xs font-bold"
			style="width: {{ $progreso }}%">
			{{ $progreso }}%
		</div>
	</div>

	<p class="text-xs text-center italic font-medium mb-5 {{ $colorTextoFrase }}">
		{{ $fraseMotivacional }}
	</p>

<div class="grid grid-cols-1 md:grid-cols-2 gap-6">
		@php
			$estadoInfo = $postulantes[0]->estado_info ?? null;
			$colorInfo = 'bg-gray-300 text-gray-700';
			$textoInfo = '❔ Pendiente';

			if ($estadoInfo == 1) {
				$colorInfo = 'bg-green-100 text-green-700';
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
		$yaConfirmo = isset($postulante->c_numdoc);
		$cNumdoc = $postulante->c_numdoc ?? session('dni_postulante');
		$estadoConfirmado = $postulante->estado_info == 1;

		// Por defecto
		$bgColor = 'bg-gray-300 text-gray-700';
		$estadoTexto = '❔ Sin información';
		$mensaje = 'Confirma tus datos personales para poder subir tu documentación.';
		$buttonColor = 'bg-gray-500 hover:bg-gray-600 text-white';
		$buttonText = 'Subir documentos';
		$icono = 'fas fa-file-alt text-gray-500';


		// Lógica de tarjetas
		if (!$estadoConfirmado) {
			$bgColor = 'bg-gray-300 text-gray-700';
			$estadoTexto = '❔ Aún no confirmas tu información';
			$mensaje = 'Confirma tus datos personales para poder subir tu documentación.';
			$buttonColor = 'border border-gray-400 text-gray-500 hover:bg-gray-100';
			$buttonText = 'Subir documentos';
			$icono = 'fas fa-file-alt text-gray-500';

		} elseif ($estadoVerificacion === 2) {
			$bgColor = 'bg-green-100 text-green-700';
			$estadoTexto = '✔ Documentación validada';
			$mensaje = '✅ Tus documentos fueron revisados y validados por el área de admisión.';
			$buttonColor = 'border border-green-600 text-green-600 hover:bg-green-50';
			$buttonText = 'Ver documentos validados';
			$icono = 'fas fa-check-circle text-green-600';

		} elseif ($estadoVerificacion === 1 && $documentosObservados > 0) {
			$bgColor = 'bg-red-100 text-red-700';
			$estadoTexto = '❗ Tienes documentos observados';
			$mensaje = '🔍 Algunos documentos fueron observados. Revisa cuáles en esta plataforma. Los motivos detallados fueron enviados a tu correo.';
			$buttonColor = 'border border-red-500 text-red-600 hover:bg-red-100';
			$buttonText = 'Revisar observaciones';
			$icono = 'fas fa-times-circle text-red-500';
		
		} elseif ($estadoVerificacion === 1 && $tieneDJ && $faltanDocs && $documentosObservados === 0) {
			$bgColor = 'bg-orange-100 text-orange-700';
			$estadoTexto = '📌 Documentación incompleta';
			$mensaje = '🔍 Has declarado tu documentación, pero aún tienes documentos obligatorios sin subir.';
			$buttonColor = 'border border-orange-600 text-orange-600 hover:bg-orange-50';
			$buttonText = 'Completar documentos';
			$icono = 'fas fa-exclamation-circle text-orange-600';

		} elseif ($estadoVerificacion === 1 && $tieneDJ && !$faltanDocs && $documentosObservados === 0) {
			$bgColor = 'bg-green-100 text-green-700';
			$estadoTexto = '✔ Documentación validada con declaración jurada';
			$mensaje = '✅ Tus documentos fueron validados considerando tu declaración jurada.';
			$buttonColor = 'border border-green-600 text-green-600 hover:bg-green-50';
			$buttonText = 'Ver documentos validados';
			$icono = 'fas fa-check-circle text-green-600';

		} elseif ($estadoDocs == 2) {
			$bgColor = 'bg-yellow-400 text-black';
			$estadoTexto = '⏳ En revisión';
			$mensaje = '📂 Has subido todos los documentos. Estamos validándolos.';
			$buttonColor = 'border border-yellow-500 text-yellow-600 hover:bg-yellow-50';
			$buttonText = 'Ver documentos';
			$icono = 'fas fa-clock text-yellow-500';
		
		} elseif ($estadoDocs == 1 && $tieneDJ) {
			$bgColor = 'bg-yellow-400 text-black';
			$estadoTexto = '⏳ En revisión';
			$mensaje = '📄 Su documentación y declaración jurada han sido registradas correctamente. El proceso de verificación está en curso.';
			$buttonColor = 'border border-yellow-500 text-yellow-600 hover:bg-yellow-50';
			$buttonText = 'Ver documentos';
			$icono = 'fas fa-file-alt text-yellow-500';
		
		} elseif ($estadoDocs == 1 && !$tieneDJ) {
			$bgColor = 'bg-red-300 text-red-700';
			$estadoTexto = '❗ Documentos incompletos';
			$mensaje = '🔍 Aún tienes documentos pendientes. Puedes completar tu carga o generar tu declaración jurada si aún no la subiste.';
			$buttonColor = 'border border-red-600 text-red-600 hover:bg-red-50';
			$buttonText = 'Subir documentos';
			$icono = 'fas fa-exclamation-circle text-red-600';
		
		} else {
			$bgColor = 'bg-gray-300 text-gray-700';
			$estadoTexto = '📥 Sube tus documentos';
			$mensaje = 'Ya puedes comenzar a subir tu documentación.';
			$buttonColor = 'border border-blue-600 text-blue-600 hover:bg-blue-50';
			$buttonText = 'Subir documentos';
			$icono = 'fas fa-upload text-blue-600';
		
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
		<p class="text-sm mt-5">{{ $mensaje }}</p>
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
		{{-- <div class="bg-white rounded-2xl shadow p-6 border border-gray-300">
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
		</div> --}}
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