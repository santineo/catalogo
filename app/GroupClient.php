<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Button;

class GroupClient extends Model
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
      return 'grupos';
    }

    /**
     * Get the clients of the group
     *
     * @return collection of App\Client
     */
    public function clients()
    {
      return $this->belongsToMany('App\Client');
    }

    /**
     * Scope seearch
     *
     * @return builder
     */
    public function scopeSearch($query , $term = false)
    {
      if(!$term) return $query;

      return $query->where('name', 'like', "%$term%");
    }

    /**
     * Clients Counts
     *
     * @return integer
     */
    public function getClientsCountAttribute()
    {
      return $this->clients->count();
    }
}
