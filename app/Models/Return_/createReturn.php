<?php

namespace App\Models\Return_;

use App\Models\Return_\Return_;
use App\Models\Returnitems\returnitems;
use App\Models\ItemList\updateStorage;
use DB;
use Auth;
Class createReturn {

	public function __construct(updateStorage $updateStorage){
		$this->ItemListUpdateStorage = $updateStorage;
	}

	public function execute(array $data): bool{


		 $returnitem = new Return_;

		 $returnitem->client_id = $data['client'];
		 $returnitem->datereturn = $data['date'];
		 $returnitem->dispatch_refno = $data['refno'];
		 $returnitem->preparedby = Auth::User()->name;
		 $returnitem->user_id = Auth::User()->id;
		 $returnitem->status = 0;

		DB::beginTransaction();
		try{
			$returnitem->save();

			for($x=0;$x<count($data['items']);$x++){

					$returnlist = new returnitems;
					$returnlist->return_id = $returnitem->id;
					$returnlist->item_id = $data['itemID'][$x];
					$returnlist->itemlist_id = $data['items'][$x];
					$returnlist->qty = $data['quantity'][$x];
					$returnlist->uom = $data['uom'][$x];
					$returnlist->remarks = $data['remarks'][$x];
					$returnlist->save();
					// // remove or comment if need for approval
					// $itemlist = $this->ItemListUpdateStorage->execute($data['items'][$x],(float)$data['quantity'][$x],1);
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