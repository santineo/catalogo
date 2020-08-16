<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;
use App\Traits\Button;

class Category extends Model
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
      return 'categorias';
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
    public function scopeProductORder($query)
    {
      return $query->has('products')->withCount('products')->orderBy('products_count', 'desc');
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
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param string $attribute
     * @param array $config
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithUniqueSlugConstraints(Builder $query, Model $model, $attribute, $config, $slug)
    {
        $query->where('slug', $slug)->where('parent_id', $model->parent_id);
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
     * Return Admin Category path
     *
     * @return string
     */
    public function path()
    {
      return "/administracion/categorias/{$this->id}";
    }

    /**
     * Relationship with self - Parent
     *
     * @return App\Category::class or null
     */
    public function parent()
    {
      return $this->belongsTo('App\Category', 'parent_id');
    }

    /**
     * Relationship with self - Childs
     *
     * @return collection
     */
    public function childs()
    {
      return $this->hasMany('App\Category', 'parent_id');
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
