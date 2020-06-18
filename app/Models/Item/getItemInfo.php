<?php

namespace App\Models\Item;
use App\Models\Item\Item;

Class getItemInfo {
	public function __construct(){

	}

	public function execute(int $idno): Object{
		$item = Item::with(['itemList'])->where('id',$idno)->first();
		return $item;
	}
}