<?php

namespace App\Models\Inbound;

use App\Models\Inbound\Inbound;

Class getInbound {

	public function __construct(){

	}

	public function execute(int $status = 0,int $idno = 0): Object {
		$res = $idno == 0 ? Inbound::with(['user'])
							->where('status',$status)
							->get() : 
							Inbound::with(['user','client','itemlist','temp'])
							->where('status',$status)
							->where('id',$idno)
							->first();
		return $res;
	}

}