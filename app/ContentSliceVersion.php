<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentSliceVersion extends Model
{
    protected $appends = ['featured_media', 'creator'];

    public function getFeaturedMediaAttribute()
    {
        return Media::find($this->featured_media_id);
    }

    public function getCreatorAttribute()
    {
        return User::find($this->version_created_by_id);
    }
}
