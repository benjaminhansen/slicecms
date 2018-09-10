<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Site;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if(!app()->runningInConsole()) {
            $hostname = request()->getHost();
            $parts = explode(".", $hostname);

            if(count($parts) == 2) {
                $subdomain = $hostname;
            } else {
                $subdomain = $parts[0];
            }

            $site = Site::where('uri', $subdomain)->first();
            if(!$site) {
                $message = "Site [$hostname] was not found!";
                return die($message);
            }

            if(!$site->enabled) {
                $message = "This site has been disabled!";
                return die($message);
            }

            session()->put('site_id', $site->id);

            // register view namespace
            $assigned_theme_uri = site()->assigned_theme->uri;
            $theme_path = themes_path($assigned_theme_uri);
            $this->app['view']->addNamespace('theme', $theme_path);
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
