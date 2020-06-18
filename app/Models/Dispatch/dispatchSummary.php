<?php

namespace App\Models\Dispatch;

use App\Models\Dispatch\Dispatch;
use DB;
Class dispatchSummary {

	public function __construct(){

	}

	public function execute(int $idno): object{
		// $dispatchitems = Dispatch::SelectRaw('item_id,SUM(quantity) as quantity')->where('dispatch_id',$idno)->groupBy('item_id')->get();
		 $dispatchitems = DB::table('dispatch_item')->SelectRaw('item_id,SUM(qty) as quantity,uom')->where('dispatch_id',$idno)->groupBy('item_id')->groupBy('uom')->get();
		return $dispatchitems;
	}

}