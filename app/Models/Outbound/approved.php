<?php

namespace App\Models\Outbound;

use App\Models\Outbound\Outbound;
use App\Models\ItemList\updateStorage;
use DB;
use Auth;

Class approved {

	private $ItemListUpdateStorage;

	public function __construct(updateStorage $updateStorage){
		$this->ItemListUpdateStorage = $updateStorage;
	}

	public function execute(int $idno,int $status): bool{
		$Outbound = Outbound::find($idno);
		$Outbound->status = $status;
		$Outbound->approvedby = Auth::User()->name;
		$Outbound->ApprovedDateTime = date('Y-m-d H:i:s',time());

		DB::beginTransaction();
		try {
			$Outbound->save();

			if($Outbound->status == 1){
					foreach($Outbound->outbounditems as $obitem){
						$storage = $this->ItemListUpdateStorage->execute($obitem->itemlist_id,$obitem->quantity,0);
						// if($obitem->itemlist->freeStorage == 0){
						// 	$storage = $this->ItemListUpdateStorage->execute($obitem->itemlist_id,$obitem->quantity,0,$obitem->itemlist->freeStorage);
						// }else{
						// 	$storage = $this->ItemListUpdateStorage->execute($obitem->item_id,$obitem->quantity,0,$obitem->itemlist->freeStorage);
						// }
						
					}

			}
		

		}catch(Exeption $e){
			DB::rollBack();
			return false;
		}finally {
			DB::commit();
    		return true;
		}
		
	}

}