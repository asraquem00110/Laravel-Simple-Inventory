<?php

namespace App\Models\Client;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    public function inbound(){
    	return $this->hasMany('App\Models\Inbound\Inbound');
    }

     public function outbound(){
        return $this->hasMany('App\Models\Outbound\Outbound');
    }

     public function delivery(){
        return $this->hasMany('App\Models\Dispatch\Dispatch');
    }

    public function returns(){
        return $this->hasMany('App\Models\Return_\Return_');
    }

    public function scopeArchive($query){
    	return $query->Where('archive',1);
    }

    public function scopeActive($query){
    	return $query->Where('archive',0);
    }

    public function scopeSite($query){
    	return $query->Where('type',0);
    }

    public function scopeSupplier($query){
    	return $query->Where('type',1);
    }
}
