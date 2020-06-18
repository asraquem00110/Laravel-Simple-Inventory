<?php 

namespace App\Models\Setting;

use App\Models\Setting\Setting;

Class getSetting {

	public function __construct(){

	}

	public function execute(): Object{
		$res = Setting::all();
		return $res;
	}

}