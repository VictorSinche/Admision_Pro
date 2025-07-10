<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredencialesPostulanteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombres;
    public $dni;
    public $correo;

    public function __construct($nombres, $dni, $correo)
    {
        $this->nombres = $nombres;
        $this->dni = $dni;
        $this->correo = $correo;
    }

    public function build()
    {
        return $this->subject('Registro exitoso - Admisión UMA')
                    ->view('emails.credenciales');
    }
}
