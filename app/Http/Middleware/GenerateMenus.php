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

        return $next($request);
    }
}
