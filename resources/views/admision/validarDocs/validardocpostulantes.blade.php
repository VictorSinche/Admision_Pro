@extends('layouts.app')

@section('content')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<!-- component -->
<div class="max-w-[100%] mx-auto">
    <div class="relative flex flex-col w-full h-full text-slate-700 bg-white shadow-md rounded-xl bg-clip-border">
        <div class="relative mx-4 mt-4 overflow-hidden text-slate-700 bg-white rounded-none bg-clip-border">
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
        <div class="p-0 overflow-scroll">
            <table class="w-full mt-4 text-left table-auto min-w-max">
                <thead>
                    <tr>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Nro
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        DNI
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm font-normal leading-none text-slate-500">
                        Nombre Completo
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Carrera
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2"
                            stroke="currentColor" aria-hidden="true" class="w-4 h-4">
                            <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8.25 15L12 18.75 15.75 15m-7.5-6L12 5.25 15.75 9"></path>
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Ver docs.
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Formulario
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Pago
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        DNI
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        DJ
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Foto
                        </svg>
                        </p>
                    </th>
                    <th
                        class="p-4 transition-colors cursor-pointer border-y border-slate-200 bg-slate-50 hover:bg-slate-100">
                        <p
                        class="flex items-center justify-between gap-2 font-sans text-sm  font-normal leading-none text-slate-500">
                        Acciones
                        </p>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($postulantes as $i => $postulante)
                    <form method="POST" action="{{ route('verificacion.guardar') }}" id="form-{{ $postulante->id }}">
                        @csrf
                        <input type="hidden" name="info_postulante_id" value="{{ $postulante->id }}">

                        <tr data-dni="{{ $postulante->c_numdoc }}">
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $i + 1 }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $postulante->c_numdoc }}</td>
                                    </p>
                                </div>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ Str::title($postulante->c_nombres . ' ' . $postulante->c_apepat . ' ' . $postulante->c_apemat) }}</td>
                                    </p>
                                </div>
                            <td class="p-4 border-b border-slate-200">
                                <div class="flex flex-col">
                                    <p class="text-sm font-semibold text-slate-700">
                                        {{ $postulante->nomesp }}
                                    </p>
                                </div>
                            </td>
                            <td class="p-4 border-b border-slate-200 text-center">
                                <a href="javascript:void(0);" onclick="abrirModalDocumentos('{{ $postulante->c_numdoc }}')" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-indigo-600 rounded hover:bg-indigo-700 transition">
                                    <i class="fa-solid fa-eye"></i>
                                </a>
                            </td>

                            @php $verif = $postulante->verificacion; @endphp

                            <td class="p-4 border-b border-slate-200 text-center"><input type="checkbox" name="formulario" value="1" {{ $verif && $verif->formulario ? 'checked' : '' }}></td>
                            <td class="p-4 border-b border-slate-200 text-center"><input type="checkbox" name="pago" value="1" {{ $verif && $verif->pago ? 'checked' : '' }}></td>
                            <td class="p-4 border-b border-slate-200 text-center"><input type="checkbox" name="dni" value="1" {{ $verif && $verif->dni ? 'checked' : '' }}></td>
                            <td class="p-4 border-b border-slate-200 text-center"><input type="checkbox" name="dj" value="1" {{ $verif && $verif->dj ? 'checked' : '' }}></td>
                            <td class="p-4 border-b border-slate-200 text-center"><input type="checkbox" name="foto" value="1" {{ $verif && $verif->foto ? 'checked' : '' }}></td>

                            <td class="p-4 border-b border-slate-200 text-center">
                                <div class="flex gap-2 justify-center">
                                    <button type="button" onclick="confirmarValidacion('form-{{ $postulante->id }}')" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700 transition">
                                        <i class="fa-solid fa-circle-check"></i>
                                    </button>

                                    <a href="javascript:void(0);"
                                        data-modal-target="modalNoValido"
                                        data-modal-toggle="modalNoValido"
                                        class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-white bg-red-600 rounded hover:bg-red-700 transition">
                                        <i class="fa-solid fa-circle-xmark"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="flex items-center justify-between p-3">
            <p class="block text-sm text-slate-500">
                Página {{ $postulantes->currentPage() }} de {{ $postulantes->lastPage() }}
            </p>

            <div class="flex gap-1">
                {{-- Botón Anterior --}}
                @if ($postulantes->onFirstPage())
                    <span class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-400 cursor-not-allowed">
                        Anterior
                    </span>
                @else
                    <a href="{{ $postulantes->previousPageUrl() }}" class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 hover:opacity-75">
                        Anterior
                    </a>
                @endif

                {{-- Botón Siguiente --}}
                @if ($postulantes->hasMorePages())
                    <a href="{{ $postulantes->nextPageUrl() }}" class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-600 hover:opacity-75">
                        Siguiente
                    </a>
                @else
                    <span class="rounded border border-slate-300 py-2.5 px-3 text-xs font-semibold text-slate-400 cursor-not-allowed">
                        Siguiente
                    </span>
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div id="modalNoValido" class="fixed inset-0 bg-black/50 bg-opacity-50 flex items-center justify-center z-50 hidden">
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
    function confirmarValidacion(formId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Se marcarán como válidos los documentos seleccionados.",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#16a34a',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Sí, validar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById(formId);
                if (form) {
                    form.submit();
                } else {
                    console.error("Formulario no encontrado con ID: " + formId);
                }
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
        document.getElementById('modalNoValido').classList.add('hidden');
    }
    function enviarNotificacion() {
        const motivo = document.getElementById('motivo').value;
        if (motivo.trim() === '') {
            alert('Por favor, especifica qué documentos no son válidos.');
            return;
        }
        console.log("Notificando: " + motivo);
        cerrarModal();
        alert('Notificación enviada correctamente.');
    }
</script>

<script>
    function abrirModalDocumentos(dni) {
        fetch(`/documentos-json/${dni}`)
            .then(res => res.json())
            .then(data => {
                const select = document.getElementById('select-doc');
                select.setAttribute('data-dni', dni);
                select.innerHTML = `<option value="" disabled selected>Seleccione un documento</option>`;

                Object.entries(data).forEach(([campo, ruta]) => {
                    if (campo !== 'declaracion_jurada' && ruta) {
                        const option = document.createElement('option');
                        option.value = ruta;
                        option.text  = campo.toUpperCase();
                        select.appendChild(option);
                    }
                });

                if (data.declaracion_jurada) {
                    const rutaDJ  = `/declaracion-jurada/pdf/${dni}`;
                    const option  = document.createElement('option');
                    option.value  = rutaDJ;
                    option.text   = 'DECLARACIÓN JURADA';
                    select.appendChild(option);
                }

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
        let ext = '';
        
        if (ruta.includes('/declaracion-jurada/pdf')) {
            ext = 'pdf';
        } else {
            ext = ruta.split('.').pop().toLowerCase();
        }

        const container = document.getElementById('preview-doc');
        const fullRuta = ruta.startsWith('/declaracion-jurada/pdf') ? ruta : `/storage/postulantes/${dni}/${ruta}`;
        container.innerHTML = '';

        if (ext === 'pdf') {
            container.innerHTML = `<iframe src="${fullRuta}" class="w-full h-96 border rounded" frameborder="0"></iframe>`;
        } else if (['jpg', 'jpeg', 'png'].includes(ext)) {
            container.innerHTML = `<img src="${fullRuta}" alt="Documento" class="max-w-full max-h-[400px] mx-auto rounded shadow" />`;
        } else {
            container.innerHTML = `<a href="${fullRuta}" target="_blank" class="text-blue-600 underline">Ver/descargar documento</a>`;
        }

        // Mostrar los botones de validar
        document.getElementById('acciones-validacion').classList.remove('hidden');
    }

    // ✅ Ahora la función validarDocumento está fuera y es accesible globalmente
    function validarDocumento(valido) {
        const select = document.getElementById('select-doc');
        const campo = select.options[select.selectedIndex].text.toLowerCase().trim(); // ejemplo: "dni"
        const dni = select.getAttribute('data-dni');

        const fila = document.querySelector(`tr[data-dni="${dni}"]`);
        if (!fila) return;

        const checkbox = fila.querySelector(`input[name="${campo}"]`);
        if (!checkbox) return;

        checkbox.checked = valido;

        // Opcional: cerrar el modal luego de marcar
        // cerrarModalDocumentos();
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
</script>

@endsection
