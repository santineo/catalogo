<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Brand extends Model
{
      use Sluggable;

      protected $fillable = ['name'];

      /**
       * Return the sluggable configuration array for this model.
       *
       * @return array
       */
      public function sluggable()
      {
          return [
              'slug' => [
                  'source' => 'name'
              ]
          ];
      }


      /**
       * Return Admin Brand path
       *
       * @return string
       */
      public function path()
      {
        return "/administracion/marcas/{$this->id}";
      }
}
