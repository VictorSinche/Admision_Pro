<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CredencialesPostulanteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $nombres;
    public $usuario;
    public $password;
    public $correo;

    public function __construct($nombres, $usuario, $password, $correo)
    {
        $this->nombres  = $nombres;
        $this->usuario  = $usuario;
        $this->password = $password;
        $this->correo   = $correo;
    }

    public function build()
    {
        return $this->subject('Registro exitoso - Admisión UMA')
                    ->view('emails.credenciales');
    }
}
