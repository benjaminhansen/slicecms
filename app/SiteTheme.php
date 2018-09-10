<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteTheme extends Model
{
    protected $appends = ['theme'];

    public function getThemeAttribute()
    {
        return Theme::find($this->theme_id);
    }
}
