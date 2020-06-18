<?php
namespace App\Models\Return_;

use App\Models\Return_\Return_;
use App\Models\ItemList\updateStorage;
use Auth;
use DB;

Class approved {

	public function __construct(updateStorage $updateStorage){
		$this->ItemListUpdateStorage = $updateStorage;
	}

	public function execute(int $idno,int $status){
		$return = Return_::find($idno);
		$return->status = $status;
		$return->approvedby = Auth::User()->name;
		$return->ApprovedDateTime = date('Y-m-d H:i:s',time());

		DB::beginTransaction();
		try {
			$return->save();

			if($return->status == 1){
					foreach($return->returnitem as $reItem){
						$storage = $this->ItemListUpdateStorage->execute($reItem->itemlist_id,(float)$reItem->qty,1);
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