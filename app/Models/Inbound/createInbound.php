<?php

namespace App\Models\Inbound;

use App\Models\Inbound\Inbound;
use App\Events\NewInboundEvent;
use App\Events\AddItemLogsEvent;
use App\Models\ItemList\Itemlist;
use App\Models\ItemList\create;
use App\Models\ItemList\updateStorage;
use App\Models\Temp\addTempLogs;
use Auth;
use DB;

Class createInbound {

	private $Itemlistcreate;
	private $ItemListUpdateStorage;
	private $addTempLogs;

	public function __construct(create $Itemlistcreate,updateStorage $updateStorage,addTempLogs $addTempLogs){
			$this->Itemlistcreate = $Itemlistcreate;
			$this->ItemListUpdateStorage = $updateStorage;
			$this->addTempLogs = $addTempLogs;
	}

	public function execute(Array $data): bool{

		$inbound = new Inbound;
		$inbound->client_id = $data['client'];
		$inbound->driver = $data['driver'];
		$inbound->plateNo = $data['plateno'];
		$inbound->container = $data['container'];
		$inbound->refNo = $data['refno'];
		$inbound->controlNo = $data['controlno'];
		$inbound->unloadDate = $data['refdate'];
		$inbound->unloadTime = $data['unloadtime'];
		$inbound->finishUnloadTime = $data['finishtime'];
		$inbound->origin = $data['origin'];
		$inbound->receivedby = $data['rcvby'];
		$inbound->checkedby = $data['chkby'];
		$inbound->notedby = $data['notedby'];
		$inbound->user_id = Auth::User()->id;
		$inbound->status = 0;

		DB::beginTransaction();
		try {
			$inbound->save();
					// // comment or remove if approval is not needed
					$itemdata = [
						"item"=>$data['item'],
						"quantity"=>$data['quantity'],
						"remarks"=>$data['remarks'],
						"hasbarcode"=>$data['hasbarcode'],
					];		

					event(new NewInboundEvent($itemdata,$inbound));

					// // uncomment if approval is not needed

			// for($x=0;$x<count($data['item']);$x++){
	  //              $itemdata = [
			// 			'item_id' => $data['item'][$x],
			// 			'barcode' => '',
			// 			'qrcode' => '',
			// 			'serialNumber' => '',
			// 			'description' => '',
			// 			'specs' => '',
			// 			'qty' => $data['quantity'][$x],
			// 			'inbound_id' => $inbound->id,
			// 			'remarks' => $data['remarks'][$x],
			// 		];

			// 		//Itemlist::create($itemdata);
			// 		if($data['hasbarcode'][$x] == 1){
			// 			$itemlist = $this->Itemlistcreate->execute($itemdata);
			// 		}else{
			// 			$itemlist = $this->ItemListUpdateStorage->execute($data['item'][$x],(float)$data['quantity'][$x],1,1);
			// //				$itemlistID = $itemlist->id;
			// //		        $oldvalue = $itemlist->qty-$data['quantity'][$x];
			// //		        $newvalue = $itemlist->qty;
			// //		        $inboundID = $inbound->id;
			// //		        $inboundrefno = $inbound->refNo;
			// //		        $modifiedBy = Auth::User()->name;

			// //		        $eventArray = [
			// //		        	'event' => 'ADD',
			// //		        	'item_id' => $temp->item_id,
			// //		        	'itemlist_id' => $itemlistID,
			// //		        	'oldvalue' => $oldvalue,
			// //		        	'newvalue' => $newvalue,
			// //		        	'inbound_id' => $inboundID,
			// //		        	'outbound_id' => NULL,
			// //		        	'modifiedby' => $modifiedBy,	
			// //		        	'remarks' => $temp->remarks,
			// //		        ];

			// //				event(new AddItemLogsEvent($eventArray));

			// 		}
					
			// 		$itemdata['hasbarcode'] = $data['hasbarcode'][$x];
			// 		$this->addTempLogs->execute($itemlist->id,$itemdata);

			// }

		}catch (Exception $e){
			DB::rollBack();
			return false;
		}finally {
			DB::commit();
            return true;
		}




















	// // OLD CONCEPT	

	// 	DB::beginTransaction();
	// 	try {
	// 			$inbound->save();
					
	// 			$itemdata = [
	// 					"item"=>$data['item'],
	// 					"quantity"=>$data['quantity'],
	// 					"remarks"=>$data['remarks'],
	// 					"hasbarcode"=>$data['hasbarcode'],
	// 				];		

	// 				event(new NewInboundEvent($itemdata,$inbound));

	// 	// 	// remove if approval is required	

	// 		for($x=0;$x<count($data['item']);$x++){
			
	// 	            if($data['hasbarcode'][$x] == "on"){
	// 	            		for($y=0;$y<(int)$data['quantity'][$x];$y++){
	// 	            				$itemdata = [
	// 									'item_id' => $data['item'][$x],
	// 									'barcode' => '',
	// 									'qrcode' => '',
	// 									'serialNumber' => '',
	// 									'description' => '',
	// 									'specs' => '',
	// 									'qty' => 1,
	// 									'inbound_id' => $inbound->id,
	// 									'remarks' => $data['remarks'][$x],
	// 								];

	// 								//Itemlist::create($itemdata);
	// 								$this->Itemlistcreate->execute($itemdata);
	// 	            		}
	// 	            }else{

	// 				        $storage = $this->ItemListUpdateStorage->execute($data['item'][$x],$data['quantity'][$x]);
	// 				        $itemlistID = $storage->id;
	// 				        $oldvalue = $storage->qty-$data['quantity'][$x];
	// 				        $newvalue = $storage->qty;
	// 				        $inboundID = $inbound->id;
	// 				        $inboundrefno = $inbound->refNo;
	// 				        $modifiedBy = Auth::User()->name;

	// 				        $eventArray = [
	// 				        	'event' => 'ADD',
	// 				        	'item_id' => $data['item'][$x],
	// 				        	'itemlist_id' => $itemlistID,
	// 				        	'oldvalue' => $oldvalue,
	// 				        	'newvalue' => $newvalue,
	// 				        	'inbound_id' => $inboundID,
	// 				        	'outbound_id' => NULL,
	// 				        	'modifiedby' => $modifiedBy,	
	// 				        	'remarks' => $data['remarks'][$x],
	// 				        ];

	// 						event(new AddItemLogsEvent($eventArray));
	// 	            }
	// 		}						
					
			

	// 	}catch (Exception $e){
	// 		DB::rollBack();
	// 		return false;
	// 	}
		
	// 	DB::commit();
 //    	return true;
	}

}