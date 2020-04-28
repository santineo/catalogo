<?php
namespace App\Lib;

use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic;

class Image
{

  protected $image, $mime;

  public function __construct($image, $mime = 'jpg')
  {
    $this->image = ImageManagerStatic::make($image);
    $this->mime = $mime;
    $this->resize();
  }

  /**
  * If the size is more than 1920 this resize it
  *
  * @return void
  */
  public function resize()
  {
    if($this->image->width() > 1920)
    $this->image->resize(1920, null, function ($constraint) {
      $constraint->aspectRatio();
    });
  }

  /**
   * Set width on image and store
   *
   * @return void
   */
  public function store($path, $version = false)
  {
    if($version) $this->setVersionSize($version);
    Storage::put($path, $this->image->encode($this->mime)->__toString());
  }

  /**
  * Set width of image with version requested
  *
  * @return void
  */
  public function setVersionSize($size = -1)
  {
    $sizes = ['large' => 1024, 'thumb' => 250, 'small' => 45];
    if(!isset($sizes[$size])) return;
    $w = $h = null;
    $this->image->width() > $this->image->height() ? $w = $sizes[$size] : $h = $sizes[$size];
    $this->image->resize($w, $h, function ($constraint) {
      $constraint->aspectRatio();
    });

    if($this->image->width() != $this->image->height()) $this->image->resizeCanvas($sizes[$size], $sizes[$size]);
  }
}
