@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- Loader Global con Imagen -->
<div id="loader-wrapper" class="hidden fixed inset-0 z-[9999] bg-white/80 flex flex-col justify-center items-center">
    <img src="/uma/img/logo-uma.png" alt="Cargando UMA" class="w-16 h-16 mb-4 animate-pulse" />
    <div class="loader"></div>
    <p class="text-sm text-gray-700 mt-2">Cargando, por favor espera...</p>
</div>

<!-- component -->
<div class="max-w-[100%] mx-auto">
    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-visible text-slate-700 bg-white rounded-none bg-clip-border">
            <div class="flex items-center justify-between ">
                <div>
                    <h3 class="text-lg font-semibold text-slate-800">Validar Documentos</h3>
                    <p class="text-slate-500">Valida segun los documentos validos</p>
                </div>
                <!-- Buscador -->
                <div class="relative w-full max-w-xs mb-4">
                    <input
                        type="text"
                        id="buscador"
                        name="buscador"
                        placeholder=" "
                        class="peer h-full w-full rounded-[7px] border border-blue-gray-200 bg-transparent px-3 py-2.5 !pr-9 text-sm text-blue-gray-700 outline-0 transition-all focus:border-2 focus:border-gray-900 placeholder-shown:border-blue-gray-200"
                        oninput="filtrarTabla()"
                    />
                    <label
                        for="buscador"
                        class="pointer-events-none absolute left-0 -top-1.5 text-[11px] text-gray-500 transition-all peer-placeholder-shown:text-sm peer-placeholder-shown:top-2.5 peer-placeholder-shown:left-3 peer-focus:text-[11px] peer-focus:top-0 peer-focus:left-0 peer-focus:text-gray-900"
                    >
                        Buscar postulante...
                    </label>
                </div>
            </div>
        </div>
        {{-- Pestañas de modalidades --}}
        <div class="flex items-center gap-4 mt-4 px-4">
            <label for="selectorModalidad" class="text-sm font-medium text-slate-700">Selecciona la modalidad:</label>
            <select id="selectorModalidad" onchange="mostrarModalidadSelect(this)" class="w-72 border border-slate-300 text-sm rounded px-3 py-2">
                <option value="C">Pre-UMA</option>
                <option value="B">Primeros Puestos</option>
                <option value="A">Ordinarios</option>
                <option value="O">Alto rendimiento</option>
                <option value="D">Traslado Externo</option>
                <option value="L">Titulados y graduados</option>

                {{-- Agrega más modalidades si deseas --}}
            </select>
        </div>
        {{-- colocar aqui los includes --}}
        <div id="contenedor-tablas">
            <div class="modalidad-tab" data-mod="C">
                @include('admision.validarDocs.pormodalidad.preuma', [
                    'postulantesModalidad' => $preuma
                ])
            </div>

            <div class="modalidad-tab hidden" data-mod="B">
                @include('admision.validarDocs.pormodalidad.primerosPuestos', [
                    'postulantesModalidad' => $primeros
                ])
            </div>

            <div class="modalidad-tab hidden" data-mod="A">
                @include('admision.validarDocs.pormodalidad.ordinarios', [
                    'postulantesModalidad' => $ordinarios
                ])
            </div>

            <div class="modalidad-tab hidden" data-mod="O">
                @include('admision.validarDocs.pormodalidad.alto_rendimiento', [
                    'postulantesModalidad' => $alto_rendimiento
                ])
            </div>

            <div class="modalidad-tab hidden" data-mod="D">
                @include('admision.validarDocs.pormodalidad.translado_externo', [
                    'postulantesModalidad' => $translado_externo
                ])
            </div>

            <div class="modalidad-tab hidden" data-mod="L">
                @include('admision.validarDocs.pormodalidad.admision_tecnicos', [
                    'postulantesModalidad' => $admision_tecnicos
                ])
            </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div id="modalnotificacion" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50 hidden">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6">
        <!-- Cabecera -->
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-gray-900">Especificar documentos no válidos</h3>
            <button onclick="cerrarModal()" class="text-gray-400 hover:text-gray-600">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Campo de texto -->
        <div class="mb-4">
            <label for="motivo" class="block text-sm font-medium text-gray-700 mb-1">Motivo / documentos no válidos:</label>
            <textarea id="motivo" rows="4" class="w-full p-2 border rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"></textarea>
        </div>

        <!-- Botón Notificar -->
        <div class="text-right">
            <button onclick="enviarNotificacion()" class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 transition">
                <i class="fa-solid fa-paper-plane"></i>
                Notificar
            </button>
        </div>
    </div>
</div>

<div id="modal-documentos" class="fixed inset-0 z-50 hidden bg-black/50 backdrop-blur-sm flex items-center justify-center">
    <div class="bg-white w-full max-w-3xl mx-auto p-6 rounded-lg shadow-2xl relative">
        <h2 class="text-2xl font-bold text-gray-800 mb-4">📁 Documentos del postulante</h2>

        <label class="block mb-2 text-sm font-medium text-gray-700">Tipo de documento:</label>
        <select id="select-doc" onchange="mostrarDocumento()" class="w-full mb-4 p-2 border rounded">
            <option value="" disabled selected>Seleccione un documento</option>
        </select>

        <div id="preview-doc" class="h-[400px] bg-gray-50 rounded p-4 flex items-center justify-center text-gray-500 border-gray-700">
            <span>Selecciona un documento para visualizar</span>
        </div>

        <div id="acciones-validacion" class="mt-4 flex justify-end gap-3 hidden">
            <button onclick="validarDocumento(true)" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                <i class="fa-solid fa-check mr-1"></i> Validar
            </button>
            <button onclick="validarDocumento(false)" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                <i class="fa-solid fa-xmark mr-1"></i> No válido
            </button>
        </div>

        <button onclick="cerrarModalDocumentos()" class="absolute top-4 right-4 text-gray-600 hover:text-red-600">
            <i class="fa-solid fa-xmark text-2xl"></i>
        </button>
    </div>
</div>

<script>
    function confirmarReenvio(dni) {
        Swal.fire({
            title: 'Ya se envió una notificación',
            text: '¿Deseas enviar una nueva notificación a este postulante?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, reenviar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                abrirModalNotificacion(dni);
            }
        });
    }
</script>


<script>
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
        button.addEventListener('click', () => {
            const modalId = button.getAttribute('data-modal-target');
            document.getElementById(modalId).classList.remove('hidden');
        });
    });
    function cerrarModal() {
        document.getElementById('modalnotificacion').classList.add('hidden');
    }
</script>

<script>
    let dniActualParaNotificacion = null;

    function abrirModalNotificacion(dni) {
        dniActualParaNotificacion = dni;
        document.getElementById('motivo').value = '';
        document.getElementById('modalnotificacion').classList.remove('hidden');
    }

    function cerrarModal() {
        document.getElementById('modalnotificacion').classList.add('hidden');
    }

    function enviarNotificacion() {
        // Mostrar loader
        document.getElementById('loader-wrapper').classList.remove('hidden');

        const fila = document.querySelector(`tr[data-dni="${dniActualParaNotificacion}"]`);
        if (!fila) {
            Swal.fire("❌ Error: No se encontró la fila del postulante");
            document.getElementById('loader-wrapper').classList.add('hidden');
            return;
        }

        // Obtener todos los campos inválidos
        let documentosInvalidos = Array.from(fila.querySelectorAll('td[data-estado="0"], td[data-estado="1"]'))
            .map(td => td.getAttribute('data-campo'));

        // Si no hay documentos inválidos, agregar un marcador ficticio para cumplir con el backend
        const sinInvalidos = documentosInvalidos.length === 0;
        if (sinInvalidos) {
            documentosInvalidos = ['todos_validados'];
        }

        const motivo = document.getElementById('motivo').value.trim();

        fetch('/notificar-rechazo-documentos', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                dni: dniActualParaNotificacion,
                motivo,
                documentos: documentosInvalidos
            })
        })
        .then(res => res.json())
        .then(res => {
            cerrarModal();

            Swal.fire(
                "📬 Notificación enviada",
                sinInvalidos ? "Todos los documentos están validados, pero se notificó igual." : res.message,
                "success"
            );

            const celdaNotificar = fila.querySelector('[data-accion="notificar"]')?.parentElement;
            if (celdaNotificar) {
                celdaNotificar.innerHTML = `
                    <a href="javascript:void(0);"
                    onclick="confirmarReenvio('${dniActualParaNotificacion}')"
                    class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-yellow-500 rounded hover:bg-yellow-600 transition">
                        <i class="fa-solid fa-envelope-circle-check"></i>
                    </a>
                `;
            }
        })
        .catch(err => {
            console.error(err);
            Swal.fire("❌ Error al enviar notificación");
        })
        .finally(() => {
            document.getElementById('loader-wrapper').classList.add('hidden');
        });
    }

</script>

<script>
    function abrirModalDocumentos(dni) {
        const camposPorModalidad = {
            'A': ['formulario', 'pago', 'seguro', 'dni', 'constancia'],
            'C': ['formulario', 'pago', 'seguro', 'dni', 'constancia'],
            'B': ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito'],
            'O': ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito'],
            'D': ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'syllabus'],
            'L': ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'syllabus', 'certprofesional']
        };

        fetch(`/documentos-json/${dni}`)
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('select-doc');
                select.setAttribute('data-dni', dni);
                select.innerHTML = `<option value="" disabled selected>Seleccione un documento</option>`;

                const modalidad = data.id_mod_ing; // Asegúrate que el backend lo retorne
                const campos = camposPorModalidad[modalidad] || [];

                campos.forEach(campo => {
                    const ruta = data[campo] ?? ''; // si no existe, será vacío
                    const option = document.createElement('option');
                    option.text = campo.toUpperCase();
                    option.setAttribute('data-campo', campo);

                    if (ruta) {
                        option.value = ruta;
                    } else {
                        option.value = '#'; // valor falso
                        option.setAttribute('data-inexistente', '1');
                    }

                    select.appendChild(option);
                });

                document.getElementById('preview-doc').innerHTML = `<span>Selecciona un documento para visualizar</span>`;
                document.getElementById('modal-documentos').classList.remove('hidden');
            })
            .catch(err => {
                console.error(err);
                alert('Error al cargar documentos.');
            });
    }

    function cerrarModalDocumentos() {
        document.getElementById('modal-documentos').classList.add('hidden');
    }

    function mostrarDocumento() {
        const select = document.getElementById('select-doc');
        const ruta = select.value;
        const dni = select.getAttribute('data-dni');
        const campo = select.options[select.selectedIndex].getAttribute('data-campo');
        const esInexistente = select.options[select.selectedIndex].getAttribute('data-inexistente') === '1';

        const container = document.getElementById('preview-doc');
        container.innerHTML = '';

        if (esInexistente || !ruta) {
            container.innerHTML = `<div class="text-center text-red-600 text-sm">⚠️ El postulante no ha subido este documento.</div>`;
            document.getElementById('acciones-validacion').classList.add('hidden');
            return;
        }

        let ext = '';
        if (ruta.includes('/declaracion-jurada/pdf')) {
            ext = 'pdf';
        } else {
            ext = ruta.split('.').pop().toLowerCase();
        }

        const fullRuta = ruta.startsWith('/declaracion-jurada/pdf') ? ruta : `/storage/postulantes/${dni}/${ruta}`;

        if (ext === 'pdf') {
            container.innerHTML = `<iframe src="${fullRuta}" class="w-full h-96 border rounded" frameborder="0"></iframe>`;
        } else if (['jpg', 'jpeg', 'png'].includes(ext)) {
            container.innerHTML = `<img src="${fullRuta}" alt="Documento" class="max-w-full max-h-[400px] mx-auto rounded shadow" />`;
        } else {
            container.innerHTML = `<a href="${fullRuta}" target="_blank" class="text-blue-600 underline">Ver/descargar documento</a>`;
        }

        // Mostrar botones de validación solo si existe el archivo
        document.getElementById('acciones-validacion').classList.remove('hidden');
    }


    // ✅ Ahora la función validarDocumento está fuera y es accesible globalmente
    function validarDocumento(valido) {
        const select = document.getElementById('select-doc');
        const campo = select.options[select.selectedIndex].getAttribute('data-campo');
        const dni = select.getAttribute('data-dni');
        const esInexistente = select.options[select.selectedIndex].getAttribute('data-inexistente') === '1';

        if (esInexistente) {
            Swal.fire({
                icon: 'warning',
                title: 'Este documento no fue subido por el postulante',
                text: 'No se puede validar un documento inexistente.',
                confirmButtonColor: '#d33'
            });
            return;
        }

        const fila = document.querySelector(`tr[data-dni="${dni}"]`);
        if (!fila) return;

        const celda = Array.from(fila.querySelectorAll('td')).find(td => td.dataset.campo === campo);
        if (!celda) return;

        // Actualizar el ícono visual
        const estado = valido ? 2 : 1;
        celda.setAttribute('data-estado', estado);

        let iconHtml = '';
        if (estado === 2) {
            iconHtml = `<span class="inline-flex justify-center items-center w-10 h-10 rounded-full text-green-700 bg-green-100 px-3 py-1">
                        <i class="fa-solid fa-check-circle"></i>
                        </span>`;
        } else {
            iconHtml = `<span class="inline-flex justify-center items-center w-10 h-10 rounded-full text-red-700 bg-red-100 px-3 py-1">
                        <i class="fa-solid fa-xmark-circle"></i>
                        </span>`;
        }

        celda.innerHTML = iconHtml;

        // Enviar al backend
        fetch('/validar-documento', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({
                dni,
                campo,
                estado
            })
        })
        .then(res => res.json())
        .then(() => {
            Swal.fire({
                title: "¡Validación registrada correctamente!",
                icon: "success",
                confirmButtonColor: "#3085d6"
            });
        })
        .catch(err => {
            console.error(err);
            alert('Error al validar el documento.');
        });
    }

</script>

<script>
    function  filtrarTabla() {
        const filtro = document.getElementById("buscador").value.toLowerCase();
        const filas = document.querySelectorAll("tbody tr");

        filas.forEach(fila => {
            const textoFila = fila.textContent.toLowerCase();
            fila.style.display = textoFila.includes(filtro) ? "" : "none";
        });
    }
        function mostrarModalidadSelect(select) {
        const codigo = select.value;

        document.querySelectorAll('.modalidad-tab').forEach(tab => {
            tab.classList.add('hidden');
            if (tab.getAttribute('data-mod') === codigo) {
                tab.classList.remove('hidden');
            }
        });
    }
</script>

@endsection

@php
    function mostrarIconoVerificacion($estado)
    {
        if (!isset($estado)) {
            return '<span class="inline-flex justify-center items-center w-10 h-10 rounded-full text-gray-600 bg-gray-100 px-3 py-1">
                        <i class="fa-solid fa-clock"></i>
                    </span>';
        }
        if ((int)$estado === 2) {
            return '<span class="inline-flex justify-center items-center w-10 h-10 rounded-full text-green-700 bg-green-100 px-3 py-1">
                        <i class="fa-solid fa-check-circle"></i>
                    </span>';
        }
        if ((int)$estado === 1) {
            return '<span class="inline-flex justify-center items-center w-10 h-10 rounded-full text-red-700 bg-red-100 px-3 py-1">
                        <i class="fa-solid fa-xmark-circle"></i>
                    </span>';
        }
        // Por si acaso
        return '<span class="inline-flex justify-center items-center w-10 h-10 rounded-full text-gray-600 bg-gray-100 px-3 py-1">
                    <i class="fa-solid fa-clock"></i>
                </span>';
    }
@endphp