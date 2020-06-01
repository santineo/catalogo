<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Button;

class Client extends Model
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
      return 'clientes';
    }

    /**
     * Get the Groups of this clients
     *
     * @return collection of App\GroupClient
     */
    public function groups()
    {
      return $this->belongsToMany('App\GroupClient');
    }

    /**
     * Scope seearch
     *
     * @return builder
     */
    public function scopeSearch($query , $term = false)
    {
      if(!$term) return $query;

      return $query->where('name', 'like', "%$term%")
                  ->orWhere('email', 'like', "%$term%")
                  ->orWhere('phone', 'like', "%$term%");
    }
}
