<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NavigationMenuItem extends Model
{
    protected $appends = ['attributes', 'children', 'parent'];

    public function getAttributesAttribute()
    {
        return NavigationMenuItemAttribute::where('navigation_menu_item_id', $this->id)->get();
    }

    public function getChildrenAttribute()
    {
        return self::where('parent_id', $this->id)->orderBy('order')->get();
    }

    public function hasChildren()
    {
        if($this->children->count()) {
            return true;
        } else {
            return false;
        }
    }

    public function getParentAttribute()
    {
        return self::find($this->parent_id);
    }
}
