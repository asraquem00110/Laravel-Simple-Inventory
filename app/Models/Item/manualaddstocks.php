<?php

namespace App\Models\Item;
use App\Models\ItemList\create;
use App\Events\AddItemLogsEvent;
use DB;
use Auth;
Class manualaddstocks {

	private $itemlistcreate;

	public function __construct(create $create){
		$this->itemlistcreate = $create;
	}

	public function execute(array $data): bool{
		$itemid = $data['itemid'];
		$items = $data['items'];
		$hasbarcode = $data['hasbarcode'];
		$remarks = $data['remarks'];

		DB::beginTransaction();
		try{
						foreach($items as $item){
							 $itemdata = [
								'item_id' => $itemid,
								'barcode' => '',
								'qrcode' => '',
								'serialNumber' => '',
								'description' => '',
								'specs' => '',
								'qty' => $item,
								'inbound_id' => NULL,
								'remarks' => "New stocks ".date('Y-m-d H:i:s',time()),
							];

							$storage = $this->itemlistcreate->execute($itemdata);
					        $itemlistID = $storage->id;
					        $oldvalue = $storage->qty-$item;
					        $newvalue = $storage->qty;
					        $modifiedBy = Auth::User()->name;

					        $eventArray = [
					        	'event' => 'NEW',
					        	'item_id' => $itemid,
					        	'itemlist_id' => $itemlistID,
					        	'oldvalue' => $oldvalue,
					        	'newvalue' => $newvalue,
					        	'inbound_id' => NULL,
					        	'outbound_id' => NULL,
					        	'modifiedby' => $modifiedBy,	
					        	'remarks' => $remarks,
					        ];

							event(new AddItemLogsEvent($eventArray));


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