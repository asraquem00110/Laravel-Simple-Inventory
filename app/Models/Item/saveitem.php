<?php

namespace App\Models\Item;

use App\Models\Item\Item;
use Illuminate\Http\Request;

Class saveitem {
	public function __construct(){

	}

	public function execute(Request $req): String{
		$Item = new Item;
		$Item->description =  $req->product;
		$Item->productCode =  $req->productCode;
		$Item->unitMeasurement = $req->unit;
		$Item->warning = $req->warningStock;
		$Item->danger = $req->dangerStock;
		if($req->file('imgfile')){
			$filename =  time().'_'.$req->file('imgfile')->getClientOriginalName();
			$req->file('imgfile')->move(public_path('images/items'),$filename);
			$Item->img = $filename;
		}
	
		$res = $Item->save() ? "Successfully Saved!" : "Something Went Wrong!";
		return $res;
	}
}