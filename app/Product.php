<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\Button;

class Product extends Model
{
    use Sluggable, Button;

    protected $guarded = ['uploads'];

    protected $appends = ['price_type', 'image'];

    /**
     * Get the route name
     *
     * @return string
     */
    public function getRouteName()
    {
      return 'productos';
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
                'source' => 'title'
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

      return $query->where('title', 'like', '%' . $term . '%')->orWhere('id', $term);
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
     * Accesor to Selling Type Formatted
     *
     * @return string
     */
    public function getPriceTypeAttribute()
    {
      switch ($this->selling_type) {
        case 1:
          return 'Unidad';
        break;

        case 2:
          return 'Kilo';
        break;
      }
    }

    /**
     * Accesor to Get first upload
     *
     * @return Intance of Upload or null
     */
    public function getImageAttribute()
    {
      return $this->uploads->first();
    }

    /**
     * Accesor to Order Stock Available
     *
     * @return int
     */
    public function getAvailableStockAttribute()
    {
      if(!$this->pivot) return $this->stock;
      return $this->stock + $this->pivot->quantity;
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
