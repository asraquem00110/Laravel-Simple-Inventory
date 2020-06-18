<?php

namespace App\Models\Inbound;

use App\Models\Inbound\Inbound;
use App\Models\ItemList\create;
use App\Models\Temp\Temp;
use App\Models\ItemList\updateStorage;
use App\Events\AddItemLogsEvent;
use Auth;
use DB;

Class approved {

	public function __construct(create $Itemlistcreate,updateStorage $updateStorage){
		$this->Itemlistcreate = $Itemlistcreate;
		$this->ItemListUpdateStorage = $updateStorage;
	}

	public function execute(int $idno,int $status): bool{
		$inbound = Inbound::find($idno);
		$inbound->status = $status;
		$inbound->approvedBy = Auth::User()->name;
		$inbound->ApprovedDateTime = date('Y-m-d H:i:s',time());
		DB::beginTransaction();
		try {
			$inbound->save();

			if($inbound->status == 1){
				foreach($inbound->temp as $temp){

					$itemdata = [
						'item_id' => $temp->item_id,
						'barcode' => '',
						'qrcode' => '',
						'serialNumber' => '',
						'description' => '',
						'specs' => '',
						'qty' => $temp->quantity,
						'inbound_id' => $inbound->id,
						'remarks' => $temp->remarks,
					];

					if($temp->hasbarcode == 1){
						$itemlist = $this->Itemlistcreate->execute($itemdata);
					}else{
						$itemlist = $this->ItemListUpdateStorage->execute($temp->item_id,(float)$temp->quantity,1,1);
							$itemlistID = $itemlist->id;
					        $oldvalue = $itemlist->qty-$temp->quantity;
					        $newvalue = $itemlist->qty;
					        $inboundID = $inbound->id;
					        $inboundrefno = $inbound->refNo;
					        $modifiedBy = Auth::User()->name;

					        $eventArray = [
					        	'event' => 'ADD',
					        	'item_id' => $temp->item_id,
					        	'itemlist_id' => $itemlistID,
					        	'oldvalue' => $oldvalue,
					        	'newvalue' => $newvalue,
					        	'inbound_id' => $inboundID,
					        	'outbound_id' => NULL,
					        	'modifiedby' => $modifiedBy,	
					        	'remarks' => $temp->remarks,
					        ];

							event(new AddItemLogsEvent($eventArray));
					}
					

					$tempupdate = Temp::find($temp->id);
					$tempupdate->itemlist_id = $itemlist->id;
					$tempupdate->save();
				}
			}

		}catch (Exception $e){
			DB::rollBack();
			return false;
		}finally {
			DB::commit();
            return true;
		}

	}

}