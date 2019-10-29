<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Product extends Model
{
    use Sluggable;

    protected $guarded = ['uploads'];

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    /**
     * Return Admin Product path
     *
     * @return string
     */
    public function path()
    {
      return "/administracion/productos/{$this->id}";
    }

    /**
     * Relationship with a brand
     *
     * @return Instance of App\Brand
     */
    public function brand()
    {
      return $this->belongsTo('App\Brand');
    }

    /**
     * Relationship with a category
     *
     * @return Instance of App\Category
     */
    public function category()
    {
      return $this->belongsTo('App\Category');
    }

    /**
     * Relationship with uploads
     *
     * @return collection
     */
    public function uploads()
    {
      return $this->morphMany('App\Upload', 'uploadable')->orderBy('order', 'ASC');
    }
}
