<?php

namespace App\Models\ItemList;
use DB;
use App\Models\ItemList\ItemList;
use App\Events\AddItemLogsEvent;
use App\Models\ItemList\updateStorage;
use Auth;

Class itemlistmanualadd {
	private $ItemListUpdateStorage;

	public function __construct(updateStorage $updateStorage){
		$this->ItemListUpdateStorage = $updateStorage;
	}

	public function execute(int $idno,array $data){
			

			DB::beginTransaction();
			try {
			$itemlist = ItemList::find($idno);
			$event = $data['action'] == "Add" ? "ADD" : "REDUCE";
			$operation  = $data['action'] == "Add" ? 1 : 0;
			$itemid = $data['flag'] == "1" ? $itemlist->item_id : $idno;
			$storage = $this->ItemListUpdateStorage->execute($itemid,(float)$data['quantity'],$operation,$data['flag']);

			$itemlistID = $storage->id;
			$oldvalue = $operation == 1 ? ($storage->qty-$data['quantity']) : ($storage->qty+$data['quantity']);
			$newvalue = $storage->qty;
			$modifiedBy = Auth::User()->name;

				$eventArray = [
		        	'event' => $event,
		        	'item_id' => $itemlist->item_id,
		        	'itemlist_id' => $itemlistID,
		        	'oldvalue' => $oldvalue,
		        	'newvalue' => $newvalue,
		        	'inbound_id' => NULL,
		        	'outbound_id' => NULL,
		        	'modifiedby' => $modifiedBy,	
		        	'remarks' => $data['remarks'],
		       	];

			event(new AddItemLogsEvent($eventArray));
			}catch(Exception $e){
				DB::rollBack();
				return false;
			}finally {
				DB::commit();
				return true;
			}





	  //       $oldvalue = $itemlist->qty;
	  //       $newvalue = $data['action'] == "Add" ? ((float)$oldvalue + (float)$data['quantity']) : ((float)$oldvalue - (float)$data['quantity']);
	  //       $modifiedBy = Auth::User()->name;

			// DB::beginTransaction();

			// try {
					

			// 				if($data['flag'] == "0"){
			// 					// update with barcode storage
			// 					$itemlist->qty = $newvalue;
			// 			    	$itemlist->save();

		
			// 				}else{
			// 						// update without barcode storage
			// 					    $storage = $this->ItemListUpdateStorage->execute($data['item'][$x],$data['quantity'][$x]);
			// 				        $itemlistID = $storage->id;
			// 				        $oldvalue = $storage->qty-$data['quantity'][$x];
			// 				        $newvalue = $storage->qty;
			// 				        $inboundID = $inbound->id;
			// 				        $inboundrefno = $inbound->refNo;
			// 				        $modifiedBy = Auth::User()->name;

		

			
			// 				}

			// 				
							

						
							
							

		

	}

}