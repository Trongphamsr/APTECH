<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','group_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function product(){
        return $this->hasMany('App\Product');
    }

    public function group(){
        return $this->belongsTo('App\Group');
    }

    // tao public function de kt xem phai la admin hay k;

    public function isAdmin()
    {
        return ($this->group->id == '1') ? true : false;
        //return ($this->user->id == '10') ? true : false;
    }
}
