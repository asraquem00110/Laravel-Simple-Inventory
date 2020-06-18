<?php

namespace App\Models\Inbound;
use App\Models\Inbound\Inbound;

Class pendingView {

	public function __construct(){

	}

	public function execute(int $id): Object {
		$Inbound = Inbound::with(['temp','client'])
				   ->where('id',$id)
				   ->first();
		return $Inbound;
	}

}