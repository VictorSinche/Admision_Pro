<?php

namespace App\Http\Controllers;

use App\Models\ControlDocumentos;
use App\Models\HistorialVerificacion;
use Illuminate\Http\Request;
use App\Models\InfoPostulante;

class EncargadoController extends Controller
{
    public function formularioBusqueda()
    {
        return view('admision.validarDocs.formularioBusqueda');
    }

    public function revisarDocumentos(Request $request)
    {
        $dni = $request->dni;

        $postulante = InfoPostulante::with(['documentos', 'controlDocumentos']) // relación que crearemos
            ->where('c_numdoc', $dni)
            ->first();

        if (!$postulante) {
            return back()->with('error', 'Postulante no encontrado.');
        }

        $codigo = $postulante->id_mod_ing;

        $nombreModalidad = [
            'B' => 'Primeros Puestos',
            'A' => 'Ordinario',
            'O' => 'Alto Rendimiento',
            'D' => 'Traslado Externo',
            'L' => 'Titulos y Graduados',
            'C' => 'Admisión Pre-UMA',
        ][$codigo] ?? 'Desconocida';

        // Mapeo de modalidad a documentos
        $documentosPorModalidad = [
            'A' => ['formulario', 'pago', 'seguro', 'dni', 'constancia' ],
            'C' => ['formulario', 'pago', 'seguro', 'dni', 'constancia' ],
            //'L' => ['formulario', 'pago', 'seguro', 'dni', 'certprofesional' ],
            'B' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito' ],
            'O' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito' ],
            'D' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'syllabus' ],
            'L' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'syllabus', 'certprofesional' ],
        ];

        $documentosRequeridos = $documentosPorModalidad[$codigo] ?? [];

        return view('admision.validarDocs.revisionDocumentos', compact('postulante', 'documentosRequeridos', 'nombreModalidad'));
    }

    public function toggleBloqueo($id, $campo)
    {
        $permitidos = [
            'formulario', 'pago', 'constancia', 'constancianotas',
            'dni', 'seguro', 'certprofesional',
            'syllabus', 'merito'
        ];

        if (!in_array($campo, $permitidos)) {
            return back()->with('error', 'Campo no permitido.');
        }

        // Obtener al postulante
        $postulante = InfoPostulante::findOrFail($id);

        // Obtener o crear registro de control
        $registro = ControlDocumentos::firstOrCreate([
            'info_postulante_id' => $postulante->id
        ]);

        // Alternar estado
        $nuevoEstado = !$registro->$campo;
        $registro->$campo = $nuevoEstado;
        $registro->save();

        $comentario = request('observacion');

        // Registrar historial
        HistorialVerificacion::create([
            'info_postulante_id' => $postulante->id,
            'tabla' => 'control_documentos',
            'campo' => $campo,
            'estado' => $nuevoEstado,
            'observacion' => $comentario ?? ($nuevoEstado ? 'Se bloqueó luego de revisión manual' : 'Se desbloqueó por decisión del encargado'),
            'actualizado_por' => session('nombre_completo') ?? 'Admision',
            'cod_user' => session('cod_user') ?? '',
        ]);

        return back()->with('success', 'Estado de bloqueo actualizado correctamente.');
    }

}
