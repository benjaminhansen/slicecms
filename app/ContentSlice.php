<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentSlice extends Model
{
    protected $appends = ['versions', 'creator', 'last_updater', 'featured_media', 'tags', 'categories', 'slice_type'];

    public function getVersionsAttribute()
    {
        return ContentSliceVersion::where('slice_id', $this->id)->get();
    }

    public function getCreatorAttribute()
    {
        return User::find($this->created_by_id);
    }

    public function getLastUpdaterAttribute()
    {
        return User::find($this->last_updated_by_id);
    }

    public function getFeaturedMediaAttribute()
    {
        return Media::find($this->featured_media_id);
    }

    public function getTagsAttribute()
    {
        return ContentSliceTag::where('content_slice_id', $this->id)->get();
    }

    public function getCategoriesAttribute()
    {
        return ContentSliceCategory::where('slice_id', $this->id)->get();
    }

    public function getSliceTypeAttribute()
    {
        return ContentSliceType::find($this->content_slice_type_id);
    }
}
