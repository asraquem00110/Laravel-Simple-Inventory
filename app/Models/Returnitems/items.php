<?php

namespace App\Models\Returnitems;
use App\Models\Returnitems\returnitems;

Class items {

	public function __construct(){

	}

	public function execute(int $itemid,int $returnid): object {
		$items = returnitems::where('item_id',$itemid)->where('return_id',$returnid)->get();
		return $items;
	}

}