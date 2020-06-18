<?php

namespace App\Models\ItemList;

use App\Models\ItemList\Itemlist;

Class create {

		public function __construct(){

		}

		public function execute(array $data): object{
				return Itemlist::create($data);
		}

}