<?php

namespace App\Models\Client;
use App\Models\Client\Client;

Class saveClient {

	public function __construct(){

	}

	public function execute(Array $data): String{
		$Client = new Client;
		$Client->name = $data['client'];
		$Client->address = $data['address'];
		$Client->tin = $data['tin'];
		$Client->type = $data['type'];
		$res = $Client->save() ? "Successfully Saved!" : "Something Went Wrong!";
		return $res;
	}

}

