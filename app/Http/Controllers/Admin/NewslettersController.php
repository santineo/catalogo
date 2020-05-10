<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use Illuminate\Support\Facades\Mail;
use App\Mail\Newsletter as NewsletterMail;

class NewslettersController extends Controller
{

    /**
     * Create Newsletter & Send
     *
     * @return boolean
     */
    public function create()
    {
      return view('admin.newsletters.create');
    }

    /**
     * Retrieve email view
     *
     * @return view
     */
    public function preview()
    {
      return response()->json(['view' => view('emails.products', ['products' => Product::whereIn('id', request()->get('products', []))->get()])->render()], 200);
    }

    /**
     * Store Newsletter and Send
     *
     * @return response
     */
    public function store()
    {
      $sended = false;
      foreach (request()->get('emails', []) as $key => $email) {
        Mail::to($email)->send(new NewsletterMail(request()->get('products')), request()->get('subject'));
      }
      if(!Mail::failures()) $sended = true;
      return response()->json(compact('sended'), 200);
    }
}
