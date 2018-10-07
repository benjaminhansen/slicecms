<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Site;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!Request::is('slice/not-found') && !Request::is('slice/disabled')) {
            if(!app()->runningInConsole()) {
                $hostname = request()->getHost();

                $site = Site::where('uri', $hostname)->first();
                if(!$site) {
                    redirect('slice/not-found')->send();
                }

                if(!$site->enabled) {
                    redirect('slice/disabled')->send();
                }
                
                session()->put('site_id', $site->id);

                // register view namespace
                $assigned_theme_uri = site()->assigned_theme->uri;
                $theme_path = themes_path($assigned_theme_uri);
                $this->app['view']->addNamespace('theme', $theme_path);
            }
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
