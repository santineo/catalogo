<?php
namespace App\Traits;

trait Button
{

  /**
   * Get the editable button
   *
   * @¶eturn string
   */
  public function getShowButtonAttribute()
  {
    return '<show-button :url="\'' . route("{$this->getRouteName()}.show", $this->id) .  '\'"></show-button>';
  }

  /**
   * Get the editable button
   *
   * @¶eturn string
   */
  public function getEditButtonAttribute()
  {
    return '<edit-button :url="\'' . route("{$this->getRouteName()}.edit", $this->id) .  '\'"></edit-button>';
  }

  /**
   * Get the delete button
   *
   * @¶eturn string
   */
  public function getDeleteButtonAttribute()
  {
    return '<delete-button :url="\'' . route("{$this->getRouteName()}.destroy", $this->id) .  '\'"></delete-button>';
  }

}
