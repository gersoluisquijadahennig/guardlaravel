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

class PoliticaFirmaMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    public function __construct(
        public $asunto,
        public $emailTo,
        public $email,
        public $nombre,
        public $cargo,
        public $establecimiento,
        public $rutaArchivo = null,
        public $nombreArchivo = null,
        public $rutaArchivoComprobante = null,
        public $nombreArchivoComprobante = null,
     )
    {
        $this->queue = 'cola-correos-politicas'; // Se define la cola a la que se enviará el correo
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->email, $this->nombre),
            subject: $this->asunto,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        /**
         * vista notificacion de correo y comprobante
         */
        if (isset($this->rutaArchivo) && isset($this->nombreArchivo) && isset($this->rutaArchivoComprobante) && isset($this->nombreArchivoComprobante)) {
            return new Content(
                view: 'documentacion::mail.correo-confirmacion-politicas-comprobante',
                with: [
                    'email' => $this->email,
                    'nombre' => $this->nombre,
                    'cargo' => $this->cargo,
                    'establecimiento' => $this->establecimiento,
                ]
            );
        }
        /**
         * vista notificacion de correo
         */
        if (isset($this->rutaArchivo) && isset($this->nombreArchivo)) {
            return new Content(
                view: 'documentacion::mail.correo-confirmacion-politicas',
                with: [
                    'email' => $this->email,
                    'nombre' => $this->nombre,
                    'cargo' => $this->cargo,
                    'establecimiento' => $this->establecimiento,
                ]
            );
        }

        return new Content(
            view: 'documentacion::mail.default',
            with: [
                'email' => $this->email,
                'nombre' => $this->nombre,
                'cargo' => $this->cargo,
                'establecimiento' => $this->establecimiento,
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        $adjuntos = [];

        if (isset($this->rutaArchivo) && isset($this->nombreArchivo)) {
            //agregamos el archivo adjunto al arreglo
            $adjuntos[] = Attachment::fromStorage($this->rutaArchivo)->as($this->nombreArchivo)->withMime('application/pdf');
        }
        if (isset($this->rutaArchivoComprobante) && isset($this->nombreArchivoComprobante)) {
            $adjuntos[] = Attachment::fromStorage($this->rutaArchivoComprobante)->as($this->nombreArchivoComprobante)->withMime('application/pdf');
        }

        return $adjuntos;
    }
}
