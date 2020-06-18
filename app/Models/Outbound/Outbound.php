<?php

namespace App\Models\Outbound;

use Illuminate\Database\Eloquent\Model;

class Outbound extends Model
{
   public function outbounditems(){
        return $this->hasMany('App\Models\Outbounditems\Outbounditems');
    }

    public function scopeApproved($query){
    	return $query->where('outbounds.status',1);
    }

    public function scopePending($query){
        return $query->where('outbounds.status',0);
    }

    public function scopeReject($query){
        return $query->where('outbounds.status',2);
    }

     public function user(){
    	return $this->belongsTo('App\Models\User\User');
    }

    public function client(){
    	return $this->belongsTo('App\Models\Client\Client');
    }

     public function item(){
        return $this->belongsToMany('App\Models\Item\Item','outbounditems')->withPivot('itemlist_id','quantity','remarks','created_at');
    }
}
