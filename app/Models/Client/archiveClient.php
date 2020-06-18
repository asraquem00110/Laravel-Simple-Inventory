<?php

namespace App\Models\Client;
use App\Models\Client\Client;

Class archiveClient {

	public function __construct(){

	}

	public function execute(int $idno, Array $data): bool{
		$client = Client::find($idno);
        $client->archive = $data['status'];
        $res = $client->save();
        return $res;
	}

}

