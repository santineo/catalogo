<?php

namespace App;

use App\Category;
use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $guarded = [];

    protected $appends = ['image'];

    protected $with = ['uploads'];

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
     * Returns Primary Image or false
     *
     * @return string
     */
    public function getImageAttribute()
    {
      return $this->uploads->first() ? $this->uploads->first()->url : false;
    }

    /**
     * Return Category if exists
     *
     * @return category
     */
    public function getCategory()
    {
      return Category::find($this->value);
    }
}
