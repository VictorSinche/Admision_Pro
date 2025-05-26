@php
    use App\Helpers\Util;
@endphp


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Declaración Jurada - UMA</title>
    <style>
        /* body {            
            font-family: Arial, sans-serif;
            font-size: 14px;
            color: #000;
            line-height: 1.8;
            margin: 20px 25px; 
        } */

        @page {
            size: A4;
            margin: 8.8mm 0 0 0;
        }
        body {
            font-family: Arial, sans-serif;
            max-width: 297mm;
            max-height: 210mm;
            font-size: 14px;
            margin-top: 15px;
            margin-bottom: 18px;
            margin-left: 80px;
            margin-right: 80px;
            line-height: 1.7;
        }


        p {
        margin-top: 0;
        margin-bottom: 0;
        }

        .center {
            text-align: center;
        }
        .center h2{
            color: #ec244f;
            line-height:1.3;
                       
        }
        h3{            
            margin-bottom: 2px;
            margin-top:1px;
        }

        .bold {
            font-weight: bold;
        }

        .page-break {
            page-break-after: always;
        }

        .input-line {
            border-bottom: 1px solid black;
            display: inline-block;
            width: 100%;
            height: 20px;
        }

        ul.list {
            list-style: none;
            padding-left: 0;
            margin-bottom: 5px;
            margin-top: 3px
        }

        ul.list li {
            margin-top: 0;
        margin-bottom: 0;
        }
        .check-symbol {
        font-family: DejaVu Sans, sans-serif;   
        margin-right: 5px;        
        }
    </style>
</head>
<body>

{{-- PRIMERA HOJA --}}
<div>
    <div class="center">
        <img src="data:image/jpeg;base64,{{Util::base64ImgRelativo('/uma/img/logo.png')}}" alt="UMA" width="170">
        <h2>SOLICITUD DE INSCRIPCIÓN PARA <br> EL PROCESO DE ADMISIÓN</h2>
    </div>

    <p style="text-align: right;"><small> Fecha de Presentación de la solicitud: {{ \Carbon\Carbon::parse($declaracion->created_at)->format('d/m/Y') }}</small> </p>
    <h3>Sr. Rector de la Universidad María Auxiliadora <br>Presente. -</h3>
    
    <p style="padding-top: 5px;padding-bottom: 5px">Quien suscribe (colocar los apellidos y nombres completos del <b>postulante</b> en la siguiente línea):</p>
    <p>
        <strong>{{ $data->c_nombres }} {{ $data->c_apepat }} {{ $data->c_apemat }}</strong>
        identificado con DNI N° <strong>{{ $data->c_numdoc }}</strong>,
        domiciliado en <strong>{{ $data->c_dir }}</strong>,
        distrito de <strong>{{ $nombreDistrito }}</strong>.
    </p>

    @php
        $nacimiento = \Carbon\Carbon::parse($data->d_fecnac);
        $esMenorEdad = $nacimiento->age < 18;
    @endphp

    @if($esMenorEdad)
        <p>Representado por (llenar datos del apoderado, <b>sólo para menores de edad):</b></p>
        <p>
            <strong>Apoderado:</strong> {{ $data->c_nomapo }}<br>
            <strong>Identificado con DNI N°:</strong> {{ $data->c_dniapo }}<br>
            {{-- <strong>Vínculo con el estudiante:</strong> {{ $data->selectVinculo }} --}}
        </p>
    @endif

    <p style="padding-top: 5px;padding-bottom: 5px">Ante Ud. Con el debido respeto me presento y expongo: <p>
    Que, <b>DECLARO BAJO JURAMENTO</b> cumplir con todos los requisitos establecidos para postular a la Universidad María Auxiliadora, y conocer las normas que rigen el presente Proceso de Admisión, con el cual expreso mi <b>CONFORMIDAD</b>. Por lo expuesto, solicito a usted, se admita mi inscripción como Postulante a la Carrera Profesional de: 
    <strong>{{ optional($especialidades->firstWhere('codesp', $declaracion->infoPostulante->c_codesp1))->nomesp }}</strong>
    </p>

    @php
        $tiposTexto = [
            'A' => 'ORDINARIO',
            'B' => 'PRIMEROS PUESTOS',
            'C' => 'ADMISIÓN PRE-UMA',
            'D' => 'TRASLADO EXTERNO',
            'E' => 'ADMISIÓN PARA TÉCNICOS',
            'O' => 'ALTO RENDIMIENTO',
        ];
        $textoTipo = $tiposTexto[$declaracion->infoPostulante->id_mod_ing] ?? 'DESCONOCIDO';
    @endphp

    <p style="padding-top: 5px;padding-bottom: 5px">
        En la modalidad: <b>{{ $textoTipo }}</b>
    </p>

    <b>Para lo cual acompaño la documentación requerida, con la calidad de declaración jurada:</b>
    <p class="bold">Documentos entregados (marcados):</p>
    @php
    $documentosTipo = [
        'A' => [ // Ordinario
            'formulario_inscripcion' => 'Formulario de inscripción virtual, debidamente llenado.',
            'comprobante_pago' => 'Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión.',
            'certificado_estudios' => 'Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria.',
            'copia_dni' => 'Copia del D.N.I. y de su representante, de ser el caso de menores de edad.',
            'seguro_salud' => 'Constancia de seguro de salud (ESSALUD, SIS, seguro particular).',
            'foto_carnet' => 'Fotografía tamaño carné sobre fondo blanco.',
        ],
        'B' => [ // Primeros Puestos
            'formulario_inscripcion' => 'Formulario de inscripción virtual, debidamente llenado.',
            'comprobante_pago' => 'Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión.',
            'certificado_estudios' => 'Certificado o constancia de estudios o documento similar idóneo que acredite los 5 años de estudios de Educación Secundaria.',
            'constancia_colegio' => 'Constancia o resolución original del director del colegio que acredite el orden de mérito requerido.',
            'copia_dni' => 'Copia del D.N.I. y de su representante.',
            'seguro_salud' => 'Constancia de seguro de salud.',
            'foto_carnet' => 'Fotografía tamaño carné sobre fondo blanco.',
        ],
        'C' => [ // Pre-UMA
            'formulario_inscripcion' => 'Formulario de inscripción virtual, debidamente llenado.',
            'comprobante_pago' => 'Copia del comprobante de Pago por Derechos de Inscripción al Concurso de Admisión.',
            'certificado_estudios' => 'Certificado o constancia de estudios.',
            'copia_dni' => 'Copia del D.N.I.',
            'seguro_salud' => 'Constancia de seguro de salud.',
            'foto_carnet' => 'Fotografía tamaño carné sobre fondo blanco.',
        ],
        'D' => [ // Traslado Externo
            'formulario_inscripcion' => 'Formulario de inscripción virtual, debidamente llenado.',
            'comprobante_pago' => 'Copia del comprobante de Pago por Derechos de Inscripción.',
            'certificado_notas_original' => 'Certificado de notas original.',
            'constancia_primera_matricula' => 'Constancia de primera matrícula.',
            'syllabus_visados' => 'Syllabus visados.',
            'copia_dni' => 'Copia del D.N.I.',
            'seguro_salud' => 'Constancia de seguro de salud.',
            'foto_carnet' => 'Fotografía tamaño carné.',
        ],
        'E' => [ // Técnicos
            'formulario_inscripcion' => 'Formulario de inscripción virtual.',
            'comprobante_pago' => 'Copia del comprobante de pago.',
            'certificado_notas_original' => 'Certificado de notas original.',
            'constancia_primera_matricula' => 'Constancia de primera matrícula.',
            'certificado_estudios' => 'Certificado de estudios técnicos.',
            'syllabus_visados' => 'Syllabus visados.',
            'titulo_tecnico' => 'Título técnico.',
            'copia_dni' => 'Copia del D.N.I.',
            'seguro_salud' => 'Constancia de seguro.',
            'foto_carnet' => 'Fotografía tamaño carné.',
        ],
        'O' => [ // Alto rendimiento
            'formulario_inscripcion' => 'Formulario de inscripción virtual.',
            'comprobante_pago' => 'Copia del comprobante de pago.',
            'certificado_estudios' => 'Certificado o constancia de estudios.',
            'constancia_colegio' => 'Constancia de promedio de 14 (de 3° a 5° secundaria).',
            'copia_dni' => 'Copia del D.N.I.',
            'seguro_salud' => 'Constancia de seguro de salud.',
            'foto_carnet' => 'Fotografía tamaño carné.',
        ]
    ];

    $tipo = $data->id_mod_ing;
    $documentos = $documentosTipo[$tipo] ?? [];
@endphp

<ul class="list">
    @foreach($documentos as $campo => $etiqueta)
        @if($declaracion->$campo == 1)
            <li><span class="check-symbol">☑</span> {{ $etiqueta }}</li>
        @endif
    @endforeach
</ul>

    <p>En caso de falsedad en lo declarado y de la documentación presentada, me allano a las disposiciones y sanciones que emita la Universidad María Auxiliadora.</p>
    <p style="padding-top: 4px">Sin otro particular, quedo de usted.</p>
</div>

{{-- SALTO DE PÁGINA --}}
<div class="page-break"></div>

{{-- SEGUNDA HOJA --}}
<div>
    <div class="center">
        <img src="data:image/jpeg;base64,{{Util::base64ImgRelativo('/uma/img/logo.png')}}" alt="UMA" width="130">
        <h2>DECLARACIÓN JURADA</h2>        
    </div>

    <p>
        Yo, <strong>{{ $data->c_nombres }} {{ $data->c_apepat }} {{ $data->c_apemat }}</strong> identificado con DNI N° <strong>{{ $data->c_numdoc }}</strong>,
        domiciliado en <strong>{{ $data->c_dir }}</strong>, distrito de <strong>{{ $nombreDistrito }}</strong>,
        postulante a la carrera profesional de <strong>{{ optional($especialidades->firstWhere('codesp', $declaracion->infoPostulante->c_codesp1))->nomesp }}</strong>,
        con la finalidad de participar en el proceso de admisión 2025-II de la Universidad María Auxiliadora, declaro <b>BAJO JURAMENTO</b> lo siguiente: 
    </p>

@php
    $mapaTipo = [
        'A' => 'O',    // Ordinario
        'B' => 'PP',   // Primeros Puestos
        'C' => 'PRE',  // Pre-UMA
        'D' => 'TE',   // Traslado Externo
        'E' => 'TEC',  // Técnicos
        'O' => 'AR',   // Alto Rendimiento
    ];
    $codigo = $declaracion->infoPostulante->id_mod_ing;
    $tipoExtendido = $mapaTipo[$codigo] ?? 'DESCONOCIDO';
@endphp

    

    <ul>
        @if($tipoExtendido == 'O' || $tipoExtendido == 'PP' || $tipoExtendido == 'AR' || $tipoExtendido == 'PRE')
            <li><b>- HE CULMINADO</b> de manera satisfactoria mis estudios básicos – nivel secundaria en el año {{ $data->c_anoegreso }}.</li>
        @elseif($tipoExtendido == 'TEC')
            <li><b>- HE CULMINADO</b> de manera satisfactoria mis estudios de nivel superior - técnico o profesional en el año {{ $declaracion->anno_culminado }}.</li>
        @elseif($tipoExtendido == 'TE')
            <li><b>- HE CURSADO</b>  de manera satisfactoria mis estudios de nivel superior - profesional en la universidad  {{ $declaracion->universidad_traslado }} hasta el año {{ $declaracion->anno_culminado }}.</li>
        @endif
    
        <li><b>- CUMPLO CON LOS REQUISITOS</b> exigidos por la UNIVERSIDAD MARÍA AUXILIADORA para participar del proceso de admisión 2025-II.</li>
        <li><b>-</b> Que cumpliré con presentar o remitir al área de Admisión de la UMA, máximo hasta el inicio de clases <b>(25 de Agosto) de 2025</b>, con única prórroga hasta la culminación del semestre académico 2025-II, la documentación que tengo pendiente de presentar:</li>
        </ul>

        @php
            // Reutiliza el array $documentos del bloque anterior
            // Un campo == 0 significa pendiente
            $pendientes = collect($documentos)->filter(function($label, $campo) use ($declaracion) {
                return $declaracion->$campo == 0;
            });
        @endphp

        @if($pendientes->count())
            <p class="bold">Me comprometo a presentar los siguientes documentos pendientes:</p>
            <ul class="list">
                @foreach($pendientes as $label)
                    <li><span class="check-symbol">☑</span> {{ $label }}</li>
                @endforeach
            </ul>
        @endif

    @php
        $mapaTipo = [
            'A' => 'O',    // Ordinario
            'B' => 'PP',   // Primeros Puestos
            'C' => 'PRE',  // Pre-UMA
            'D' => 'TE',   // Traslado Externo
            'E' => 'TEC',  // Técnicos
            'O' => 'AR',   // Alto Rendimiento
        ];
        $tipoExtendido = $mapaTipo[$data->id_mod_ing] ?? 'DESCONOCIDO';
    @endphp


    @if($tipoExtendido == 'O')
        <p>En caso de falsedad o incumplimiento de lo aquí declarado <b>AUTORIZO</b> a la Universidad María Auxiliadora y sin posibilidad de reclamo, a restringir mi matrícula para el siguiente semestre académico, a bloquear mi acceso a mi SIGU del estudiante concluido el semestre académico y a no entregarme el certificado o constancia de estudios o notas del semestre concluido o cualquier otro documento asociado hasta que no cumpla con presentar mi certificado o constancia de culminación satisfactoria de estudios secundarios; sin derecho a reembolso de los pagos que pudiera haber efectuado a dicha fecha.</p>
    @elseif($tipoExtendido == 'TEC')
        <p>En caso de falsedad o incumplimiento de lo aquí declarado <b>AUTORIZO</b> a la Universidad María Auxiliadora y sin posibilidad de reclamo, a restringir mi matrícula para el siguiente semestre académico, anular la convalidación de cursos efectuada, a bloquear mi acceso a mi SIGU del estudiante concluido el semestre académico y a no entregarme el certificado o constancia de notas del semestre concluido o cualquier documento asociado, así como la Resolución de Convalidación, hasta que cumpla con presentar los documentos pendientes; sin derecho a reembolso de los pagos que pudiera haber efectuado a dicha fecha.</p>
    @elseif($tipoExtendido == 'TE')
        <p>En caso de falsedad o incumplimiento de lo aquí declarado <b>AUTORIZO</b> a la Universidad María Auxiliadora y sin posibilidad de reclamo a restringir mi matrícula para el siguiente semestre académico, anular la convalidación de cursos efectuada, a bloquear mi acceso a mi SIGU del estudiante concluido el semestre académico y a no entregarme el certificado o constancia de notas del semestre concluido o cualquier documento asociado, así como la Resolución de Convalidación, hasta que cumpla con presentar los documentos pendientes; sin derecho a reembolso de los pagos que pudiera haber efectuado a dicha fecha.</p>
    @elseif($tipoExtendido == 'PP')
        <p>En caso de falsedad o incumplimiento de lo aquí declarado <b>AUTORIZO</b> a la Universidad María Auxiliadora y sin posibilidad de reclamo, a restringir mi matrícula para el siguiente semestre académico, a bloquear mi acceso a mi SIGU del estudiante concluido el semestre académico y a no entregarme el certificado o constancia de notas del semestre concluido o cualquier documento asociado, hasta que no cumpla con presentar mi certificado o constancia de culminación satisfactoria de estudios secundarios; sin derecho a reembolso de los pagos que pudiera haber efectuado a dicha fecha.</p>
    @elseif($tipoExtendido == 'AR')
        <p>En caso de falsedad o incumplimiento de lo aquí declarado <b>AUTORIZO</b> a la Universidad María Auxiliadora y sin posibilidad de reclamo, a restringir mi matrícula para el siguiente semestre académico, a bloquear mi acceso a mi SIGU del estudiante concluido el semestre académico y a no entregarme el certificado o constancia de notas o cualquier documento asociado del semestre concluido hasta que no cumpla con presentar mi certificado o constancia de culminación satisfactoria de estudios secundarios; sin derecho a reembolso de los pagos que pudiera haber efectuado a dicha fecha.</p>
    @elseif($tipoExtendido == 'PRE')
        <p>En caso de falsedad o incumplimiento de lo aquí declarado <b>AUTORIZO</b> a la Universidad María Auxiliadora y sin posibilidad de reclamo, a restringir mi matrícula para el siguiente semestre académico, a bloquear mi acceso a mi SIGU del estudiante concluido el semestre académico y a no entregarme el certificado o constancia de notas del semestre concluido o cualquier documento asociado hasta que no cumpla con presentar mi certificado o constancia de culminación satisfactoria de estudios secundarios; sin derecho a reembolso de los pagos que pudiera haber efectuado a dicha fecha.</p>
    @endif


    
    @php
    use Carbon\Carbon;

    $fecha = Carbon::parse($declaracion->created_at);
    $dia = $fecha->day;
    $mes = $fecha->translatedFormat('F'); // "Marzo"
    $anio = $fecha->year;
    @endphp

    <p style="padding-top: 5px">
        En señal de absoluta conformidad y expreso conocimiento y voluntad con lo aquí declarado, suscribo el presente documento a los {{ $dia }} días del mes de {{ ucfirst($mes) }} del {{ $anio }}.
    </p>

</div>

{{-- TERCERA HOJA --}}
<div class="page-break"></div>

<div>
    <div class="center">
        <img src="data:image/jpeg;base64,{{ Util::base64ImgRelativo('/uma/img/logo.png') }}" alt="UMA" width="130">
        <h2>INDICACIONES GENERALES</h2>
    </div>

    <ol>
        <li>Una vez iniciada la inscripción o cualquier pago, no se aceptarán devoluciones de dinero bajo ningún concepto.</li>
        <li>Una vez que se envían las credenciales (código de estudiante y contraseñas de las plataformas de la UMA) al estudiante, el servicio educativo está a su disposición y es de su entera responsabilidad recibirlo asistiendo a las clases programadas, sean virtuales o presenciales, no procediendo la devolución de dinero, después de haberse puesto el servicio a su disposición.</li>
        <li>Las tasas y cuotas de enseñanza se pagan de acuerdo al cronograma de pagos establecido por la UMA. El cronograma de pagos de un ciclo está conformado por el pago de una matrícula y 5 cuotas y las condiciones del pago son comunicadas junto con el Cronograma.</li>
        <li>La apertura de un turno y horario están sujetos a un número mínimo de 20 matriculados.</li>
        <li>La documentación y datos consignados serán trasladados a la matrícula de su Ciclo I. En consecuencia, toda la alteración de la verdad será únicamente responsabilidad del alumno.</li>
    </ol>

    <p class="mt-4">
        En señal de conocimiento y conformidad con las indicaciones aquí contenidas, suscribo el presente documento.
    </p>    
        @php
        \Carbon\Carbon::setLocale('es');
        $fechaFormateada = \Carbon\Carbon::parse($declaracion->created_at)->translatedFormat('d \d\e F \d\e\l Y');
    @endphp
    <p style="text-align: right">San Juan de Lurigancho, {{ $fechaFormateada }}</p>

</div>


</body>
</html>
