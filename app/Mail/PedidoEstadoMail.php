<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoEstadoMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
    }

    public function envelope(): Envelope
    {
        $estadoTexto = '';
        switch($this->pedido->estado) {
            case 'pagado': $estadoTexto = 'Pagado'; break;
            case 'enviado': $estadoTexto = 'Enviado'; break;
            case 'entregado': $estadoTexto = 'Entregado'; break;
            case 'cancelado': $estadoTexto = 'Cancelado'; break;
            default: $estadoTexto = ucfirst($this->pedido->estado);
        }
        
        return new Envelope(
            subject: 'Actualización de tu Pedido #' . $this->pedido->numero_pedido . ' - ' . $estadoTexto,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido_estado',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}