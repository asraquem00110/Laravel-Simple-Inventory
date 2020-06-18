<?php

namespace App\Models\Returnitems;

use Illuminate\Database\Eloquent\Model;

class returnitems extends Model
{

	protected $table = 'return_item';

	 public function return(){
    	return $this->belongsTo('App\Models\Return_\Return_');
    }

    public function itemlist(){
    	return $this->belongsTo('App\Models\ItemList\Itemlist');
    }

    public function item(){
    	return $this->belongsTo('App\Models\Item\Item');
    }

}