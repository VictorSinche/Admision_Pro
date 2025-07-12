<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InfoPostulante;
use App\Services\WhatsappService;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use App\Mail\RechazoDocumentosPostulante;

class NotificacionController extends Controller
{
public function rechazoDocumentos(Request $request)
{
    $request->validate([
        'dni' => 'required|string',
        'documentos' => 'required|array|min:1',
        'motivo' => 'nullable|string',
    ]);

    try {
        $postulante = InfoPostulante::where('c_numdoc', $request->dni)->firstOrFail();

        $todosLosCampos = ['formulario', 'pago', 'dni', 'seguro', 'dj'];
        $verificacion = $postulante->verificacion;
        $estados = [];

        foreach ($todosLosCampos as $campo) {
            $valor = $verificacion ? $verificacion->$campo : null;

            if ($valor === 0) {
                $estados[$campo] = 0; // No enviado
            } elseif ($valor === 1) {
                $estados[$campo] = 1; // Inválido
            } elseif ($valor === 2) {
                $estados[$campo] = 2; // Válido
            } else {
                $estados[$campo] = 0;
            }
        }

        // Enviar correo
        Mail::to($postulante->c_email)->send(new RechazoDocumentosPostulante(
            $postulante,
            $request->motivo ?? '',
            $request->documentos,
            $estados,
            $todosLosCampos
        ));

        // Enviar WhatsApp
        if ($postulante->c_celu) {
            $telefono = '51' . preg_replace('/[^0-9]/', '', $postulante->c_celu);
            $nombre = $postulante->c_nombre;
            $documentos = $request->documentos ?? [];

            $whatsapp = new WhatsappService();
            $whatsapp->enviarMensaje($telefono, $nombre, $documentos);
        }

        // Marcar como notificado
        if ($verificacion) {
            $verificacion->notificado = true;
            $verificacion->save();
        } else {
            $postulante->verificacion()->create([
                'notificado' => true,
            ]);
        }

        return response()->json(['message' => 'Correo enviado exitosamente']);
    } catch (\Exception $e) {
        Log::error("❌ Error al enviar notificación: " . $e->getMessage());
        return response()->json(['message' => 'Error al enviar notificación'], 500);
    }
}
    public function resetNotificacion(Request $request)
    {
        $dni = session('c_numdoc');
        
        if (!$dni) {
            return response()->json(['message' => 'Sesión no válida'], 401);
        }

        $postulante = InfoPostulante::where('c_numdoc', $dni)->first();

        if ($postulante && $postulante->verificacion) {
            $postulante->verificacion->update(['notificado' => 0]);
            return response()->json(['message' => 'Notificación reseteada']);
        }

        return response()->json(['message' => 'Postulante o verificación no encontrada'], 404);
    }

}
