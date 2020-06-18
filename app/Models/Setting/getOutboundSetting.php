<?php

namespace App\Models\Setting;

use App\Models\Setting\Setting;

Class getOutboundSetting {

	public function __construct(){

	}

	public function execute(): Object{
		$res = Setting::where("key","outboundZero")->first();
		return $res;
	}

}