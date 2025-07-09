<?php

namespace App\Http\Controllers;

use App\Models\InfoPostulante;
use App\Models\DeclaracionJurada;
use App\Models\DocumentoPostulante;
use App\Models\VerificacionDocumento;
use App\Models\HistorialVerificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use App\Exports\PostulantesDJExport;
use App\Models\ControlDocumentos;
use Maatwebsite\Excel\Facades\Excel;

class InfoPostulanteController extends Controller
{

    public function storeOrUpdate(Request $request)
    {
        try {
            $postulanteExistente = InfoPostulante::where('c_numdoc', $request->c_numdoc)->first();

            $validated = $request->validate([
                'id_mod_ing'     => 'required|string|size:1',
                'c_apepat'       => 'required|string|max:50',
                'c_apemat'       => 'required|string|max:50',
                'c_nombres'      => 'required|string|max:50',
                'c_tipdoc'       => 'required|string|max:10',
                'c_numdoc'       => [
                    'required',
                    'string',
                    'max:11',
                    Rule::unique('info_postulante', 'c_numdoc')->ignore(optional($postulanteExistente)->id),
                ],
                'c_email'        => 'nullable|email|max:50',
                'c_celu'         => 'nullable|string|max:30',
                'c_dir'          => 'nullable|string|max:100',
                'c_sexo'         => 'nullable|string|max:1',
                'c_dniapo'       => 'nullable|string|max:20',
                'c_nomapo'       => 'nullable|string|max:100',
                'c_celuapo'      => 'nullable|string|max:20',
                'c_fonoapo'      => 'nullable|string|max:20',
                'c_procedencia'  => 'nullable|string|max:100',
                'c_anoegreso'    => 'nullable|string|max:10',
                'c_tippro'       => 'nullable|string|max:10',
                'id_tab_alu_contact' => 'nullable|string|max:10',
                'id_tab_turno'   => 'nullable|string|max:10',
                'c_codesp1'      => 'required|string|max:5',
                'id_proceso'     => 'required|integer',
                'c_sedcod'       => 'nullable|string|max:4',
                'ubigeo'         => 'required|string|size:6', // Asegura que ubigeo venga
                'c_colg_ubicacion' => 'nullable|string|max:100',
                'd_fecnac'       => 'nullable|date',
            ]);

            // Obtener c_codfac desde el proceso seleccionado
            $c_codfac = DB::connection('mysql_sigu')
                ->table('sga_tb_adm_proceso')
                ->where('id_proceso', $validated['id_proceso'])
                ->value('c_codfac');

            // Estado y fecha de confirmación
            $validated['estado'] = 1;
            $validated['fecha_confirmacion'] = now();

            // Extraer códigos de ubicación
            $ubigeo = $validated['ubigeo'];
            $c_dptodom = substr($ubigeo, 0, 2);
            $c_provdom = substr($ubigeo, 2, 2);
            $c_distdom = substr($ubigeo, 4, 2);

            // Obtener nombre de la especialidad desde la base externa
            $nomesp = DB::connection('mysql_sigu')
                ->table('tb_especialidad')
                ->where('codesp', $validated['c_codesp1'])
                ->value('nomesp');

            // Asignar al array validated
            $validated['nomesp'] = $nomesp ?? 'Sin nombre';

            // Guardar en base local
            $postulante = InfoPostulante::updateOrCreate(
                ['c_numdoc' => $validated['c_numdoc']],
                $validated
            );

            // Guardar en base externa
            // DB::connection('mysql_sigu_permits')
            //     ->table('sga_tb_adm_cliente')
            //     ->updateOrInsert(
            //         ['c_numdoc' => $validated['c_numdoc']],
            //         [
            //             'id_mod_ing'     => $validated['id_mod_ing'],
            //             'c_apepat'       => $validated['c_apepat'],
            //             'c_apemat'       => $validated['c_apemat'],
            //             'c_nombres'      => $validated['c_nombres'],
            //             'c_email'        => $validated['c_email'],
            //             'c_dir'          => $validated['c_dir'],
            //             'c_sexo'         => $validated['c_sexo'],
            //             'd_fecnac'       => $validated['d_fecnac'] ?? now(),
            //             'c_celu'         => $validated['c_celu'],
            //             'c_dptodom'      => $c_dptodom,
            //             'c_provdom'      => $c_provdom,
            //             'c_distdom'      => $c_distdom,
            //         ]
            //     );

            //     // Guardar en sesión
            // session(['c_numdoc' => $validated['c_numdoc']]);

            // Logging de cambios
            if ($postulante->wasRecentlyCreated) {
                Log::info('🆕 Postulante registrado:', $validated);
            } else {
                $cambios = [];
                foreach ($validated as $campo => $valor) {
                    if ($postulanteExistente && $postulanteExistente->$campo !== $valor) {
                        $cambios[$campo] = [
                            'antes' => $postulanteExistente->$campo,
                            'después' => $valor,
                        ];
                    }
                }

                if (!empty($cambios)) {
                    Log::info("🔁 Postulante actualizado (DNI: {$postulante->c_numdoc}):", $cambios);
                } else {
                    Log::info("🔁 Postulante con DNI {$postulante->c_numdoc} fue reenviado sin cambios.");
                }
            }

            return response()->json([
                'success' => true,
                'mensaje' => $postulante->wasRecentlyCreated
                    ? '✅ Postulante registrado correctamente.'
                    : '🔁 Datos del postulante actualizados.',
                'actualizado' => !$postulante->wasRecentlyCreated,
            ]);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error("❌ Error al registrar/actualizar postulante: " . $e->getMessage());
            return response()->json(['message' => 'Ocurrió un error al guardar el postulante.'], 500);
        }
    }

    public function mostrarFormulario()
    {
        $dni = session('dni_postulante');

        if (!$dni) {
            return redirect()->route('login.postulante')->with('error', 'Inicia sesión para continuar');
        }

        $postulante = DB::connection('mysql_sigu')
            ->table('sga_tb_adm_cliente')
            ->where('c_numdoc', $dni)
            ->first();

        session(['datos_postulante' => $postulante]);

        $ubigeos = DB::connection('mysql_sigu')
            ->table('vw_ubigeo')
            ->select('codigo', 'nombre')
            ->get();

        $procesos = DB::connection('mysql_sigu')
            ->table('sga_tb_adm_proceso')
            ->where('c_codpro', '20252')
            ->select('id_proceso', 'c_nompro', 'c_codfac')
            ->get();

        $especialidades = DB::connection('mysql_sigu')
            ->table('tb_especialidad')
            ->get();

        $modalidades = DB::connection('mysql_sigu')
            ->table('sga_tb_modalidad_ingreso')
            ->where('c_web', 'SI')
            ->get();

        return view('student.registro', [
            'modalidades'     => $modalidades,
            'data'            => $postulante,
            'ubigeos'         => $ubigeos,
            'procesos'        => $procesos,
            'especialidades'  => $especialidades,
        ]);
    }

    public function vistaDocumentos($c_numdoc)
    {
        $dniSesion = session('c_numdoc');
        
        if($dniSesion !== $c_numdoc) {
            abort(403, 'No tienes permiso para acceder a esta pagina');
        }

        $postulante = InfoPostulante::with('documentos', 'verificacion', 'controlDocumentos')->where('c_numdoc', $c_numdoc)->firstOrFail();
        
        $mapaModalidades = [
            'B' => 'primeros_puestos',
            'A' => 'ordinario',
            'O' => 'alto_rendimiento',
            'D' => 'translado_externo',
            'E' => 'admision_tecnicos',
            'C' => 'admision_pre_uma',
        ];

        $codigo = $postulante->id_mod_ing;
        $modalidad = $mapaModalidades[$codigo] ?? 'default';
        $nombreModalidad = [
            'B' => 'Primeros Puestos',
            'A' => 'Ordinario',
            'O' => 'Alto Rendimiento',
            'D' => 'Traslado Externo',
            'E' => 'Admisión para Técnicos',
            'C' => 'Admisión Pre-UMA',
        ][$codigo] ?? 'Desconocida';

        $registraDoc = DocumentoPostulante::where('info_postulante_id', $postulante->id)->first();
        $documentosCompletos = $registraDoc && $registraDoc->estado == 2;

        $declaracionExiste = \App\Models\DeclaracionJurada::where('info_postulante_id', $postulante->id)->exists();
        $djValidado = optional($postulante->verificacion)->dj;

        return view('student.subirdocument', compact('postulante', 'modalidad', 'nombreModalidad', 'documentosCompletos', 'declaracionExiste', 'djValidado'));
    }

    public function guardarDocumentos(Request $request)
    {
        try {
            $postulante = InfoPostulante::where('c_numdoc', $request->c_numdoc)->first();

            if (!$postulante) {
                return back()->with('error', 'Postulante no encontrado.');
            }

            $accessToken = session('microsoft_token');

            $documentosPorModalidad = [
                'A' => ['formulario', 'pago', 'seguro', 'dni', 'constancia' ],
                'C' => ['formulario', 'pago', 'seguro', 'dni', 'constancia' ],
                'B' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito' ],
                'O' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito' ],
                'D' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'constmatricula', 'syllabus' ],
                'E' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'constmatricula', 'syllabus', 'certprofesional' ],
            ];

            $codigo = $postulante->id_mod_ing;
            $documentosRequeridos = $documentosPorModalidad[$codigo] ?? [];

            // Traer o crear el registro único por postulante
            $registro = DocumentoPostulante::firstOrNew([
                'info_postulante_id' => $postulante->id,
            ]);

            $documentosSubidos = 0;

            $control = ControlDocumentos::firstOrNew(['info_postulante_id' => $postulante->id]);
            // Subimos archivos requeridos como antes
            foreach ($documentosRequeridos as $campo) {
                $bloqueado = optional($postulante->controlDocuementos)->$campo ?? false;
                if($bloqueado) continue;

                    if ($request->hasFile($campo)) {
                        $archivo = $request->file($campo);
                        if ($archivo->isValid()) {
                            if (!empty($registro->$campo)) {
                                $rutaAnterior = 'postulantes/' . $postulante->c_numdoc . '/' . $registro->$campo;
                                Storage::disk('public')->delete($rutaAnterior);
                            }
                
                            $nombre = now()->format('Ymd_His') . '_' . $campo . '.' . $archivo->getClientOriginalExtension();
                            $ruta = $archivo->storeAs('postulantes/' . $postulante->c_numdoc, $nombre, 'public');
                            // SUBIR A ONEDRIVE
                            try {
                                $respuesta = $this->subirAOneDrive('postulantes/' . $postulante->c_numdoc . '/' . $nombre, $nombre, session('microsoft_token'));
                                Log::info("📤 Subido a OneDrive: " . json_encode($respuesta));
                            } catch (\Exception $ex) {
                                Log::error("❌ Error al subir a OneDrive: " . $ex->getMessage());
                            }
                            Log::info("📂 Subido archivo: $nombre a $ruta");
                            $registro->$campo = $nombre;
                            
                            $control->$campo = true;
                        } else {
                            Log::warning("⚠️ Archivo inválido en campo: $campo");
                        }
                    }
            }

            // Guardamos antes de contar
            $registro->save();
            $control->save();

            // Recontar cuántos documentos requeridos ya están llenos (no null)
            $documentosSubidos = collect($documentosRequeridos)
                ->filter(fn($campo) => !empty($registro->$campo))
                ->count();

            // Estado general
            if ($documentosSubidos === 0) {
                $registro->estado = 0;
            } elseif ($documentosSubidos < count($documentosRequeridos)) {
                $registro->estado = 1;
            } else {
                $registro->estado = 2;
            }

            $registro->save();


            // Mensaje dinámico
            if ($registro->estado < 2) {
                return redirect()->back()
                    ->with('success', 'Se cargaron algunos documentos.')
                    ->with('documentos_incompletos', true);
            }

            return redirect()->back()->with('success', '✅ Todos los documentos fueron cargados correctamente.');
        } catch (\Exception $e) {
            Log::error('❌ Error al guardar documentos: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al registrar los documentos.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | funciones de Declarción Jurada
    |--------------------------------------------------------------------------
    */

    public function vistaDeclaracionJurada()
    {
        $dni = session('c_numdoc');

        if (!$dni) {
            return redirect()->route('login.postulante')->with('error', 'Inicia sesión para continuar');
        }

        $postulante = DB::connection('mysql_sigu')
            ->table('sga_tb_adm_cliente')
            ->where('c_numdoc', $dni)
            ->first();

        // 🔁 Ahora tomamos la data completa desde mysql_sigu
        $data = DB::connection('mysql_sigu')
            ->table('sga_tb_adm_cliente')
            ->where('c_numdoc', $dni)
            ->first();

        $ubigeos = DB::connection('mysql_sigu')
            ->table('vw_ubigeo')
            ->select('codigo', 'nombre')
            ->get();

        $especialidades = DB::connection('mysql_sigu')
            ->table('tb_especialidad')
            ->get();

        if (!$postulante) {
            return back()->with('error', 'No se encontró información del postulante.');
        }

        $mapaModalidades = [
            'B' => 'formulario-primer-puesto',
            'A' => 'formulario-ordinario',
            'O' => 'formulario-alto-rendimiento',
            'D' => 'formulario-traslado-externo',
            'E' => 'formulario-admision-tecnico',
            'C' => 'formulario-pre-uma',
        ];

        $infoLocal = \App\Models\InfoPostulante::where('c_numdoc', $dni)->first();

        $doc = \App\Models\DocumentoPostulante::where('info_postulante_id', $infoLocal?->id)->first();

        $documentosMarcados = [
            'formulario_inscripcion' => !empty($doc?->formulario),
            'comprobante_pago' => !empty($doc?->pago),
            'certificado_estudios' => !empty($doc?->constancia),
            'copia_dni' => !empty($doc?->dni),
            'seguro_salud' => !empty($doc?->seguro),
            'certificado_notas_original' => !empty($doc?->constancianotas),
            'constancia_primera_matricula' => !empty($doc?->constmatricula),
            'syllabus_visados' => !empty($doc?->syllabus),
            'titulo_tecnico' => !empty($doc?->certprofesional),
            'constancia_colegio' => !empty($doc?->merito),
        ];

        $codigo = $postulante->id_mod_ing;
        $modalidad = $mapaModalidades[$codigo] ?? 'default';
        $fecha_actual = Carbon::now()->format('d-m-Y');

        return view('declaracionJurada.formulario', compact('postulante', 'modalidad', 'data', 'ubigeos', 'especialidades', 'fecha_actual', 'documentosMarcados'));
    }

    public function guardarDeclaracion(Request $request)
    {
        try {
            $dni = session('c_numdoc');

            if (!$dni) {
                Log::warning('🚫 No hay sesión activa al intentar guardar declaración jurada.');
                return redirect()->route('login.postulante')->with('error', 'Inicia sesión para continuar');
            }

            $postulante = InfoPostulante::where('c_numdoc', $dni)->first();

            if (!$postulante) {
                Log::error("❌ No se encontró el postulante con DNI: {$dni}");
                return back()->with('error', 'No se encontró información del postulante.');
            }

            // Verifica que se haya marcado el checkbox
            if (!$request->has('acepto_terminos')) {
                Log::info("⚠️ Términos no aceptados por: {$dni}");
                return back()->with('error', 'Debes aceptar los Términos y Condiciones para continuar.');
            }

            // 🔍 Log de todos los datos recibidos
            Log::info("📥 Datos recibidos para guardar declaración jurada:", $request->all());

            // Guardar o actualizar la declaración jurada
            $registro = DeclaracionJurada::updateOrCreate(
                ['info_postulante_id' => $postulante->id],
                [
                    'id_mod_ing' => $postulante->id_mod_ing,
                    'formulario_inscripcion' => $request->input('formulario_inscripcion', 0),
                    'comprobante_pago' => $request->input('comprobante_pago', 0),
                    'certificado_estudios' => $request->input('certificado_estudios', 0),
                    'copia_dni' => $request->input('copia_dni', 0),
                    'seguro_salud' => $request->input('seguro_salud', 0),
                    // 'foto_carnet' => $request->input('foto_carnet', 0),
                    'certificado_notas_original' => $request->input('certificado_notas_original', 0),
                    'constancia_primera_matricula' => $request->input('constancia_primera_matricula', 0),
                    'syllabus_visados' => $request->input('syllabus_visados', 0),
                    'titulo_tecnico' => $request->input('titulo_tecnico', 0),
                    'constancia_colegio' => $request->input('constancia_colegio', 0),
                    'selectVinculo' => trim($request->input('selectVinculo')),
                    'universidad_traslado' => trim($request->input('universidad_traslado')),
                    'anno_culminado' => trim($request->input('anno_culminado')),

                    'estado' => 1,
                ]
            );

            Log::info("✅ Declaración jurada actualizada:", $registro->toArray());

            Log::info("✅ Declaración jurada guardada correctamente para DNI: {$postulante->c_numdoc}");

        return redirect()->route('student.subirdocumentos', ['c_numdoc' => $postulante->c_numdoc])
            ->with('declaracion_enviada', true);
        } catch (\Exception $e) {
            Log::error('❌ Error al guardar declaración jurada: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Ocurrió un error al guardar la declaración.');
        }
    }

    public function listarPostulantesConDJ()
    {
        // Solo traer postulantes que tienen declaración jurada (dj.id no nulo)
        $postulantes = DB::table('info_postulante as ip')
            ->join('declaracion_jurada as dj', 'ip.id', '=', 'dj.info_postulante_id') // usamos JOIN en vez de LEFT JOIN
            ->select(
                'ip.id',
                'ip.c_nombres',
                'ip.c_apepat',
                'ip.c_apemat',
                'ip.id_mod_ing',
                'ip.c_codesp1',
                'ip.c_email',
                'ip.c_numdoc',
                'ip.nomesp',
                'dj.created_at as dj_fecha',
                'dj.id as dj_id'
            )
            ->orderBy('dj.created_at', 'desc')
            ->get();

        // Traer modalidades desde la base externa
        $modalidades = DB::connection('mysql_sigu')
            ->table('sga_tb_modalidad_ingreso')
            ->pluck('c_descri', 'id_mod_ing');

        // Asignar nombre de modalidad manualmente a cada postulante
        $postulantes->transform(function ($postulante) use ($modalidades) {
            $postulante->nombre_modalidad = $modalidades[$postulante->id_mod_ing] ?? 'Desconocida';
            return $postulante;
        });

        return view('admision.historialDJ', compact('postulantes'));
    }

    public function exportarExcelDJ(Request $request)
    {
        try {
            $tipos = $request->input('tipo_admision');
            if (!is_array($tipos) || empty($tipos)) {
                return back()->with('error', 'Debe seleccionar al menos un tipo de admisión');
            }

            $placeholders = implode(',', array_fill(0, count($tipos), '?'));

            $sql = "SELECT  
                    CONCAT(ip.c_apepat, ' ', ip.c_apemat, ' ', ip.c_nombres) AS nombre_postulante,
                    ip.c_numdoc AS dni_postulante,
                    ip.nomesp AS carrera,
                    CASE dj.id_mod_ing
                        WHEN 'A' THEN 'ORDINARIO'
                        WHEN 'C' THEN 'PRE-UMA'
                        WHEN 'D' THEN 'TRASLADO EXTERNO'
                        WHEN 'E' THEN 'ADMISIÓN TÉCNICOS'
                        WHEN 'R' THEN 'ALTO RENDIMIENTO'
                        ELSE 'DESCONOCIDO'
                    END AS tipo,
                    DATE(dj.created_at) AS fecha_registro,

                    CASE 
                        WHEN dj.id_mod_ing IN ('A','C','D','E','R') THEN 
                            CASE dj.formulario_inscripcion WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS formulario_inscripcion,

                    CASE 
                        WHEN dj.id_mod_ing IN ('A','C','D','E','R') THEN 
                            CASE dj.comprobante_pago WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS comprobante_pago,

                    CASE 
                        WHEN dj.id_mod_ing IN ('A','C','R') THEN 
                            CASE dj.certificado_estudios WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS certificado_estudios,

                    CASE 
                        WHEN dj.id_mod_ing = 'R' THEN 
                            CASE dj.constancia_colegio WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS constancia_colegio,

                    CASE 
                        WHEN dj.id_mod_ing IN ('A','C','D','E','R') THEN 
                            CASE dj.copia_dni WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS copia_dni,

                    CASE 
                        WHEN dj.id_mod_ing IN ('A','C','D','E','R') THEN 
                            CASE dj.seguro_salud WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS seguro_salud,

                    --CASE 
                        --WHEN dj.id_mod_ing IN ('A','C','D','E','R') THEN 
                            --CASE dj.foto_carnet WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        --ELSE 'NO APLICA'
                    --END AS foto_carnet,

                    CASE 
                        WHEN dj.id_mod_ing IN ('D','E') THEN 
                            CASE dj.certificado_notas_original WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS certificado_notas_original,

                    CASE 
                        WHEN dj.id_mod_ing IN ('D','E') THEN 
                            CASE dj.constancia_primera_matricula WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS constancia_primera_matricula,

                    CASE 
                        WHEN dj.id_mod_ing IN ('D','E') THEN 
                            CASE dj.syllabus_visados WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS syllabus_visados,

                    CASE 
                        WHEN dj.id_mod_ing = 'E' THEN 
                            CASE dj.titulo_tecnico WHEN '1' THEN 'PRESENTÓ' WHEN '0' THEN 'NO PRESENTÓ' END
                        ELSE 'NO APLICA'
                    END AS titulo_tecnico

                FROM declaracion_jurada dj
                INNER JOIN info_postulante ip ON ip.id = dj.info_postulante_id
                WHERE dj.id_mod_ing IN ($placeholders)
            ";

            $data = DB::connection('mysql')->select($sql, $tipos);

            return Excel::download(new PostulantesDJExport($data), 'reporte_declaraciones.xlsx');

        } catch (\Exception $e) {
            Log::error('❌ Error al exportar excel DJ: ' . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al exportar los datos.');
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Lista de Postulantes con Estados
    |--------------------------------------------------------------------------
    */
    public function resumenEstados()
    {
        $postulantes = DB::table('postulantes as p')
            ->leftJoin('info_postulante as ip', 'ip.c_numdoc', '=', 'p.dni')
            ->leftJoin('documentos_postulante as dp', 'dp.info_postulante_id', '=', 'ip.id')
            ->leftJoin('declaracion_jurada as dj', 'dj.info_postulante_id', '=', 'ip.id')
            ->leftJoin('verificacion_documentos as vd', 'vd.info_postulante_id', '=', 'ip.id') // <- nuevo join
            ->select(
                'p.id',
                'ip.c_numdoc',
                DB::raw("CONCAT(p.nombres, ' ', p.apellidos) as nombre_completo"),
                'p.email',
                'ip.estado as estado_info',
                'dp.estado as estado_docs',
                'dj.estado as estado_dj',
                'vd.estado as estado_verificacion' // <- nuevo campo
            )
            ->orderBy('p.id', 'asc')
            ->get();

        return view('admision.listapostulantes', compact('postulantes'));
    }

    public function documentosJson($dni)
    {
        try {
            $postulante = InfoPostulante::where('c_numdoc', $dni)->firstOrFail();
            $documentos  = DocumentoPostulante::where('info_postulante_id', $postulante->id)->first();
            if (!$documentos) {
                $documentosFiltrados = collect();
            } else {
                $documentosFiltrados = collect($documentos->getAttributes())
                    ->filter(fn ($valor, $campo) =>
                        $campo !== 'estado' &&
                        !in_array($campo, ['id','info_postulante_id','created_at','updated_at']) &&
                        $valor
                    );
            }
            $tieneDJ = DeclaracionJurada::whereHas('infoPostulante', function ($q) use ($dni) {
                            $q->where('c_numdoc', $dni);
                    })->exists();
            if ($tieneDJ) {
                $documentosFiltrados['declaracion_jurada'] = true;
            }
            return response()->json($documentosFiltrados);
        } catch (\Exception $e) {
            Log::error("❌ Error documentosJson: ".$e->getMessage());
            return response()->json(['error' => 'No se pudo cargar los documentos'], 500);
        }
    }

    /*
    |--------------------------------------------------------------------------
    | Funcion para validar documentos
    |--------------------------------------------------------------------------
    */
    public function listarPostulantes()
    {
        $postulantes = InfoPostulante::with('verificacion')->get();
        $postulantes = InfoPostulante::paginate(10);

        return view('admision.validarDocs.validardocpostulantes', compact('postulantes'));
    }

    public function validarCampo(Request $request)
    {
        $request->validate([
            'dni' => 'required|string',
            'campo' => 'required|in:formulario,pago,dni,seguro,dj',
            'estado' => 'required|in:0,1,2',
        ]);

        $postulante = InfoPostulante::where('c_numdoc', $request->dni)->firstOrFail();
        $verificacion = VerificacionDocumento::firstOrNew([
            'info_postulante_id' => $postulante->id
        ]);

        $verificacion->{$request->campo} = $request->estado;
        $verificacion->save();
        $camposRequeridos = ['formulario', 'pago', 'dni', 'seguro', 'dj'];
        $valores = collect($camposRequeridos)->map(fn($campo) => $verificacion->{$campo});

        if ($valores->every(fn($v) => $v === 2)) {
            $verificacion->estado = 2; // Completado
        } elseif ($valores->contains(0)) {
            $verificacion->estado = 1; // Pendiente
        } else {
            $verificacion->estado = 1; // Incompleto (pero ya revisado)
        }

        $verificacion->save();

        HistorialVerificacion::create([
            'info_postulante_id' => $postulante->id,
            'tabla' => 'verificacion_documentos',
            'campo' => $request->campo,
            'estado' => $request->estado,
            'cod_user' => session('cod_user') ?? '',
            'actualizado_por' => session('nombre_completo') ?? 'Sistema',
        ]);

        return response()->json(['message' => 'Validación guardada y estado actualizado correctamente']);
    }


    /*
    |--------------------------------------------------------------------------
    | Funcion para subir a OneDrive
    |--------------------------------------------------------------------------
    */
    public function subirAOneDrive($rutaLocal, $nombreArchivo, $accessToken)
    {
        $cliente = new \GuzzleHttp\Client();

        $contenido = Storage::disk('public')->get($rutaLocal); // Lee desde storage/public

        $response = $cliente->put("https://graph.microsoft.com/v1.0/me/drive/root:/UMA-Postulantes/$nombreArchivo:/content", [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Content-Type'  => 'application/octet-stream',
            ],
            'body' => $contenido,
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }

}
