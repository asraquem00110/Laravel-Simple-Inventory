<?php

namespace App\Models\Outbounditems;

use Illuminate\Database\Eloquent\Model;

class Outbounditems extends Model
{
    public function outbound(){
    	return $this->belongsTo('App\Models\Outbound\Outbound');
    }

    public function itemlist(){
    	return $this->belongsTo('App\Models\ItemList\Itemlist');
    }

    public function item(){
    	return $this->belongsTo('App\Models\Item\Item');
    }
}
