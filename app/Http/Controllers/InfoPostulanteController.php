<?php

namespace App\Http\Controllers;

use App\Models\InfoPostulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
class InfoPostulanteController extends Controller
{
    // public function store(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'id_mod_ing'     => 'required|string|size:1',
    //             'c_apepat'       => 'required|string|max:50',
    //             'c_apemat'       => 'required|string|max:50',
    //             'c_nombres'      => 'required|string|max:50',
    //             'c_tipdoc'       => 'required|string|max:10',
    //             'c_numdoc'       => 'required|string|max:11|unique:info_postulante,c_numdoc',
    //             'c_email'        => 'nullable|email|max:50',
    //             'c_celu'         => 'nullable|string|max:30',
    //             'c_codesp1'      => 'required|string|max:5',
    //             'id_proceso'     => 'required|integer',
    //             'c_sedcod'       => 'nullable|string|max:4',
    //         ]);

    //         $validated['estado'] = 1;
    //         $validated['fecha_confirmacion'] = now();

    //         InfoPostulante::create($validated);


    //         session(['c_numdoc' => $request->c_numdoc]);

    //         return response()->json(['message' => '✅ Registro confirmado correctamente.']);
    //     } catch (ValidationException $e) {
    //         return response()->json(['errors' => $e->errors()], 422);
    //     } catch (\Exception $e) {
    //         Log::error("❌ Error al guardar postulante local: " . $e->getMessage());

    //         return response()->json(['message' => 'Ocurrió un error al guardar el postulante.'], 500);
    //     }
    // }
        
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

        // Estado y fecha de confirmación
        $validated['estado'] = 1;
        $validated['fecha_confirmacion'] = now();

        // Extraer códigos de ubicación
        $ubigeo = $validated['ubigeo'];
        $c_dptodom = substr($ubigeo, 0, 2);
        $c_provdom = substr($ubigeo, 2, 2);
        $c_distdom = substr($ubigeo, 4, 2);

        // Guardar en base local
        $postulante = InfoPostulante::updateOrCreate(
            ['c_numdoc' => $validated['c_numdoc']],
            $validated
        );

        // Guardar en base externa
        DB::connection('mysql_sigu_permits')
            ->table('sga_tb_adm_cliente')
            ->updateOrInsert(
                ['c_numdoc' => $validated['c_numdoc']],
                [
                    'id_mod_ing'     => $validated['id_mod_ing'],
                    'c_apepat'       => $validated['c_apepat'],
                    'c_apemat'       => $validated['c_apemat'],
                    'c_nombres'      => $validated['c_nombres'],
                    'c_tipdoc'       => $validated['c_tipdoc'],
                    'c_email'        => $validated['c_email'],
                    'c_dir'          => $validated['c_dir'],
                    'c_sexo'         => $validated['c_sexo'],
                    'd_fecnac'       => $validated['d_fecnac'] ?? now(),
                    'c_celu'         => $validated['c_celu'],
                    'id_proceso'     => $validated['id_proceso'],
                    'c_codesp1'      => $validated['c_codesp1'],
                    'c_sedcod'       => $validated['c_sedcod'] ?? '',
                    'c_dptodom'      => $c_dptodom,
                    'c_provdom'      => $c_provdom,
                    'c_distdom'      => $c_distdom,
                    'c_colg_ubicacion' => $validated['c_colg_ubicacion'] ?? '',
                    'c_dniapo'       => $validated['c_dniapo'],
                    'c_nomapo'       => $validated['c_nomapo'],
                    'c_celuapo'      => $validated['c_celuapo'],
                    'c_fonoapo'      => $validated['c_fonoapo'],
                    'c_procedencia'  => $validated['c_procedencia'],
                    'c_anoegreso'    => $validated['c_anoegreso'],
                    'c_tippro'       => $validated['c_tippro'],
                    'id_tab_alu_contact' => $validated['id_tab_alu_contact'],
                    'id_tab_turno'   => $validated['id_tab_turno'],
                ]
            );

        // Guardar en sesión
        session(['c_numdoc' => $validated['c_numdoc']]);

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

        $postulante = InfoPostulante::where('c_numdoc', $c_numdoc)->firstOrFail();
        
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

        return view('student.subirdocument', compact('postulante', 'modalidad', 'nombreModalidad'));
    }

    public function guardarDocumentos(Request $request)
    {
        try {
            $postulante = InfoPostulante::where('c_numdoc', $request->c_numdoc)->first();

            if (!$postulante) {
                return back()->with('error', 'Postulante no encontrado.');
            }

            // $documentos = [
            //     'formulario', 'pago', 'constancia', 'constancianotas', 'dni', 'seguro', 'foto',
            //     'constmatricula', 'certprofecional', 'syllabus', 'merito'
            // ];

            $documentosPorModalidad = [
                'B' => ['formulario', 'pago', 'constancia', 'merito', 'dni', 'seguro', 'foto'],
                'A' => ['formulario', 'pago', 'constancia', 'dni', 'seguro', 'foto'],
                'D' => ['formulario', 'pago', 'constancia', 'constmatricula', 'certprofecional', 'syllabus', 'dni', 'seguro', 'foto'],
                'O' => ['formulario', 'pago', 'constancia', 'merito', 'dni', 'seguro', 'foto'],
                'E' => ['formulario', 'pago', 'constancianotas', 'constmatricula', 'syllabus', 'certprofecional', 'dni', 'seguro', 'foto'],
                'C' => ['formulario', 'pago', 'constancia', 'dni', 'seguro', 'foto'],
            ];

            $codigo = $postulante->id_mod_ing;
            $documentosRequeridos = $documentosPorModalidad[$codigo] ?? [];

            // Traer o crear el registro único por postulante
            $registro = \App\Models\DocumentoPostulante::firstOrNew([
                'info_postulante_id' => $postulante->id,
            ]);

            $documentosSubidos = 0;

            // Subimos archivos requeridos como antes
            foreach ($documentosRequeridos as $campo) {
                if ($request->hasFile($campo)) {
                    $archivo = $request->file($campo);
                    if ($archivo->isValid()) {
                        $nombre = now()->format('Ymd_His') . '_' . $campo . '.' . $archivo->getClientOriginalExtension();
                        $ruta = $archivo->storeAs('postulantes/' . $postulante->c_numdoc, $nombre, 'public');
                        Log::info("📂 Subido archivo: $nombre a $ruta");
                        $registro->$campo = $nombre;
                    } else {
                        Log::warning("⚠️ Archivo inválido en campo: $campo");
                    }
                }
            }

            // Guardamos antes de contar
            $registro->save();

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
    | Rutas de Declarción Jurada
    |--------------------------------------------------------------------------
    */

    public function vistaOrdinario()
    {
        $dni = session('c_numdoc');

        if (!$dni) {
            return redirect()->route('login.postulante')->with('error', 'Inicia sesión para continuar');
        }

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

            
        if (!$data) {
            return back()->with('error', 'No se encontró información del postulante.');
        }

        return view('declaracionJurada.formulario-ordinario', compact('data', 'ubigeos', 'especialidades'));
    }
}
