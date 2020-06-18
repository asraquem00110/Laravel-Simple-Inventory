<?php

namespace App\Models\Temp;

use Illuminate\Database\Eloquent\Model;

class Temp extends Model
{

	protected $fillable = [
		'inbound_id',
		'item_id',
		'hasbarcode',
		'quantity',
		'remarks',
	];
    
    public function inbound(){
    	return $this->belongsTo('App\Models\Inbound\inbound');
    }

    public function item(){
    	return $this->belongsTo('App\Models\Item\Item');
    }

     public function itemlist(){
    	return $this->belongsTo('App\Models\ItemList\Itemlist');
    }
}
