<?php


namespace App\Models\Temp;

use App\Models\Temp\Temp;

Class inboundSummary {

	public function __construct(){

	}

	public function execute(int $idno): object{
		$inbounditems = Temp::SelectRaw('item_id,SUM(quantity) as quantity')->where('inbound_id',$idno)->groupBy('item_id')->get();
		return $inbounditems;
	}

}