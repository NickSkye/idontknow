<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profileinfo extends Model
{

    //defines table to use name in db
    protected $table = 'profileinfo';


    public function getProfileInfo(){
        return $this->belongsTo('App\User');
    }


}
