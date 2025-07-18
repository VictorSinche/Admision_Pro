<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaración Jurada - Universidad María Auxiliadora</title>
    <link rel="icon" href="{{ asset('uma/img/logo-uma.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/js/sweetalert2.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://kit.fontawesome.com/c500eba471.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: #f8f9fa;
            padding: 20px;
            line-height: 1.7;
        }
        .container-form {
            max-width: 900px;
            margin: 0 auto;
            padding: 30px;
            background: #ffffff;
            /* border: 1px solid #a0a0a0; */
            border: 1px solid #c41c407d;
            border-radius: 15px;
        }
        /* .document-border {
            padding: 20px;
            border: 1px solid #5a0c1d;
        } */
        .header {
            color: #ec244f;
            text-align: center;
            padding: 15px;
        }
        .logo {
            max-width: 150px;
            padding-bottom: 20px;
        }
        .input-line {
            border: none;
            border-bottom: 1px solid black;
            outline: none;
            display: inline-block;
            font-size: 16px;
            line-height: normal;
            width: 100%;
        }

    </style>
</head>
<body>
    
    <div class="container-form mt-4">
        <div class="document-border">
            <!-- Encabezado -->
            <div class="header">
                <img src="{{ asset('/uma/img/logo.png') }}" alt="UMA Logo" class="logo">
                <h4>SOLICITUD DE INSCRIPCIÓN PARA <br> EL PROCESO DE ADMISIÓN</h4>
            </div>
            <p class="text-end"><small> Fecha de Presentación de la solicitud: <span id="fecha_solicitud">{{ $fecha_actual }}</span></small> </p>
            <form id="formDeclaracion" method="POST" action="{{ route('declaracionJurada.guardar') }}">
                @csrf                
                <h5 class="fw-bold text-danger">Sr. Rector de la Universidad María Auxiliadora <br>Presente. -</h5>
                <div class="mb-2">
                    <label for="nombre_postulante" class="form-label">Quien suscribe (colocar los apellidos y nombres completos del <b>postulante</b> en la siguiente línea):</label>
                    <input type="text" id="nombre_postulante" name="nombre_postulante" class="input-line" 
                    value="{{ $data->c_nombres ?? '' }} {{ $data->c_apepat ?? '' }} {{ $data->c_apemat ?? '' }}" readonly>
                </div>  

                <div class="row mb-2">
                    <div class="col-md-6">
                        <label for="dni_postulante" class="form-label">DNI del postulante:</label>
                        <input type="text" id="dni_postulante" name="dni_postulante" class="input-line"
                        value="{{ $data->c_numdoc ?? '' }}" maxlength="8" readonly>
                    </div>
                    <div class="col-md-6">
                        <label for="fech_nac" class="form-label">Fecha de nacimiento:</label>
                        <input type="date" id="fech_nac" name="fech_nac" class="input-line"
                        value="{{ $data->d_fecnac ?? '' }}" readonly>
                    </div>
                </div>

                <div class="mb-2">
                    <label for="domicilio" class="form-label">Domicilio:</label>
                    <input type="text" id="domicilio" name="domicilio"
                        value="{{ $data->c_dir }}" class="input-line" readonly>
                </div>

                <div class="mb-2">
                    <label for="distrito" class="form-label">Distrito:</label>
                    <input 
                        type="text" 
                        id="distrito" 
                        name="distrito" 
                        class="form-control form-control-sm"
                        value="{{ optional($ubigeos->firstWhere('codigo', $postulante->c_dptodom . $postulante->c_provdom . $postulante->c_distdom))->nombre ?? '' }}"
                        readonly
                    >
                </div>

                <div id="apoderadoSection" class="mt-3" style="display: none;">
                    <label for="apoderado_nombre" class="form-label">Nombre del apoderado (solo menores de edad):</label>
                    <input type="text" id="apoderado_nombre" name="apoderado_nombre" class="input-line mb-2"
                    value="{{ $data->c_nomapo ?? '' }}" readonly>

                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="apoderado_dni" class="form-label">DNI del apoderado:</label>
                            <input type="text" id="apoderado_dni" name="apoderado_dni" class="input-line"
                            value="{{ $data->c_dniapo ?? '' }}" maxlength="8">
                        </div>
                        <div class="col-md-6">
                            <label for="selectVinculo" class="form-label">Vínculo con el estudiante:</label>
                            <select id="selectVinculo" name="selectVinculo" class="form-select form-select-sm">
                                <option value="" selected disabled>Seleccionar</option>
                                <option value="Papá">Papá</option>
                                <option value="Mamá">Mamá</option>
                                <option value="Apoderado">Apoderado</option>
                            </select>
                        </div>
                    </div>
                </div>                

                <p>Ante Ud. Con el debido respeto me presento y expongo:</p>

                <p>
                    Que, <strong>DECLARO BAJO JURAMENTO</strong> cumplir con todos los requisitos establecidos para postular a la Universidad María Auxiliadora, y conocer las normas que rigen el presente Proceso de Admisión, con el cual expreso mi <strong>CONFORMIDAD</strong>. Por lo expuesto, solicito a usted, se admita mi inscripción como Postulante a la Carrera Profesional de:
                </p>

                @php
                    $selectedEsp = collect($especialidades)->firstWhere('codesp', $data->c_codesp1 ?? '');
                @endphp

                <div class="mb-2">
                    <label for="carrera" class="form-label">Carrera profesional:</label>
                        <input type="text" 
                        class="form-control form-control-sm" 
                        name="c_codesp1" 
                        value="{{ $especialidades->firstWhere('codesp', $data->c_codesp1)->nomesp ?? '' }}" 
                        readonly>                        
                    </select>
                </div>

                <p>
                    En la modalidad: <b>ORDINARIO</b>
                </p>

                <p class="fw-bold">Para lo cual acompaño la documentación requerida, con la calidad de declaración jurada:</p>
                <ul class="list-unstyled">
                    @php
                        $campos = [
                            'formulario_inscripcion' => 'Formulario de inscripción virtual, debidamente llenado.',
                            'comprobante_pago' => 'Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión.',
                            'certificado_estudios' => 'Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria.',
                            'copia_dni' => 'Copia del D.N.I. y de su representante, de ser el caso de menores de edad.',
                            'seguro_salud' => 'Constancia de seguro de salud (ESSALUD, SIS, seguro particular).',
                        ];
                    @endphp

                    <ul class="list-unstyled">
                        @foreach ($campos as $nombre => $descripcion)
                            @php
                                $marcado = old($nombre, $documentosMarcados[$nombre] ?? false);
                            @endphp
                            <li class="d-flex align-items-center">
                                <input type="hidden" name="{{ $nombre }}" value="{{ $marcado ? 1 : 0 }}">
                                <input id="{{ $nombre }}" type="checkbox"
                                    class="form-check-input me-2 bloqueado"
                                    name="{{ $nombre }}_check"
                                    value="1"
                                    {{ $marcado ? 'checked' : '' }}>
                                <label for="{{ $nombre }}" class="bloqueado">{{ $descripcion }}</label>
                            </li>
                        @endforeach
                    </ul>

                    <style>
                        .bloqueado {
                            pointer-events: none;
                            background-color: #ffffff;
                            border-color: #ffffff;
                            user-select: none;
                        }
                    </style>
                </ul>                
                <p class="mt-4">
                    En caso de falsedad en lo declarado y de la documentación presentada, me allano a las disposiciones y sanciones que emita la Universidad María Auxiliadora.
                </p>
                <p>Sin otro particular, quedo de usted.</p>
        </div>
    </div>

    <div class="container-form mt-4">
        <div class="document-border">
            <!-- Encabezado -->
            <div class="header">
                <img src="{{ asset('/uma/img/logo.png') }}" alt="UMA Logo" class="logo">
                <h4>DECLARACIÓN JURADA</h4>
            </div>
            <p>Yo, <b id="view_nombre_postulante"> {{ $data->c_nombres . ' ' . $data->c_apepat . ' ' . $data->c_apemat }}</b> Identificado con DNI Nº <b id="view_dni_postulante">{{ $data->c_numdoc }}</b>, domiciliado en <b id="view_domicilio_postulante">{{ $data->c_dir }}</b>, distrito de <b id="view_selectDistrito">{{ optional($ubigeos->firstWhere('codigo', $data->c_dptodom . $data->c_provdom . $data->c_distdom))->nombre }}</b>, postulante a la carrera profesional de  <b id="view_selectCarrera">{{ optional($especialidades->firstWhere('codesp', $data->c_codesp1))->nomesp }}</b>, con la finalidad de participar en el proceso de admisión 2025-II de la Universidad María Auxiliadora, declaro <b>BAJO JURAMENTO</b> lo siguiente:            
            </p>
            
            <ul class="mt-3">
                <li>
                    <b>HE CULMINADO</b> de manera satisfactoria mis estudios básicos – nivel secundaria en el año 
                    <input type="text" id="anio_secundaria" name="anio_secundaria" class="input-line ms-1" style="width: 60px;" maxlength="4" value="{{ $data->c_anoegreso ?? '' }}">
                </li>
                
                <li><b>CUMPLO CON LOS REQUISITOS</b> exigidos por la UNIVERSIDAD MARÍA AUXILIADORA para participar en el proceso de admisión 2025-II.</li>
                <li>
                    Que cumpliré con presentar o remitir al área de Admisión de la UMA, máximo hasta el inicio de clases 
                    <b>(25 de Agosto) de 2025</b>, con única prórroga hasta la culminación del semestre académico 2025-II, 
                    la documentación que tengo pendiente de presentar, que se detalla a continuación:
                    <ul id="pendientesList" class="list-unstyled mt-3 ps-3" hidden>
                        <!-- Aquí se insertarán los documentos pendientes -->
                    </ul>
                </li>
            </ul>
            <p>En caso de falsedad o incumplimiento de lo aquí declarado <b>AUTORIZO</b> a la Universidad María Auxiliadora y sin posibilidad de reclamo, a restringir mi matrícula para el siguiente semestre académico, a bloquear mi acceso a mi SIGU del estudiante concluido el semestre académico y a no entregarme el certificado o constancia de estudios o notas del semestre concluido o cualquier otro documento asociado hasta que no cumpla con presentar mi certificado o constancia de culminación satisfactoria de estudios secundarios; sin derecho a reembolso de los pagos que pudiera haber efectuado a dicha fecha.</p>
            <div class="mb-3">
                <p>En señal de absoluta conformidad y expreso conocimiento y voluntad con lo aquí declarado, suscribo el presente documento a los <span id="fecha_actual"></span>.</p>
            </div>  
            
            <div class="d-flex align-items-center mt-3">
                <input name="acepto_terminos" class="form-check-input me-1" type="checkbox" id="acepto_terminos" required>
                <label class="form-check-label" for="acepto_terminos">
                    Acepto los <a href="#" data-bs-toggle="modal" data-bs-target="#indicacionesModal">Términos y Condiciones</a>.
                </label>
            </div> 
            </form>
        </div>
    </div>

    <div class="text-center mt-3">
        <button type="button" class="btn btn-danger btnGuardarDeclaracion">
            <b> Enviar Declaración</b> <i class="fa-regular fa-paper-plane"></i>
        </button>
    </div>

    <div class="modal fade" id="indicacionesModal" tabindex="-1" aria-labelledby="indicacionesModalLabel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <img src="{{ asset('/uma/img/logo.png') }}" alt="UMA Logo" class="mx-auto d-block" style="max-width: 150px;">
                </div>
                <div class="modal-body">
                    <h4 class="text-center fw-bold text-danger mb-4">INDICACIONES GENERALES</h4>
                    <ol class="text-justify mt-2">
                        <li>Una vez iniciada la inscripción o cualquier pago, no se aceptarán devoluciones de dinero bajo ningún concepto.</li>
                        <li>Una vez que se envían las credenciales (código de estudiante y contraseñas de las plataformas de la UMA) al estudiante, el servicio educativo está a su disposición y es de su entera responsabilidad recibirlo asistiendo a las clases programadas, sean virtuales o presenciales, no procediendo la devolución de dinero, después de haberse puesto el servicio a su disposición.</li>
                        <li>Las tasas y cuotas de enseñanza se pagan de acuerdo al cronograma de pagos establecido por la UMA. El cronograma de pagos de un ciclo está conformado por el pago de una matrícula y 5 cuotas y las condiciones del pago son comunicadas junto con el Cronograma.</li>
                        <li>La apertura de un turno y horario están sujetos a un número mínimo de 20 matriculados.</li>
                        <li>La documentación y datos consignados serán trasladados a la matrícula de su Ciclo I. En consecuencia, toda la alteración de la verdad será únicamente responsabilidad del alumno.</li>
                    </ol>
                    <p class="mt-4">En señal de conocimiento y conformidad con las indicaciones aquí contenidas, suscribo el presente documento.</p>
                    <p class="text-end"><small> San Juan de Lurigancho, <span id="fecha_lugar"></span></small> </p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    


    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputFecha = document.getElementById('fech_nac');
            const apoderadoSection = document.getElementById('apoderadoSection');

            if (inputFecha && apoderadoSection) {
                const fechaNacimiento = inputFecha.value;

                if (fechaNacimiento) {
                    const hoy = new Date();
                    const nacimiento = new Date(fechaNacimiento);
                    let edad = hoy.getFullYear() - nacimiento.getFullYear();
                    const mes = hoy.getMonth() - nacimiento.getMonth();

                    if (mes < 0 || (mes === 0 && hoy.getDate() < nacimiento.getDate())) {
                        edad--;
                    }

                    if (edad < 18) {
                        apoderadoSection.style.display = 'block';
                    } else {
                        apoderadoSection.style.display = 'none';
                    }
                }
            }
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const checkboxes = document.querySelectorAll('input[type="checkbox"].form-check-input');
            const pendientesList = document.getElementById('pendientesList');

            const actualizarPendientes = () => {
            // Limpiar lista
            pendientesList.innerHTML = '';

            // Arreglo para acumular pendientes
            let tienePendientes = false;

            checkboxes.forEach(checkbox => {
                if (checkbox.id === 'acepto_terminos') return; // Ignorar el checkbox de términos y condiciones


                const label = document.querySelector(`label[for="${checkbox.id}"]`);
                if (!checkbox.checked) {
                tienePendientes = true;

                // Crear un nuevo ítem deshabilitado
                const li = document.createElement('li');
                li.classList.add('text-muted', 'mb-2');
                li.innerHTML = `<i class="fa-regular fa-circle-xmark text-danger me-2"></i> ${label.textContent}`;
                pendientesList.appendChild(li);
                }
            });

            // Mostrar u ocultar la lista según haya pendientes
            pendientesList.hidden = !tienePendientes;
            };

            // Ejecutar al cargar
            actualizarPendientes();

            // Ejecutar cuando cualquier checkbox cambie
            checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', actualizarPendientes);
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const btnEnviar = document.querySelector('.btnGuardarDeclaracion');
            const aceptoTerminos = document.getElementById('acepto_terminos');
            const form = document.getElementById('formDeclaracion');

            const vinculo = document.getElementById('selectVinculo');
            const universidad = document.getElementById('universidad_traslado');
            const anio = document.getElementById('anno_culminado');

            btnEnviar.addEventListener('click', function (e) {
                e.preventDefault();

                let errores = [];

                // Limpiar estilos previos
                [vinculo, universidad, anio].forEach(el => el?.classList.remove('is-invalid'));

                // Validar términos
                if (!aceptoTerminos.checked) {
                    errores.push('Aceptar los Términos y Condiciones');
                }

                // Validar campos visibles
                if (vinculo && vinculo.offsetParent !== null && vinculo.value === "") {
                    vinculo.classList.add('is-invalid');
                    errores.push('Vínculo con el estudiante');
                }

                if (universidad && universidad.offsetParent !== null && universidad.value.trim() === "") {
                    universidad.classList.add('is-invalid');
                    errores.push('Nombre de la universidad');
                }

                if (anio && anio.offsetParent !== null && anio.value.trim() === "") {
                    anio.classList.add('is-invalid');
                    errores.push('Año de culminación');
                }

                if (errores.length > 0) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Faltan campos por completar',
                        html: '<ul style="text-align:left;">' + errores.map(e => `<li>🔸 ${e}</li>`).join('') + '</ul>',
                        confirmButtonColor: '#e72352',
                    });
                    return;
                }

                // Si todo está OK
                form.submit();
            });
        });
    </script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
