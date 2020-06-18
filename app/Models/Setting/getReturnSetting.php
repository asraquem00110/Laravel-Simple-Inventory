<?php

namespace App\Models\Setting;

use App\Models\Setting\Setting;

Class getReturnSetting {

	public function __construct(){

	}

	public function execute(): Object{
		$res = Setting::where("key","returnZero")->first();
		return $res;
	}

}