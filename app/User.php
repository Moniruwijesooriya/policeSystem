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
        'name', 'email', 'password','nic','address','mobileNumber','landLineNumber','profession','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        if($this->role=='admin'){
            return true;
        }
        return false;
    }

    public function isIGP(){
        if($this->role=='Inspector General of Police'){
            return true;
        }
        return false;
    }

    public function isCitizen(){
        if($this->role=='citizen' AND $this->verified=='y'){
            return true;
        }
        return false;
    }
}
