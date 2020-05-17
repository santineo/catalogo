<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Button;

class Contact extends Model
{
  use Button;

    protected $guarded = [];

    /**
     * Get the route name
     *
     * @return string
     */
    public function getRouteName()
    {
      return 'contactos';
    }
}
