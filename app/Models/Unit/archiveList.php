<?php

namespace App\Models\Unit;
use App\Models\Unit\Unit;

Class archiveList {

	public function __construct(){

	}

	public function execute(): Object{
		$units = Unit::archive()->get();
		return $units;
	}
}