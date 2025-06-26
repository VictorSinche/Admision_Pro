<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappService
{
    protected $token = 'EAAKKeFEWmXcBOwwpx7hLxkK4nwIITXCGuc2zApIbZBaZBGVEPHpd00jhqisnW2ZBQ8josPsZBifZBkk59d9FOCCdeAT0hjGBxJKkUmbyXe7aQZCZBwLcsMuc1bYk7QTmdZBZBxTXuIp6uTEfhPabhTMsXyTCbEztCm9o8ZAeLFhuV2Ho2ZA9zRIIOkjZAFRY7syZAIZCOXhgZDZD';
    protected $phoneId = '708063022385698';

    public function enviarMensaje($telefono, $nombre, $documentos)
    {
        // Validaciones y valores por defecto
        if (empty($telefono)) {
            Log::warning('⚠️ Número de teléfono vacío, no se puede enviar el mensaje.');
            return;
        }

        if (empty($nombre)) {
            $nombre = 'Postulante';
        }

        if (empty($documentos)) {
            $documentos = ['documentos no especificados'];
        }

        $mensaje = implode(', ', $documentos);
        $url = "https://graph.facebook.com/v18.0/{$this->phoneId}/messages";

        // Log de datos antes del envío
        Log::info("📨 Preparando envío de WhatsApp a {$telefono}", [
            'nombre' => $nombre,
            'documentos' => $mensaje
        ]);

        // Enviar mensaje
        $response = Http::withToken($this->token)->post($url, [
            "messaging_product" => "whatsapp",
            "to" => $telefono,
            "type" => "template",
            "template" => [
                "name" => "documentos_rechazados",
                "language" => [ "code" => "es" ],
                "components" => [[
                    "type" => "body",
                    "parameters" => [
                        [ "type" => "text", "text" => $nombre ],
                        [ "type" => "text", "text" => $mensaje ]
                    ]
                ]]
            ]
        ]);

        // Log del resultado
        $result = $response->json();
        Log::info("📨 WhatsApp enviado a {$telefono}", $result);

        return $result;
    }
}
