<?php

namespace App\Mail;

use App\Models\Pedido;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ConfirmacionAdminDePedidoEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //se obtienen el ultimo
        $pedido = Pedido::latest()->first(); //TODO: cargar id de pedido en el constructor
        return $this->from('alonso.lopez.r@gmail.com')
            ->subject('Confirmamos tu PEDIDO ') //falta ID pedid
            ->view('pedidos.confirmacion_admin_email', compact('pedido'));
    }
}