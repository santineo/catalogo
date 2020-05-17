<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
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
