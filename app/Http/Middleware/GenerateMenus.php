<?php

namespace App\Http\Middleware;

use Closure;
use Menu;

class GenerateMenus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $active_menu = site()->active_navigation_menu;
        $parent_items = $active_menu->parent_items;
        $child_items = $active_menu->child_items;

        Menu::make('slice_navigation', function($menu) use ($active_menu, $parent_items, $child_items) {
            foreach($parent_items as $item) {
                $slug = str_slug($item->name);
                $attributes = [
                    'url' => $item->href
                ];

                foreach($item->attributes as $attribute) {
                    $attributes[str_slug($attribute->attribute)] = $attribute->value;
                }

                $menu->add($item->name, $attributes)->nickname($slug);
            }

            foreach($child_items as $child) {
                $slug = str_slug($child->parent->name);
                $attributes = [
                    'url' => $child->href,
                    'parent' => $menu->{$slug}->id
                ];

                foreach($child->attributes as $attribute) {
                    $attributes[str_slug($attribute->attribute)] = $attribute->value;
                }

                $menu->add($child->name, $attributes);
            }
        });

        return $next($request);
    }
}
