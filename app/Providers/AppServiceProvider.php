<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Site;
use Request;
use Menu;

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

                // register navigation menus
                $available_menus = site()->navigation_menus;

                foreach($available_menus as $this_menu) {
                    $parent_items = $this_menu->parent_items;
                    $child_items = $this_menu->child_items;

                    Menu::make($this_menu->slug, function($menu) use ($parent_items, $child_items) {
                        foreach($parent_items as $item) {
                            $slug = str_slug($item->name);
                            $attributes = [
                                'url' => $item->href
                            ];

                            foreach($item->attributes as $attribute) {
                                $attributes[str_slug($attribute->attribute)] = $attribute->value;
                            }

                            $menu->add($item->name, $attributes)->id($item->id);
                        }

                        foreach($child_items as $child) {
                            $attributes = [
                                'url' => $child->href,
                                'parent' => $child->parent->id
                            ];

                            foreach($child->attributes as $attribute) {
                                $attributes[str_slug($attribute->attribute)] = $attribute->value;
                            }

                            $menu->add($child->name, $attributes)->id($child->id);
                        }
                    });
                }
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
