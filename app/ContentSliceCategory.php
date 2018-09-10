<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentSliceCategory extends Model
{
    protected $appends = ['category'];

    public function getCategoryAttribute()
    {
        return Category::find($this->category_id);
    }
}
