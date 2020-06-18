<?php

namespace App\Models\Dispatch;

use App\Models\Dispatch\Dispatch;

Class getDispatch {

	public function __construct(){

	}

	public function execute(int $idno): Dispatch {
		$dispatch = Dispatch::find($idno);
		return $dispatch;
	}

}