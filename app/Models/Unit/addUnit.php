<?php

namespace App\Models\Unit;

use App\Models\Unit\Unit;

Class addUnit {

	public function __construct(){

	}

	public function execute(array $data): bool {

		$Unit = new Unit;
		$Unit->unit = $data['unit'];
		$res = $Unit->save();

		return $res;

	}	
}