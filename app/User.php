<?php

namespace Anbiotek;

use Illuminate\Notifications\Notifiable;
// use Illuminate\Foundation\Auth\User as Authenticatable;
use Cartalyst\Sentinel\Users\EloquentUser as Authenticate;

class User extends Authenticate
{
    // use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

     protected $table = 'users';

    protected $fillable = [
        'email', 'password', 'first_name', 'last_name', 'last_login'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function masuk()
    {
        return $this->hasMany('Anbiotek\Masuk','user_id', 'id');
    }

    public function keluar()
    {
        return $this->hasMany('Anbiotek\Keluar','user_id', 'id');
    }

    public function blog()
    {
        return $this->hasMany('Anbiotek\Blog', 'user_id', 'id');
    }
}
