<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $appends = ['permission', 'avatar_url'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getPermissionAttribute()
    {
        return SiteUser::where('user_id', $this->id)->first();
    }

    public function getAvatarUrlAttribute()
    {
        if(is_null($this->avatar)) {
            return url('images/no-avatar.png');
        } else {
            return $this->avatar;
        }
    }
}
