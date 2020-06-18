<?php

namespace App\Models\Client;
use App\Models\Client\Client;

Class getSupplier {

	public function __construct(){

	}

	public function execute(): Object{
		$clients = Client::active()->supplier()->get();
		return $clients;
	}

}

