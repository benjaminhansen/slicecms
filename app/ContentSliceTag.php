<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentSliceTag extends Model
{
    protected $appends = ['tag'];

    public function getTagAttribute()
    {
        return Tag::find($this->tag_id);
    }
}
