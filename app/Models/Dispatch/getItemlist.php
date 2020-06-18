<?php 

namespace App\Models\Dispatch;
use DB;
use App\Models\DispatchItems\dispatchitem;

Class getItemlist {

	public function __construct(){

	}

	public function execute(int $itemid,int $dispatchid): object{
		$list = dispatchitem::with(['itemlist','item'])->where('dispatch_id',$dispatchid)->where('item_id',$itemid)->get();
		return $list;
	}

}