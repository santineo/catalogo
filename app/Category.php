<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Builder;

class Category extends Model
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
