<?php


namespace App\Models\Temp;

use App\Models\Temp\Temp;

Class addTempLogs {

	public function __construct(){

	}

	public function execute(int $itemlistID,array $data): bool{
		$temp = new Temp;
		$temp->inbound_id = $data['inbound_id'];
		$temp->item_id = $data['item_id'];
		$temp->hasbarcode = $data['hasbarcode'];
		$temp->quantity  = $data['qty'];
		$temp->remarks = $data['remarks'];
		$temp->itemlist_id = $itemlistID;
		return $temp->save();
		
	}

}