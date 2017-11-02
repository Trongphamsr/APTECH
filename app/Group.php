<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $table='groups';

    protected $fillable=['id','name'];



    //public $timestamps= true;

    public  function user(){
        return $this->hasMany('App\Group');
    }

}
