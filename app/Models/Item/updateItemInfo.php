<?php

namespace App\Models\Item;
use App\Models\Item\Item;

Class updateItemInfo {

	public function __construct(){

	}

	public function execute(Array $data): bool{
		$item = Item::find($data['id']);
		$item->description = $data['product'];
		$item->productCode = $data['productCode'];
		$item->unitMeasurement = $data['unit'];
		$item->warning = $data['warningStock'];
		$item->danger = $data['dangerStock'];
		return $item->save();
	}

}