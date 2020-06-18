<?php

namespace App\Models\ItemList;

use App\Models\ItemList\Itemlist;

Class getItemListInfo_dispatch {

	public function __construct(){

	}

	public function execute(String $bcode=""): object{
		// $res = Itemlist::with(['item'])->whereRaw('barcode LIKE ?',['%'.$bcode.'%'])->orderby('id','desc')->limit(1)->get();
		$res = Itemlist::with(['item'])->where('barcode' ,$bcode)->orderby('id','desc')->limit(1)->get();
		return $res;
	}

}