<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Traits\Button;

class Product extends Model
{
    use Sluggable, Button;

    protected $guarded = ['uploads'];

    protected $appends = ['price_type', 'image', 'public_path'];

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
     * Scope to search products by related products arguments
     *
     * @return Builder
     */
    public function scopeSearch($query, $term = false)
    {
      if(!$term) return $query;

      return $query->where('title', 'like', '%' . $term . '%')
                   ->orWhere('id', $term)
                   ->orWhereHas('category', function($query) use($term){
                     return $query->where('name', 'like', '%' . $term . '%');
                   })
                   ->orWhereHas('brand', function($query) use($term){
                     return $query->where('name', 'like', '%' . $term . '%');
                   });
    }

    /**
     * Scope to search products by category id
     *
     * @return Builder
     */
    public function scopeCategory($query, $categoryId = false)
    {
      if(!$categoryId) return $query;

      return $query->where('category_id', $categoryId);
    }

    /**
     * Scope to get most sellers products (more count of orders)
     *
     * @return Builder
     */
    public function scopeMostSeller($query, $take = 4)
    {
      return $query->withCount('orders')->take($take)->orderBy('orders_count', 'desc');
    }

    /**
     * Scope to search products by slug
     *
     * @return Builder
     */
    public function scopeSlug($query, $slug = false)
    {
      if(!$slug) return abort(404);

      return $query->where('slug', $slug);
    }

    /**
     * Scope to filter if have stock or not validate it
     *
     * @return Builder
     */
    public function scopeWithStock($query)
    {
      return $query->where('validate_stock', 0)->orWhere(function($query){
        return $query->where('validate_stock', 1)->where('stock', '>', '0');
      });
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
     * Return Front Product path
     *
     * @return string
     */
    public function getPublicPathAttribute()
    {
      return route('front.products.show', $this->slug);
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
     * Relationship with a orders
     *
     * @return collection with App\Order
     */
    public function orders()
    {
      return $this->belongsToMany('App\Order');
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

    /**
     * Returns Primary Product Image or default Image URL
     *
     * @return string
     */
    public function getPrimaryImage($size = 'url')
    {
      return $this->image ? $this->image->{$size} : asset("/images/no-product-image" . ($size != 'url' ? "_$size" : '') . ".png");
    }

    /**
     * Return unity type
     *
     * @return string
     */
    public function getQuantityLabelUnity($quantity = 1)
    {
      $unity = 'Unidad' . ($quantity > 1 ? 'es' : '');
      return $this->selling_type == 1 ? $unity : 'grs.';
    }
}
