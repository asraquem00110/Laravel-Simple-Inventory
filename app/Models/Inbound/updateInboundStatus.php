<?php

namespace App\Models\Inbound;
use App\Models\Inbound\Inbound;
use App\Models\ItemList\Itemlist;
use App\Events\AddItemLogsEvent;
use DB;
use Auth;

Class updateInboundStatus {

	public function __construct(){

	}

	public function execute(int $idno,array $data): bool{
		$inbound = Inbound::find($idno);
		$inbound->status = $data['status'];
		$inbound->approvedBy = Auth::User()->name;
		$inbound->lastmodifiedBy = Auth::User()->name;


		DB::beginTransaction();
		try {
			$res = $inbound->save();

			if($inbound->status == 1){
					$tempitems = $inbound->temp;
					$itemdata = [];

					foreach($tempitems as $item){

						if($item->hasbarcode==1){
								for($x=0;$x<(int)$item->quantity;$x++){

									$itemdata = [
										'item_id' => $item->item_id,
										'barcode' => '',
										'qrcode' => '',
										'serialNumber' => '',
										'description' => '',
										'specs' => '',
										'qty' => 1,
										'inbound_id' => $inbound->id,
										'remarks' => $item->remarks,
									];

									Itemlist::create($itemdata);

								}
						}else{
									$itemdata = [
										'item_id' => $item->item_id,
										'barcode' => '',
										'qrcode' => '',
										'serialNumber' => '',
										'description' => '',
										'specs' => '',
										'qty' => $item->quantity,
										'inbound_id' => $inbound->id,
										'remarks' => $item->remarks,
									];

									$storage = Itemlist::storage()->where('item_id',$item->item_id)->first();
							        $itemlistID = $storage->id;
							        $inboundID = $inbound->id;
							        $modifiedBy = Auth::User()->name;
							        $oldvalue = $storage->qty;
							        $newvalue = $oldvalue + $item->quantity;

							        $storage->qty = $newvalue;
							        $storage->save();

							        $eventArray = [
							        	'event' => 'ADD',
							        	'item_id' => $item->item_id,
							        	'itemlist_id' => $itemlistID,
							        	'oldvalue' => $oldvalue,
							        	'newvalue' => $newvalue,
							        	'inbound_id' => $inboundID,
							        	'outbound_id' => NULL,
							        	'modifiedby' => $modifiedBy,	
							        	'remarks' => "additional stocks from Inbound Ref # {$inbound->refNo}",
							        ];

									event(new AddItemLogsEvent($eventArray));
						}
						
					} // ENDFOREACH

			} // END IF
		}catch (Exception $e){
			DB::rollBack();
			return false;
		}
		DB::commit();
		return true;
	}

}