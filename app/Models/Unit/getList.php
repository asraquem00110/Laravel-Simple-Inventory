<?php

namespace App\Models\Unit;
use App\Models\Unit\Unit;

Class getList {

	public function __construct(){

	}

	public function execute(): Object{
		$units = Unit::active()->get();
		return $units;
	}
}