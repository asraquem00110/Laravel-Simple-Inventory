<?php

namespace App\Models\User;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function inbounds(){
        return $this->hasMany('App\Models\Inbound\Inbound');
    }

    public function scopeActive($query){
        $query->where('archive',0);
    }


    public function scopeArchive($query){
        $query->where('archive',1);
    }

    public function dispatch(){
        return $this->hasMany('App\Models\Dispatch\Dispatch');
    }

    public function returns(){
        return $this->hasMany('App\Models\Return_\Return_');
    }

}
