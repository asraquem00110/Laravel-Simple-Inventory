<?php

namespace App\Models\Setting;

use App\Models\Setting\Setting;

Class getDispatchSetting {

	public function __construct(){

	}

	public function execute(): Object{
		$res = Setting::where("key","disZero")->first();
		return $res;
	}

}