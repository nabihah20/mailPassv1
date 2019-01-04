<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
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
        'name', 'email', 'password','provider', 'provider_id', 'phoneNo', 'type2FA',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function sentEmail(){
        return $this ->hasMany('jdavidbakr\MailTracker\Model\SentEmail');
    }

    public function passwordSecurity()
    {
        return $this->hasOne('App\PasswordSecurity');
    }

    public function file(){
        return $this ->hasMany('App\File');
    }
}
