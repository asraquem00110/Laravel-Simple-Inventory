<?php


namespace App\Models\Client;

use App\Models\Client\Client;


Class updateClient {

	public function __construct(){

	}

	public function execute(Array $data): String{
		$Client = Client::find($data['clientid']);
		$Client->name = $data['client'];
		$Client->address = $data['address'];
		$Client->tin = $data['tin'];
		$res = $Client->save() ? "Successfully Updated!" : "Something Went Wrong!";
		return $res;
	}

}