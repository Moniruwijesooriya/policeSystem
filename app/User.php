<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;


/*
 *********************************************
 **************** USER MODEL *****************
 *********************************************
 */


class User extends Authenticatable implements MustVerifyEmail
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
        if($this->role=='citizen' AND $this->verified=='Yes'){
            return true;
        }
        return false;
    }

    public function isOIC(){
        if($this->role=='Officer Incharge of Police Station'){
            return true;
        }
        return false;
    }
    public function isBOIC(){
        if($this->role=='Branch Officer Incharge'){
            return true;
        }
        return false;
    }
    public function isDOIG(){
        if($this->role=='Division Officer Incharge'){
            return true;
        }
        return false;
    }
}
