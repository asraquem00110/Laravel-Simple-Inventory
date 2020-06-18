<?php

namespace App\Models\Return_;

use Illuminate\Database\Eloquent\Model;

class Return_ extends Model
{
	 protected $table = 'returns';
	
	 public function item(){
    	return $this->belongsToMany('App\Models\Item\Item')->withPivot('itemlist_id','qty','uom','created_at','updated_at');
    }

      public function returnitem(){
        return $this->hasMany('App\Models\Returnitems\returnitems','return_id');
    }

    public function scopePending($query){
    	return $query->where('status',0);
    }

    public function scopeApproved($query){
    	return $query->where('status',1);
    }

    public function user(){
    	return $this->belongsTo('App\Models\User\User');
    }

     public function client(){
    	return $this->belongsTo('App\Models\Client\Client');
    }

}