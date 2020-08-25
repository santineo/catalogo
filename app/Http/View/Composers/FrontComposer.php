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
      $DBConfigs = getConfigs(['site_name', 'logo', 'email', 'phone', 'description', 'instagram', 'facebook', 'youtube', 'pinterest', 'linkedin']);

      $view->with('configs', $configs);
    }
}
