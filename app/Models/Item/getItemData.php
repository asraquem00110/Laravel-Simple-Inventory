<?php

namespace App\Models\Item;
use App\Models\Item\Item;

Class getItemData {

	public function __construct(){

	}

	public function execute(){
		$items = Item::with('itemList')->active()->orderBy('unitMeasurement')->orderBy('description')->get();
		return $items;
	}

}