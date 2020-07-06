<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use App\Lib\Image;

class Upload extends Model
{

  protected $guarded = [];

  protected $appends = ['url', 'thumb', 'small', 'large'];

  /**
  *
  * Model Boot
  *
  **/
  public static function boot() {

    parent::boot();

    static::deleting(function($item) {
      Storage::delete([$item->doPath(), $item->doPath('large'), $item->doPath('thumb'), $item->doPath('small')]);
    });

  }

  /**
  *  Accesor to get upload original URL
  *
  *  @return string
  */
  public function getUrlAttribute()
  {
    return $this->doUrl();
  }

  /**
  * Accesor to get upload Large URL
  *
  * @return string
  */
  public function getLargeAttribute()
  {
    return $this->type == 'image' ? $this->doUrl('large') : '';
  }

  /**
  * Accesor to get upload Thumb URL
  *
  * @return string
  */
  public function getThumbAttribute()
  {
    return $this->type == 'image' ? $this->doUrl('thumb') : '';
  }

  /**
  * Accesor to get upload Small URL
  *
  * @return string
  */
  public function getSmallAttribute()
  {
    return $this->type == 'image' ? $this->doUrl('small') : '';
  }

  /**
  * Remove all uploads where not in the array
  *
  * @return void
  */
  public function scopeCleanNotIn($query, $ids)
  {
    if(!is_array($ids)) return $query;

    return $query->whereNotIn('id', $ids)->delete();
  }

  /**
  * This construct the browser Url
  *
  * @return string
  */
  public function doUrl($extension = '')
  {
    return asset("storage/{$this->doPath($extension)}");
  }

  /**
  * This construct full path of the upload
  *
  * @return string
  */
  public function doPath($extension = '')
  {
    if($extension) $extension = '_' . $extension;
    return "{$this->path}/{$this->name}{$extension}.{$this->extension}";
  }


  /**
  * Store images and version of self
  *
  * @return void
  */
  public function storeImage($file, $path = 'images')
  {
    $this->type = 'image';
    $this->path = $path;
    $this->extension = 'png';
    $this->order = 0;
    $this->setName(Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)));

    $image = new Image($file);

    if(!Storage::exists($this->path)) Storage::makeDirectory($this->path);

    // order from highest to lowest sizes
    $image->store($this->doPath());
    $image->store($this->doPath('large'), 'large');
    $image->store($this->doPath('thumb'), 'thumb');
    $image->store($this->doPath('small'), 'small');
  }


  /**
  * Check if the file exist and add suffix if exists
  *
  * @return void
  */
  public function setName($name, $additional = 0)
  {
    $stringAdd = $additional ? "-{$additional}" : '';
    $newName = $name . $stringAdd;
    if(Storage::exists("{$this->path}/{$newName}.{$this->extension}")){
      $this->setName($name, $additional + 1);
    }else{
      $this->name = $newName;
    }
  }

}
