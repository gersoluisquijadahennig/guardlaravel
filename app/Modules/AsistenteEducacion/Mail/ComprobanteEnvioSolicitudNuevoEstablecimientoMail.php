<?php

namespace App\Modules\AsistenteEducacion\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class ComprobanteEnvioSolicitudNuevoEstablecimientoMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public $solicitud
    )
    {
        $this->queue = 'cola-correos-solicitud-nuevo-establecimiento';
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->solicitud->correo_solicitante, $this->solicitud->nombre_solcitante),
            subject: 'Comprobante Envio Solicitud Nuevo Establecimiento '. $this->solicitud->nombre_establecimiento, 
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'asistenteEducacion::mail.correo-comprobante-envio-solicitud-nuevo-establecimiento',
            with: [
                'solicitud' => $this->solicitud,
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
