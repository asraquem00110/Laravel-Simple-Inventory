<?php

namespace App\Models\Item;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //

    public static $remaining = 0;
    public static $withcode = 0;
    public static $nocode = 0;
    public static $status = "";

    public function itemList(){
    	return $this->hasMany('App\Models\ItemList\Itemlist');
    }

    public function itemListStorage(){
    	return $this->hasOne('App\Models\ItemList\Itemlist')->where('freeStorage',1);
    }

    public function itemListCurrent(){
    	return $this->hasMany('App\Models\ItemList\Itemlist')->where('freeStorage',0)->where('qty','>',0)->orderby('id','DESC');
    }

    public function itemListActive(){
        return $this->hasMany('App\Models\ItemList\Itemlist')->where('freeStorage',0);
    }

    public function temp(){
        return $this->belongsTo('App\Models\Temp\Temp');
    }


     public static function remaining(Object $itemlist){
    	$withcode = $nocode = 0;
    	foreach($itemlist as $item){
    		if($item->freeStorage == 0){
    			$withcode += $item->qty;
    	    }else{
    	        $nocode += $item->qty;
    	    }
    	}
    	
    	Self::$remaining = $withcode+$nocode;
    	Self::$withcode = $withcode;
    	Self::$nocode = $nocode;
    	return;
    }

    public static function checkstatus(int $danger,int $warning){
    	// 0 warning 1 danger 2 no 3 good
    	if(self::$remaining <= $warning && self::$remaining >= $danger){
    		$status = 0;
    	}elseif(self::$remaining <= $danger && self::$remaining > 0){
    		$status = 1;
    	}elseif(self::$remaining == 0){
    		$status = 2;
    	}else{
            $status = 3;
        }

    	Self::$status = $status;
    	return;
    }


   
    public function scopeArchive($query){
        return $query->Where('archive',1);
    }

    public function scopeActive($query){
        return $query->Where('archive',0);
    }

    public function scopeListAcive($query){
        return $query->where('freeStorage',0);
    }

    public function outbounditems(){
        return $this->hasMany('App\Models\Outbounditems\Outbounditems');
    }

    public function tempitems(){
        return $this->hasMany('App\Models\Temp\Temp');
    }

    public function outbound(){
        return $this->belongsToMany('App\Models\Outbound\Outbound','outbounditems')->withPivot('itemlist_id','quantity','remarks','created_at');
    }

    public function dispatch(){
        return $this->belongsToMany('App\Models\Dispatch\Dispatch')->withPivot('itemlist_id','qty','uom','created_at','updated_at');
    }

    public function return_(){
        return $this->belongsToMany('App\Models\Return_\Return_')->withPivot('itemlist_id','qty','uom','created_at','updated_at');
    }

    public function itemstorage(){
        return $this->hasOne('App\Models\ItemList\Itemlist')->where('freeStorage',1);
    }




}
