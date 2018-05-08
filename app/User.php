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
     * @var arrayp
     */
    protected $fillable = [
        'name', 'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function profileinfo(){
        return $this->hasOne('App\Profileinfo', 'username', 'username');
    }

//    public function getFullName()
//    {
//        return $this->first_name . ' ' . $this->last_name;
//    }

    public function friends()
    {
        return $this->belongsToMany('User', 'follows', 'email', 'follows_email');
    }

    public function addFriend(User $user)
    {
        $this->friends()->attach($user->id);
    }

    public function removeFriend(User $user)
    {
        $this->friends()->detach($user->id);
    }

    public function verifyUser()
    {
        return $this->hasOne('App\VerifyUser');
    }

    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }
}
