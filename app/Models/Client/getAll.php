<?php

namespace App\Models\Client;
use App\Models\Client\Client;

Class getAll {

	public function __construct(){

	}

	public function execute(): Object{
		$clients = Client::active()->orderBy("type","ASC")->get();
		return $clients;
	}

}

