<?php

namespace App\Models\Item;

use App\Models\Item\Item;

Class getArchive {
	public function __construct(){

	}

	public function execute(): object {

		$items = Item::archive()->get();
		return $items;
	}
}