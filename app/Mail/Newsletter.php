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
    public $validDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($products, $subject = 'Catalogo de nuestras ofertas', $validDate = false)
    {
        $this->products = Product::whereIn('id', $products)->get();
        $this->subject = $subject;
        $this->validDate = $validDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

      $config = getConfigs(['site_name', 'logo', 'email', 'phone', 'description', 'instagram', 'facebook', 'youtube', 'pinterest', 'linkedin', 'twitter', 'slider_image']);

        return $this->subject($this->subject)->from(env('APP_EMAIL_FROM', 'no-reply@catalogo.com'))->view('emails.products')->with([
          'products' => $this->products,
          'siteName' => $config->site_name->value,
          'siteUrl' => route('home'),
          'bannerImage' => $config->slider_image->image,
          'validDate' => $this->validDate,
          'urlUnsuscribe' => '#',
          'facebook' => $config->facebook->value,
          'instagram' => $config->instagram->value,
          'twitter' => $config->twitter->value,
          'linkedin' => $config->linkedin->value,
          'youtube' => $config->youtube->value,
          'products' => $this->products
        ]);
    }
}
