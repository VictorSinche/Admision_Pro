<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\InfoPostulante;

class RechazoDocumentosPostulante extends Mailable
{
    use Queueable, SerializesModels;

    public $postulante;
    public $motivo;
    public $documentos;
    public $estados;
    public $todosLosCampos;

    public function __construct(InfoPostulante $postulante, $motivo = '', $documentos = [], $estados = [], $todosLosCampos = [])
    {
        $this->postulante = $postulante;
        $this->motivo = $motivo;
        $this->documentos = $documentos;
        $this->estados = $estados;
        $this->todosLosCampos = $todosLosCampos;
    }

    public function build()
    {
        return $this->subject('Observaciones sobre tus documentos de admisión')
            ->view('emails.rechazo_documentos')
            ->cc(['sinchevictorhugo@gmail.com', 'vitosh2911@gmail.com'])
            // ->cc(['admision@uma.edu.pe', 'helpdesk@uma.edu.pe'])
            ->with([
                'postulante' => $this->postulante,
                'motivo' => $this->motivo,
                'documentos' => $this->documentos,
                'estados' => $this->estados, // este es el array de estado reales
                'todosLosCampos' => $this->todosLosCampos,
            ]);
    }
}
