<?php

namespace App\Models\ItemLogs;

use Illuminate\Database\Eloquent\Model;

class Itemlogs extends Model
{
    public function item(){
    	return $this->belongsTo('App\Models\Item\Item');
    }

    public function itemlist(){
    	return $this->belongsTo('App\Models\ItemList\Itemlist');
    }
}
