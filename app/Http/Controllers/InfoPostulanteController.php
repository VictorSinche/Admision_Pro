<?php

namespace App\Http\Controllers;

use App\Models\InfoPostulante;
use App\Models\ModalidadIngreso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

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

            Log::info('📥 Postulante validado:', $validated);

            InfoPostulante::create([
                ...$validated,
                'estado' => 1,
                'fecha_confirmacion' => now(),
            ]);

            return response()->json(['message' => '✅ Registro completado correctamente.']);
        } catch (ValidationException $e) {
            return response()->json(['errors' => $e->errors()], 422);
        } catch (\Exception $e) {
            Log::error("❌ Error al guardar postulante: " . $e->getMessage());

            return response()->json([
                'message' => 'Ocurrió un error al guardar el postulante.'
            ], 500);
        }
    }

    public function mostrarFormulario()
    {
        $modalidades = ModalidadIngreso::all(); // Carga las modalidades
        return view('student.registro', compact('modalidades'));
    }
}
