<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(['layouts.front', 'front.partials.nav', 'front.partials.footer', 'front.partials.social'], 'App\Http\View\Composers\FrontComposer');
        View::composer(['front.home.*'], 'App\Http\View\Composers\HomeComposer');
    }
}
