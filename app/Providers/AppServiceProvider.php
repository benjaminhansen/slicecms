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
            $subdomain = $parts[0];

            if(env('APP_ENABLE_SUBDOMAIN_CHECK')) {
                $site = Site::where('uri', $subdomain)->first();
                if(!$site) {
                    return die("Site [$hostname] was not found!");
                }

                if(!$site->organization->enabled) {
                    return die("This site's organization has been disabled!");
                }

                if(!$site->enabled) {
                    return die("This site has been disabled!");
                }

                session()->put('site_id', $site->id);
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
