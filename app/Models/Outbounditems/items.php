<?php

namespace App\Models\Outbounditems;
use App\Models\Outbounditems\Outbounditems;

Class items {

	public function __construct(){

	}

	public function execute(int $itemid,int $outboundid): object {
		$items = Outbounditems::where('item_id',$itemid)->where('outbound_id',$outboundid)->get();
		return $items;
	}

}