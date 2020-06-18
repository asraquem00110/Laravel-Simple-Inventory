<?php

namespace App\Models\Client;

use App\Models\Client\Client;

Class archiveList {

	public function __construct(){

	}

	public function execute(){
		$clients = Client::archive()->site()->get();
		return $clients;
	}

}