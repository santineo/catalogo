<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Config;

class HomeComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
      $home = getConfigs(['category_1', 'category_image_1', 'category_2', 'category_image_2', 'slider_title', 'slider_image', 'slider_button_link', 'slider_button_text']);

      $view->with('home', $home);
    }
}
