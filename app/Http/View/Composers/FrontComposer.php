<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Config;

class FrontComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
      $configs = new \stdClass();
      $DBConfigs = Config::whereIn('index', ['site_name', 'logo', 'email', 'phone', 'description', 'instagram', 'facebook', 'youtube', 'pinterest', 'linkedin'])->get();

      foreach ($DBConfigs as $key => $config) {
        $configs->{$config->index} = $config;
      }

      $view->with('configs', $configs);
    }
}
