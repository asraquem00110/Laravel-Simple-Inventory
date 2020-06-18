<?php

namespace App\Models\Outbound;

use App\Models\Outbound\Outbound;
use App\Models\Outbounditems\Outbounditems;
use App\Models\Outbound\saveOutboundItems;
use App\Models\ItemList\updateStorage;
use App\Events\AddItemLogsEvent;
use DB;
use Auth;
Class createOutbound {

	private $saveOutboundItems;
	private $ItemListUpdateStorage;

	public function __construct(saveOutboundItems $saveOutboundItems,updateStorage $updateStorage){
		$this->saveOutboundItems = $saveOutboundItems;
		$this->ItemListUpdateStorage = $updateStorage;
	}

	public function execute(array $data): bool{
		$outbound = new Outbound;
		$outbound->client_id = $data['client'];
		$outbound->driver = $data['driver'];
		$outbound->plateNo = $data['plateno'];
		$outbound->container = $data['containerno'];
		$outbound->controlNo = $data['control'];
		$outbound->loadDate = $data['date'];
		$outbound->loadTime = $data['loadtime'];
		$outbound->finishloadTime = $data['finishtime'];
		$outbound->preparedby = $data['preparedby'];
		$outbound->approvedby = $data['approvedby'];
		$outbound->receivedby = $data['receivedby'];
		$outbound->checkedby = $data['checkedby'];
		$outbound->user_id = Auth::User()->id;
		$outbound->status = 0; // COMMENT/REMOVE IF NO NEEDED FOR APPROVAL
		$items = $data['items'];
		$itemID = $data['itemID'];
		$hasbarcodes = $data['hasbarcode'];
		$quantity = $data['quantity'];
		$remarks = $data['remarks'];

		DB::beginTransaction();
		try {
			$outbound->save();

				$data = [];

				for($x=0;$x<count($items);$x++){
						// reduce stocks UNCOMMENT IF NO NEEDED FOR APPROVAL
						//$storage = $this->ItemListUpdateStorage->execute($items[$x],$quantity[$x],0);

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