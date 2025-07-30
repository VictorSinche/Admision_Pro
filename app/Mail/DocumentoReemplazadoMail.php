<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DocumentoReemplazadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $postulante;
    public $campo;
    public $nombreArchivo;

    public function __construct($postulante, $campo, $nombreArchivo)
    {
        $this->postulante = $postulante;
        $this->campo = $campo;
        $this->nombreArchivo = $nombreArchivo;
    }

    public function build()
    {
        return $this->subject("📄 Documento Reemplazado por {$this->postulante->c_numdoc}")
            ->view('emails.documento_reemplazado')
            ->cc([
                'sinchevictorhugo@gmail.com',
                'vitosh2911@gmail.com',
                // 'admision@uma.edu.pe',
                // 'helpdesk@uma.edu.pe',
            ]);
    }
}
