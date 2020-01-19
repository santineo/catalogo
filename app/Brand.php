<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\Button;

class Brand extends Model
{
    use Sluggable, Button;

    protected $fillable = ['name'];

    /**
     * Get the route name
     *
     * @return string
     */
    public function getRouteName()
    {
      return 'marcas';
    }

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
     * Scope to search products by title
     *
     * @return Builder
     */
    public function scopeSearch($query, $term = false)
    {
      if(!$term) return $query;

      return $query->where('name', 'like', '%' . $term . '%');
    }

    /**
     * Product Counts
     *
     * @return integer
     */
    public function getProductsCountAttribute()
    {
      return $this->products->count();
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

    /**
     * Relationship with products
     *
     * @return collection of Products
     */
    public function products()
    {
      return $this->hasMany('App\Product');
    }

}
