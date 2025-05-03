<?php

namespace App\Http\Controllers;

use App\Models\InfoPostulante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class InfoPostulanteController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'tipo_documento'       => 'required|string',
                'numero_documento'     => 'required|string|unique:info_postulante,numero_documento',
                'nombres'              => 'required|string',
                'apellido_paterno'     => 'required|string',
                'apellido_materno'     => 'required|string',
                'correo'               => 'nullable|email',
                'celular'              => 'nullable|string',
                'modalidad_ingreso_id' => 'required|integer',
                'programa_interes'     => 'required|integer',
                'proceso_admision'     => 'required|integer',
                'sede'                 => 'nullable|integer',
            ]);

            // Log opcional para confirmar lo que llega
            Log::info('📥 Postulante validado:', $validated);

            // Guardar
            InfoPostulante::create([
                ...$validated,
                'estado' => 1,
                'fecha_confirmacion' => now(),
            ]);

            return redirect('/registro')->with('success', '✅ Registro completado correctamente');

        } catch (\Exception $e) {
            Log::error("❌ Error al guardar postulante: " . $e->getMessage());
            return back()->with('error', 'Ocurrió un error al registrar el postulante');
        }
    }
}
