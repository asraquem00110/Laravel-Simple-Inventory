<?php

namespace App\Models\Dispatch;

use Illuminate\Database\Eloquent\Model;

class Dispatch extends Model
{
    // protected $table = "dispatchs";

    public function item(){
    	return $this->belongsToMany('App\Models\Item\Item')->withPivot('itemlist_id','qty','uom','created_at','updated_at');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User\User');
    }

     public function scopeApproved($query){
    	return $query->where('dispatches.status',1);
    }

    public function scopePending($query){
        return $query->where('dispatches.status',0);
    }

    public function scopeReject($query){
        return $query->where('dispatches.status',2);
    }

    public function client(){
        return $this->belongsTo('App\Models\Client\Client');
    }

    public function dispatchitem(){
        return $this->hasMany('App\Models\DispatchItems\dispatchitem');
    }

}
