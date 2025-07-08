<?php

namespace App\Http\Controllers;

use App\Models\ControlDocumentos;
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
            'E' => 'Admisión para Técnicos',
            'C' => 'Admisión Pre-UMA',
        ][$codigo] ?? 'Desconocida';

        // Mapeo de modalidad a documentos
        $documentosPorModalidad = [
            'A' => ['formulario', 'pago', 'seguro', 'dni', 'constancia' ],
            'C' => ['formulario', 'pago', 'seguro', 'dni', 'constancia' ],
            'B' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito' ],
            'O' => ['formulario', 'pago', 'seguro', 'dni', 'constancia', 'merito' ],
            'D' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'constmatricula', 'syllabus' ],
            'E' => ['formulario', 'pago', 'seguro', 'dni', 'constancianotas', 'constmatricula', 'syllabus', 'certprofesional' ],
        ];

        $documentosRequeridos = $documentosPorModalidad[$codigo] ?? [];

        return view('admision.validarDocs.revisionDocumentos', compact('postulante', 'documentosRequeridos', 'nombreModalidad'));
    }

    public function toggleBloqueo($id, $campo)
    {
        $permitidos = [
            'formulario', 'pago', 'constancia', 'constancianotas',
            'dni', 'seguro', 'constmatricula', 'certprofesional',
            'syllabus', 'merito'
        ];

        if (!in_array($campo, $permitidos)) {
            return back()->with('error', 'Campo no permitido.');
        }

        $registro = ControlDocumentos::firstOrCreate(['info_postulante_id' => $id]);
        $registro->$campo = !$registro->$campo;
        $registro->save();

        return back()->with('success', 'Estado de bloqueo actualizado correctamente.');
    }
}
