<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $appends = ['users', 'media', 'tags', 'categories', 'content_slices', 'assigned_theme', 'themes', 'settings', 'organization'];

    public function getUsersAttribute() 
    {
        return SiteUser::where('site_id', $this->id)->get();
    }

    public function getMediaAttribute() 
    {
        return Media::where('site_id', $this->id)->get();
    }

    public function getTagsAttribute() 
    {
        return Tag::where('site_id', $this->id)->get();
    }

    public function getCategoriesAttribute() 
    {
        return Category::where('site_id', $this->id)->get();
    }

    public function getContentSlicesAttribute() 
    {
        return ContentSlice::where('site_id', $this->id)->get();
    }

    public function getThemesAttribute() 
    {
        return Theme::where('site_id', $this->id)->get();
    }

    public function getAssignedThemeAttribute() 
    {
        return Theme::find($this->theme_id);
    }

    public function getSettingsAttribute() 
    {
        return SiteSetting::where('site_id', $this->id)->get();
    }

    public function getOrganizationAttribute() 
    {
        return Organization::find($this->organization_id);
    }
}
