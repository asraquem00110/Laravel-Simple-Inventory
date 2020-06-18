<?php

namespace App\Models\Inbound;

use Illuminate\Database\Eloquent\Model;

class Inbound extends Model
{
    public function temp(){
    	return $this->hasMany('App\Models\Temp\Temp');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User\User');
    }

    public function client(){
    	return $this->belongsTo('App\Models\Client\Client');
    }

    public function scopeApproved($query){
    	return $query->where('inbounds.status',1);
    }

    public function scopePending($query){
        return $query->where('inbounds.status',0);
    }
    public function itemlist(){
        return $this->hasMany('App\Models\ItemList\Itemlist');
    }
}
