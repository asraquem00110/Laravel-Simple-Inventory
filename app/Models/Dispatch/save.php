<?php

namespace App\Models\Dispatch;

use App\Models\Dispatch\Dispatch;
use Auth;
use DB;

Class save {

	public function __construct(){

	}

	public function execute(array $data): bool{
			$dispatch = new Dispatch;
			$dispatch->controlno = $data['control'];
			$dispatch->client_id = $data['client'];
			$dispatch->address = $data['address'];
			$dispatch->date = $data['date'];
			$dispatch->receivedby = $data['receivedby'];
			$dispatch->terms = $data['terms'];
			$dispatch->user_id = Auth::User()->id;
			$dispatch->status = 0; // // comment or remove if approval is not needed
			$dispatch->refno = "";

			DB::beginTransaction();
			try {

				$dispatch->save();

				$itemdataarray = [];

				for($x=0;$x<count($data['items']);$x++){
						$itemlistID = $data['flag'][$x]==0 ? NULL : $data['items'][$x];
						$itemdataarray[] = [
							$data['itemID'][$x] => [
										'itemlist_id'=> $itemlistID,
										'qty'=> $data['quantity'][$x],
										'uom'=> $data['uom'][$x],
										'created_at'=> date('Y-m-d H:i:s',time()),
										'remarks' => $data['remarks'][$x],
									],
							];

				}

				foreach($itemdataarray as $item){
					$dispatch->item()->attach($item);
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