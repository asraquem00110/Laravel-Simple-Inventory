<?php

namespace App\Models\Outbound;

use App\Models\Outbound\Outbound;
use App\Models\Outbounditems\Outbounditems;
use DB;
use Auth;
Class update {

	

	public function __construct(){

	}

	public function execute(int $idno,array $data): bool{
		$outbound = Outbound::find($idno);
		$outbound->client_id = $data['client'];
		$outbound->driver = $data['driver'];
		$outbound->plateNo = $data['plateno'];
		$outbound->container = $data['containerno'];
		$outbound->controlNo = $data['control'];
		$outbound->loadDate = $data['date'];
		$outbound->loadTime = $data['loadtime'];
		$outbound->finishloadTime = $data['finishtime'];

		$outbound->receivedby = $data['receivedby'];
		$outbound->checkedby = $data['checkedby'];
		$outbound->LastModifiedBy = Auth::User()->name;


		$items = $data['items'];
		$itemID = $data['itemID'];
		$hasbarcodes = $data['hasbarcode'];
		$quantity = $data['quantity'];
		$remarks = $data['remarks'];

		DB::beginTransaction();
		try {
			$outbound->save();
			$outbound->outbounditems()->delete();

				$data = [];

				for($x=0;$x<count($items);$x++){
						// reduce stocks UNCOMMENT IF NO NEEDED FOR APPROVAL
						//$storage = $this->ItemListUpdateStorage->execute($items[$x],$quantity[$x],0,$hasbarcodes[$x]);

						$data[] = [
							'itemlist_id' => $items[$x],
							'outbound_id' => $outbound->id,
							'quantity' => $quantity[$x],
							'created_at' => date('Y-m-d H:i:s'),
							// 'item_id' => $storage->item_id,
							'item_id' => $itemID[$x],
							'remarks' => $remarks[$x],
						];

				}

				Outbounditems::insert($data);


		}catch(Exeption $e){
			DB::rollBack();
			return false;
		}
		DB::commit();
    	return true;
	}


}