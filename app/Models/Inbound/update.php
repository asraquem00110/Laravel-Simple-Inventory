<?php

namespace App\Models\Inbound;

use App\Models\Inbound\Inbound;
use App\Events\NewInboundEvent;
use Auth;
use DB;
Class update {

	public function __construct(){

	}

	public function execute(int $idno,array $data): bool{
		$inbound = Inbound::find($idno);
		$inbound->client_id = $data['client'];
		$inbound->driver = $data['driver'];
		$inbound->plateNo = $data['plateno'];
		$inbound->container = $data['container'];
		$inbound->controlNo = $data['controlno'];
		$inbound->unloadDate = $data['refdate'];
		$inbound->unloadTime = $data['unloadtime'];
		$inbound->finishUnloadTime = $data['finishtime'];
		$inbound->origin = $data['origin'];
		$inbound->receivedby = $data['rcvby'];
		$inbound->checkedby = $data['chkby'];
		$inbound->notedby = $data['notedby'];
		$inbound->lastmodifiedBy = Auth::User()->name;

		DB::beginTransaction();
		try {
			$inbound->save();

					$inbound->temp()->delete();


					$itemdata = [
						"item"=>$data['item'],
						"quantity"=>$data['quantity'],
						"remarks"=>$data['remarks'],
						"hasbarcode"=>$data['hasbarcode'],
					];		

					event(new NewInboundEvent($itemdata,$inbound));

		}catch (Exception $e){
			DB::rollBack();
			return false;
		}finally {
			DB::commit();
            return true;
		}
	}
}