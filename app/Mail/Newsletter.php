<?php

namespace App\Mail;

use App\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newsletter extends Mailable
{
    use Queueable, SerializesModels;

    public $products;
    public $subject;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products, $subject = 'Catalogo de nuestras ofertas')
    {
        $this->products = Product::whereIn('id', $products)->get();
        $this->subject = $subject;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->from(env('APP_EMAIL_FROM', 'no-reply@catalogo.com'))->view('emails.products_v2')->with(['products' => $this->products]);
    }
}
