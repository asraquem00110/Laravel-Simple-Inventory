<?php

namespace App\Models\ItemList;

use Illuminate\Database\Eloquent\Model;

class Itemlist extends Model
{
    //
    protected $guarded = [];

    public function item(){
    	return $this->belongsTo('App\Models\Item\Item');
    }

    public static function getTotal(Object $itemlist): float{
    		$quantity = 0;	
    		foreach($itemlist as $list){
    			$quantity += $list->qty;
    		}

    		return $quantity;
    }

    public function scopeStorage($query){
        return $query->where('freeStorage',1);
    }

    public function scopeBarcode($query){
        return $query->where('freeStorage',0);
    }

    public function scopeInstock($query){
        return $query->where('qty','>',0);
    }

    public function Inbound(){
        return $this->belongsTo('App\Models\Inbound\Inbound');
    }

    public function outbounditems(){
        return $this->belongsTo('App\Models\Outbounditems\Outbounditems');
    }
}
