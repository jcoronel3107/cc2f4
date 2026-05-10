<?php

namespace App\Mail;

use App\Models\Pedido;
use App\Helpers\BankHelper;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PedidoConfirmacionMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pedido;
    public $bankInfo;

    public function __construct(Pedido $pedido)
    {
        $this->pedido = $pedido;
        $this->bankInfo = BankHelper::getBankInfo();
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Confirmación de tu Pedido #' . $this->pedido->numero_pedido,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.pedido_confirmacion',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}