<?php

namespace App\Models\Outbound;

use App\Models\Outbound\Outbound;

Class getOutbound {

	public function __construct(){

	}

		public function execute(int $status = 0,int $idno = 0): Object {
		$res = $idno == 0 ? Outbound::with(['user'])
							->where('status',$status)
							->get() : 
							Outbound::with(['user','client','outbounditems'])
							->where('status',$status)
							->where('id',$idno)
							->first();
		return $res;
	}

}