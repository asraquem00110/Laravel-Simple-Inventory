<?php

namespace App\Models\Return_;

use App\Models\Return_\Return_;
use App\Models\Returnitems\returnitems;
use DB;
use Auth;

Class update {

	public function __construct(){

	}

	public function execute(int $idno,array $data): bool {

		$return = Return_::find($idno);
		$return->LastModifiedBy = Auth::User()->name;
		$return->client_id = $data['client'];
		$return->datereturn = $data['date'];
		$return->dispatch_refno = $data['refno'];

		DB::beginTransaction();
		try {
			$return->save();

			$return->returnitem()->delete();


			for($x=0;$x<count($data['items']);$x++){

					$returnlist = new returnitems;
					$returnlist->return_id = $return->id;
					$returnlist->item_id = $data['itemID'][$x];
					$returnlist->itemlist_id = $data['items'][$x];
					$returnlist->qty = $data['quantity'][$x];
					$returnlist->uom = $data['uom'][$x];
					$returnlist->remarks = $data['remarks'][$x];
					$returnlist->save();
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