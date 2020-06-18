<?php

namespace App\Models\Client;
use App\Models\Client\Client;

Class getList {

	public function __construct(){

	}

	public function execute(): Object{
		$clients = Client::active()->site()->get();
		return $clients;
	}

}

