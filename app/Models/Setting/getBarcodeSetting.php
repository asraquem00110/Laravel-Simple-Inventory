<?php

namespace App\Models\Setting;

use App\Models\Setting\Setting;

Class getBarcodeSetting {

	public function __construct(){

	}

	public function execute(): Object{
		$res = Setting::where("key","barcodeZero")->first();
		return $res;
	}

}