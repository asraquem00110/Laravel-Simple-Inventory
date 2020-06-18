<?php

namespace App\Models\Setting;

use App\Models\Setting\Setting;

Class getInboundSetting {

	public function __construct(){

	}

	public function execute(): Object{
		$res = Setting::where("key","inboundZero")->first();
		return $res;
	}

}