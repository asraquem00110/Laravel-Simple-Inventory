<?php

namespace App\Models\Return_;

use App\Models\Return_\Return_;
use DB;

Class returnSummary {

	public function __construct(){

	}

	public function execute(int $idno): object{
		$returnitems = DB::table('return_item')->SelectRaw('item_id,SUM(qty) as quantity,uom')->where('return_id',$idno)->groupBy('item_id')->groupBy('uom')->get();
		return $returnitems;
	}

}