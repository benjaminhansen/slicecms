<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    protected $appends = ['sites'];

    public function getSitesAttribute() 
    {
        return Site::where('organization_id', $this->id)->get();
    }
}
