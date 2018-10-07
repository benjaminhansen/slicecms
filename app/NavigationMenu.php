<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationMenu extends Model
{
    protected $appends = ['items', 'parent_items', 'child_items'];

    public function getItemsAttribute()
    {
        $items = NavigationMenuItem::where('navigation_menu_id', $this->id)->orderBy('order')->get();
        if(is_null($items)) {
            return [];
        } else {
            return $items;
        }
    }

    public function getParentItemsAttribute()
    {
        $items = NavigationMenuItem::whereNull('parent_id')->where('navigation_menu_id', $this->id)->orderBy('order')->get();
        if(is_null($items)) {
            return [];
        } else {
            return $items;
        }
    }

    public function getChildItemsAttribute()
    {
        $items = NavigationMenuItem::whereNotNull('parent_id')->where('navigation_menu_id', $this->id)->orderBy('order')->get();
        if(is_null($items)) {
            return [];
        } else {
            return $items;
        }
    }
}
