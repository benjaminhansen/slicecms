<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContentSlice extends Model
{
    protected $appends = ['versions', 'creator', 'last_updater', 'featured_media', 'tags', 'categories', 'slice_type', 'full_uri', 'full_url'];

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

    public function getFullUriAttribute()
    {
        $slice_uri = $this->uri;
        $slice_type_uri = $this->slice_type->uri;
        $slice_function = $this->slice_type->slice_function;
        if($slice_function == "news") {
            $date = strtotime($this->created_at);
            $year = date("Y", $date);
            $month = date("M", $date);
            $day = date("D", $date);

            return "$slice_type_uri/$year/$month/$day/$slice_uri";
        } else {
            if($slice_uri == "/") {
                return $slice_uri;
            } else {
                return "$slice_type_uri/$slice_uri";
            }
        }
    }

    public function getFullUrlAttribute()
    {
        return url($this->full_uri);
    }
}
