<?php 

namespace App\Models\ItemList;
use App\Models\ItemList\Itemlist;

Class updateStorage {

	public function __construct(){

	}

	public function execute(int $itemID,float $qty,int $operation = 1,int $freeStorage = NULL): object{

		$storage = $freeStorage == 1 ? Itemlist::storage()->where('item_id',$itemID)->first() : Itemlist::barcode()->where('id',$itemID)->first();
    if($freeStorage == NULL){
      $storage = Itemlist::find($itemID);
    }

    $oldvalue = $storage->qty;

  		if($operation == 1){
  			$newvalue = $oldvalue + $qty;
  		}else{
  			$newvalue = $oldvalue - $qty;
  		}
        

        $storage->qty = $newvalue;
        $storage->save();
        return $storage;
	}

}