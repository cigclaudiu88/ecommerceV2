<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    // aici primim datele StripeController
    public $data;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // preluam in $order toate datele comenzii
        $order = $this->data;
        // returnam emailul cu datele comenzii de la adresa de email a utilizatorului
        // si returnam view-ul care contine datele comenzii
        return $this->from('no-reply@eshopupt.xyz')->view('mail.order_mail', compact('order'))->subject('Comanda de la eShop UPT');
    }
}