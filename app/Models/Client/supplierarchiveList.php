<?php

namespace App\Models\Client;

use App\Models\Client\Client;

Class supplierarchiveList {

	public function __construct(){

	}

	public function execute(){
		$clients = Client::archive()->supplier()->get();
		return $clients;
	}

}