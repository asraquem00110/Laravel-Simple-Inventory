<?php

namespace App\Models\Item;

use App\Models\Item\Item;

Class archiveItem {

	public function __construct(){

	}

	public function execute(int $id): bool {
		$item = Item::find($id);
		$item->archive = 1;
		return $item->save();
	}

}