<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $touches = ['post'];

    public function user(){
        return $this->belongsTo('App\User', 'username');
    }
    public function post(){
        return $this->belongsTo('App\Post', 'post_id');
    }
}
