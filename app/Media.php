<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $appends = ['creator'];

    public function getCreatorAttribute()
    {
        return User::find($this->uploaded_by_id);
    }
}
