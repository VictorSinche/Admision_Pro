<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Declaración Jurada - Universidad María Auxiliadora</title>
    <link rel="icon" href="{{ asset('uma/img/logo-uma.ico') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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

    {{-- <div id="divLoading">
        <div id="subdivLoading">
            <img src="/uma/img/loading.gif" alt="Loading">
        </div>
    </div> --}}
    
    <div class="container-form mt-4">
        <div class="document-border">
            <!-- Encabezado -->
            <div class="header">
                <img src="{{ asset('/uma/img/logo.png') }}" alt="UMA Logo" class="logo">
                <h4>SOLICITUD DE INSCRIPCIÓN PARA <br> EL PROCESO DE ADMISIÓN</h4>
            </div>
            <p class="text-end"><small> Fecha de Presentación de la solicitud: <span id="fecha_solicitud"></span></small> </p>
            <form id="formDeclaracion">
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
                    <select id="distrito" name="distrito" class="form-select form-select-sm">
                        <option value="" selected disabled>Seleccione un distrito</option>
                        @foreach($ubigeos as $ubigeo)
                            <option value="{{ $ubigeo->codigo }}"
                                {{ ($data->c_dptodom . $data->c_provdom . $data->c_distdom) == $ubigeo->codigo ? 'selected' : '' }}>
                                {{ $ubigeo->nombre }}
                            </option>
                        @endforeach
                    </select>                      
                </div>  
                
                <div class="mb-2">                    
                    <input type="text" id="otroDistrito" name="otroDistrito" class="input-line d-none">
                </div>

                <div id="apoderadoSection" class="mt-3" style="display: none;">
                    <label for="apoderado_nombre" class="form-label">Nombre del apoderado (solo menores de edad):</label>
                    <input type="text" id="apoderado_nombre" name="apoderado_nombre" class="input-line mb-2">
            
                    <div class="row mb-2">
                        <div class="col-md-6">
                            <label for="apoderado_dni" class="form-label">DNI del apoderado:</label>
                            <input type="text" id="apoderado_dni" name="apoderado_dni" class="input-line">
                        </div>
                        <div class="col-md-6">
                            <label for="selectVinculo" class="form-label">Vínculo con el estudiante:</label>
                            <select id="selectVinculo" name="vinculo" class="form-select form-select-sm">
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

                <div class="md-2">
                    <label for="carrera" class="form-label">Carrera profesional:</label>
                        <input type="text" class="input-line mb-3" name="c_codesp1" value="{{ $especialidades->firstWhere('codesp', $data->c_codesp1)->nomesp ?? '' }}" readonly>
                </div>

                <p>
                    En la modalidad: <b>ORDINARIO</b>
                </p>

                <p class="fw-bold">Para lo cual acompaño la documentación requerida, con la calidad de declaración jurada:</p>
                <ul class="list-unstyled">
                    <li class="d-flex align-items-center">
                        <input id="formulario_inscripcion" type="checkbox" class="form-check-input me-2" name="formulario_inscripcion" value="1">
                        <label for="formulario_inscripcion">Formulario de inscripción virtual, debidamente llenado.</label>
                    </li>
                    <li class="d-flex align-items-center">
                        <input id="comprobante_pago" type="checkbox" class="form-check-input me-2" name="comprobante_pago" value="1">
                        <label for="comprobante_pago">Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión.</label>
                    </li>
                    <li class="d-flex align-items-center">
                        <input id="certificado_estudios" type="checkbox" class="form-check-input me-2" name="certificado_estudios" value="1">
                        <label for="certificado_estudios">Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria.</label>
                    </li>
                    <li class="d-flex align-items-center">
                        <input id="copia_dni" type="checkbox" class="form-check-input me-2" name="copia_dni" value="1">
                        <label for="copia_dni">Copia del D.N.I. y de su representante, de ser el caso de menores de edad.</label>
                    </li>
                    <li class="d-flex align-items-center">
                        <input id="seguro_salud" type="checkbox" class="form-check-input me-2" name="seguro_salud" value="1">
                        <label for="seguro_salud">Constancia de seguro de salud (ESSALUD, SIS, seguro particular).</label>
                    </li>
                    <li class="d-flex align-items-center">
                        <input id="foto_carnet" type="checkbox" class="form-check-input me-2" name="foto_carnet" value="1">
                        <label for="foto_carnet">Fotografía tamaño carné sobre fondo blanco.</label>
                    </li>
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
            <p>Yo, <b id="view_nombre_postulante">[Nombre del postulante] </b> Identificado con DNI Nº <b id="view_dni_postulante">[DNI]</b>, domiciliado en <b id="view_domicilio_postulante">[Domicilio]</b>, distrito de <b id="view_selectDistrito">[Distrito]</b>, postulante a la carrera profesional de  <b id="view_selectCarrera">[Carrera]</b>, con la finalidad de participar en el proceso de admisión 2025-II de la Universidad María Auxiliadora, declaro <b>BAJO JURAMENTO</b> lo siguiente:            
            </p>
            
            <ul class="mt-3">
                <li>
                    <b>HE CULMINADO</b> de manera satisfactoria mis estudios básicos – nivel secundaria en el año 
                    <input type="text" id="anio_secundaria" name="anio_secundaria" class="input-line ms-1" style="width: 60px;" maxlength="4">.
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
                <input class="form-check-input me-1" type="checkbox" id="acepto_terminos" required>
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
    


    {{-- <script>
        $(document).ready(function () {
            const meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio",
                           "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"];
            const f = new Date(), d = f.getDate().toString().padStart(2, '0'),
                  m = meses[f.getMonth()], mc = (f.getMonth() + 1).toString().padStart(2, '0'),
                  y = f.getFullYear();
    
            const fechas = {
                actual: `${d} días del mes de ${m} del ${y}`,
                solicitud: `${d}/${mc}/${y}`,
                lugar: `${d} de ${m} del ${y}`
            };
    
            $("#fecha_actual").text(fechas.actual);
            $("#fecha_solicitud").text(fechas.solicitud);
            $("#fecha_lugar").text(fechas.lugar);

            $('input[name="fech_nac"]').on('change', function () {                                
                const valor = $(this).val();
                if (!valor) return;

                const fechaNacimiento = new Date(valor);
                const hoy = new Date();
                let edad = hoy.getFullYear() - fechaNacimiento.getFullYear();
                const m = hoy.getMonth() - fechaNacimiento.getMonth();
                if (m < 0 || (m === 0 && hoy.getDate() < fechaNacimiento.getDate())) {
                    edad--;
                }

                if (edad <= 17) {
                    $('#apoderadoSection').slideDown();
                } else {
                    $('#apoderadoSection').slideUp();
                }
            });



            const documentos = [
            { id: 'formulario_inscripcion', texto: 'Formulario de inscripción virtual, debidamente llenado.' },
            { id: 'comprobante_pago', texto: 'Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión.' },
            { id: 'certificado_estudios', texto: 'Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria' },
            { id: 'copia_dni', texto: 'Copia del D.N.I. y de su representante, de ser el caso de menores de edad.' },
            { id: 'seguro_salud', texto: 'Constancia de seguro de salud (ESSALUD, SIS, seguro particular).' },
            { id: 'foto_carnet', texto: 'Fotografía tamaño carné sobre fondo blanco.' },
            ];

            const listaPendiente = document.getElementById('pendientesList');
            
            function renderizarPendiente(doc) {
                const li = document.createElement('li');
                li.classList.add('d-flex', 'align-items-center', 'mb-2');

                const input = document.createElement('input');
                input.type = 'checkbox';
                input.className = 'form-check-input me-2';
                input.name = doc.id;
                input.id = doc.id + '_pendiente';
                input.value = 2;
                input.checked = true;
                input.disabled = true;

                const label = document.createElement('label');
                label.htmlFor = input.id;
                label.textContent = doc.texto;

                li.appendChild(input);
                li.appendChild(label);
                li.id = `pendiente-${doc.id}`;
                listaPendiente.appendChild(li);
            }

            function actualizarListaPendientes() {
                let hayPendientes = false;
                listaPendiente.innerHTML = '';

                documentos.forEach(doc => {
                    const checkbox = document.getElementById(doc.id);
                    if (checkbox && !checkbox.checked) {
                        renderizarPendiente(doc);
                        hayPendientes = true;
                    }
                });

                listaPendiente.hidden = !hayPendientes;
            }
            // Lógica se activa solo cuando el usuario marca al menos un checkbox
            documentos.forEach(doc => {
                const checkbox = document.getElementById(doc.id);
                if (checkbox) {
                    checkbox.addEventListener('change', function () {
                        actualizarListaPendientes();
                    });
                }
            });

            function capitalizarTexto(texto) {
                if (!texto || typeof texto !== 'string') return '';
                return texto
                    .toLowerCase()
                    .replace(/\s+/g, ' ')
                    .trim()
                    .split(' ')
                    .map(p => p.charAt(0).toUpperCase() + p.slice(1))
                    .join(' ');
            }

        $('.btnGuardarDeclaracion').on('click', function () {            
            let nombre_postulante   = capitalizarTexto($('#nombre_postulante').val());
            let dni_postulante      = $.trim($('#dni_postulante').val());
            let fech_nac            = $.trim($('#fech_nac').val());
            let domicilio_postulante = capitalizarTexto($('#domicilio').val());
            let distrito            = capitalizarTexto($('#distrito').val());
            let otroDistrito = capitalizarTexto($('#otroDistrito').val());
            let carrera             = capitalizarTexto($('#carrera').val());
            let anio_secundaria     = $.trim($('#anio_secundaria').val());

            // Apoderado (pueden estar vacíos si no aplica)
            let apoderado_nombre = capitalizarTexto($('#apoderado_nombre').val() || '');
            let apoderado_dni    = $.trim($('#apoderado_dni').val());
            let selectVinculo    = capitalizarTexto($('#selectVinculo').val() || '');

            // Validar obligatorios mínimos
            let camposObligatorios = [
            '#nombre_postulante',
            '#dni_postulante',
            '#fech_nac',
            '#domicilio',
            '#distrito',
            '#carrera',
            '#anio_secundaria'
            ];

            let camposVacios = [];

            camposObligatorios.forEach(function(selector) {
                let campo = $(selector);
                if (!$.trim(campo.val())) {
                    camposVacios.push(selector);
                }
            });

            let aceptaTerminos = $('#acepto_terminos').is(':checked');

            if (camposVacios.length > 0) {
                $(camposVacios[0]).focus();
                GS.modalAdvertencia('Por favor, completa todos los campos obligatorios.');
                return;
            }
            // 🔒 Validación dinámica del año de secundaria
            let anioActual = new Date().getFullYear();
            let anioMaximoPermitido = anioActual - 1;
            let anioSecundariaNum = parseInt(anio_secundaria, 10);
            let anioValido = /^[0-9]{4}$/.test(anio_secundaria) && anioSecundariaNum <= anioMaximoPermitido;

            if (!anioValido) {
                $('#anio_secundaria').focus();
                GS.modalAdvertencia(`El año de finalización de secundaria debe ser un año válido de 4 dígitos y no mayor a ${anioMaximoPermitido}.`);
                return;
            }
            
            if (distrito === 'Otros' && !otroDistrito) {
                    GS.modalAdvertencia('Debe especificar el nombre del distrito si selecciona "Otros".');
                    return;
                }

            if (!aceptaTerminos) {
                $('#acepto_terminos').focus();
                GS.modalAdvertencia('Debes aceptar los Términos y Condiciones.');
                return;
            }
            // Si el bloque de apoderado está visible (usuario es menor), validar campos del apoderado
            let datosRepresentanteVisible = $('#apoderadoSection').is(':visible');
            if (datosRepresentanteVisible && (!apoderado_nombre || !apoderado_dni || !selectVinculo)) {
                GS.modalAdvertencia('Debe completar los datos del apoderado.');
                return;
            }

            // Obtener valores de los documentos (1 si marcado, 2 si no)
            function getDocValue(id) {
                return $(`#${id}`).is(':checked') ? 1 : 2;
            }

            let distritoFinal = (distrito === 'Otros') ? otroDistrito : distrito;
            let formData = {
                _token: "{{ csrf_token() }}",
                nombre_postulante: nombre_postulante,
                dni_postulante: dni_postulante,
                fech_nac: fech_nac,
                domicilio_postulante: domicilio_postulante,
                distrito: distritoFinal,
                carrera: carrera,
                anio_secundaria: anio_secundaria,

                formulario_inscripcion: getDocValue('formulario_inscripcion'),
                comprobante_pago:       getDocValue('comprobante_pago'),
                certificado_estudios:   getDocValue('certificado_estudios'),
                copia_dni:              getDocValue('copia_dni'),
                seguro_salud:           getDocValue('seguro_salud'),
                foto_carnet:            getDocValue('foto_carnet'),

                apoderado_nombre: datosRepresentanteVisible ? apoderado_nombre : null,
                apoderado_dni:    datosRepresentanteVisible ? apoderado_dni : null,
                selectVinculo:    datosRepresentanteVisible ? selectVinculo : null
            };

            GS.inicioSolicitud();

            // $.ajax({
            //     type: 'POST',
            //     url: "{{ route('administrativo.admision.GuardarDeclaracion') }}",
            //     data: formData,
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     success: function (response) {
            //         GS.finSolicitud();       
            //         if (response.status === 200) {
            //             GS.modalCorrecto(response.message); 
            //             const id = response.data.id;

            //             setTimeout(() => {
            //                 GS.modalConfirmacion(
            //                     "¿Deseas descargar tu declaración jurada?",
            //                     'Descárgala ahora o después aquí: <a href="/descargar-declaracion-jurada" target="_blank">Descargar declaración jurada</a>',
            //                     function () {
            //                         GS.inicioSolicitud();
            //                         $.ajax({
            //                             url: '/service/admision/declaracion-jurada/descargar/' + id,
            //                             type: 'GET',
            //                             success: function (res) {
            //                                 GS.finSolicitud();
            //                                 if (res.status === 200) {
            //                                     const blob = GS.b64toBlob(res.data.pdf.pdf, 'application/pdf');
            //                                     const url = window.URL.createObjectURL(blob);
            //                                     const a = document.createElement('a');
            //                                     a.href = url;
            //                                     a.download = res.data.pdf.filename;
            //                                     document.body.appendChild(a);
            //                                     a.click();
            //                                     window.URL.revokeObjectURL(url);
            //                                     a.remove();
            //                                 } else {
            //                                     GS.modalAdvertencia(res.message);
            //                                 }
            //                             },
            //                             error: function () {
            //                                 GS.finSolicitud();
            //                                 GS.modalError('No se pudo descargar la declaración jurada.');
            //                             }
            //                         });
            //                     }
            //                 );
            //             }, 800); // Espera medio segundo para no chocar visualmente
            //         } else {
            //             GS.modalAdvertencia(response.message || 'No se pudo registrar la declaración.');
            //         }
            //     },
            //     error: function () {
            //         GS.finSolicitud();
            //         GS.modalError('Ocurrió un error en el servidor.');
            //     }
            // });          
        });

        $('#nombre_postulante').on('input', function (){
            $('#view_nombre_postulante').text($(this).val());
        });
        $('#dni_postulante').on('input', function (){
            $('#view_dni_postulante').text($(this).val());
        });
        $('#domicilio').on('input', function (){
            $('#view_domicilio_postulante').text($(this).val());
        });
        
        $('#carrera').on('input', function (){
            $('#view_selectCarrera').text($(this).val());
        });     

        $('#distrito').on('change input', function () {
            let selectedValue = $(this).val();

            if (selectedValue === 'Otros') {
                $('#otroDistrito').removeClass('d-none');
                // Forzar que se actualice inmediatamente con lo que haya escrito (aunque esté vacío)
                $('#view_selectDistrito').text($('#otroDistrito').val());

            } else {
                $('#otroDistrito').addClass('d-none').val('');
                $('#view_selectDistrito').text(selectedValue);
            }
        });

        $('#otroDistrito').on('input', function () {
            $('#view_selectDistrito').text($(this).val());
        });



        });
    </script>
     --}}
<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
</body>
</html>
