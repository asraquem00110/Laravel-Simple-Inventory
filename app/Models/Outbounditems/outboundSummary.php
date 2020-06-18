<?php

namespace App\Models\Outbounditems;

use App\Models\Outbounditems\Outbounditems;

Class outboundSummary {


	public function __construct(){

	}

	public function execute(int $idno): Object{
		$Outbounditems = Outbounditems::SelectRaw('item_id,SUM(quantity) as quantity')->where('outbound_id',$idno)->groupBy('item_id')->get();
		return $Outbounditems;
	}

}