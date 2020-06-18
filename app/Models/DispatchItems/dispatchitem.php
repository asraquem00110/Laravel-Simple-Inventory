<?php

namespace App\Models\DispatchItems;

use Illuminate\Database\Eloquent\Model;

class dispatchitem extends Model
{

	protected $table = 'dispatch_item';

	 public function dispatch(){
    	return $this->belongsTo('App\Models\Dispatch\Dispatch');
    }

    public function itemlist(){
    	return $this->belongsTo('App\Models\ItemList\Itemlist');
    }

    public function item(){
    	return $this->belongsTo('App\Models\Item\Item');
    }

}