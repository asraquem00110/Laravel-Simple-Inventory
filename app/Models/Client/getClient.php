<?php

namespace App\Models\Client;

use App\Models\Client\Client;

Class getClient {

	public function __construct(){

	}

	public function execute(int $idno): Client {
		$Client = Client::find($idno);
		return $Client;
	}
}