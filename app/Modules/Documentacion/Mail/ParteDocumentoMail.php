<?php

namespace App\Modules\Documentacion\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ParteDocumentoMail extends Mailable implements ShouldQueue //recordar que se implementaron colas para este ejemplo
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     * envoltura de mensaje
     * @param string $asunto
     * @param string $emailTo
     * @param string $email
     * contenido del mensaje
     * @param string $autofolio
     * @param string $nombre
     * @param string $instituicion
     * @param string $destinos
     * @param string $observaciones
     * @param array $archivos
     * @param number $cantidad_archivos
     * archivos adjuntos

     * 
     * @return void
     * 
     * 
     */
    public function __construct(
        public $asunto,
        public $emailTo,
        public $email,
        
        public $autofolio,
        public $nombre,
        public $institucion_origen,
        public $destinos,
        public $observaciones,
        public $archivos = [],
        public $cantidad_archivos
        

     )
    {
        //
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email, $this->nombre),
            subject: $this->asunto,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'documentacion::mail.correo-comprobante-envio-parte',
            with: [
                'autofolio' => $this->autofolio,
                'nombre' => $this->nombre,
                'instituicion_origen' => $this->institucion_origen,
                'destinos' => $this->destinos,
                'observaciones' => $this->observaciones,
                'archivos' => $this->archivos,
                'cantidad_archivos' => $this->cantidad_archivos

            ]
        );
    }

    /*public function attachments(): array
    {
        $archivosAdjuntos = []; // Este array almacenará los archivos adjuntos

        // Supongamos que tienes un array $archivosGuardados que contiene los archivos guardados
        foreach ($archivosGuardados as $archivo) {
            $archivosAdjuntos[] = [
                'nombre' => $archivo['nombre'],
                'ruta' => storage_path('app/public/' . $archivo['ruta'])
            ];
        }

        return $archivosAdjuntos;
    }*/
}
