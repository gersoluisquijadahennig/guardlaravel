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
        public $cantidad_archivos,

        public $rutaArchivo = null,
        public $notificacionAdministrador = false,
        
     )
    {
        $this->queue = 'cola-correos-parte'; // Se define la cola a la que se enviará el correo
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
        if($this->notificacionAdministrador == true){
            return new Content(
                view: 'documentacion::mail.correo-notificacion-administrador-envio-parte',
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
        }else{
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
