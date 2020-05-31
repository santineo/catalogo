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
      $home = new \stdClass();
      $homeAttributes = ['category_1', 'category_image_1', 'category_2', 'category_image_2', 'category_3', 'category_image_3', 'category_4', 'category_image_4'];
      $DBConfigs = Config::whereIn('index', $homeAttributes)->get();

      foreach ($homeAttributes as $key => $index) {
        $home->{$index} = $DBConfigs->firstWhere('index', $index) ?? new Config();
      }

      $view->with('home', $home);
    }
}
