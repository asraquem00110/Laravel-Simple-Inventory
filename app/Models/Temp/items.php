<?php


namespace App\Models\Temp;

use App\Models\Temp\Temp;

Class items {

	public function __construct(){

	}

	public function execute(int $itemid,int $inboundid): object{
		$items = Temp::where('item_id',$itemid)->where('inbound_id',$inboundid)->get();
		return $items;
	}

}