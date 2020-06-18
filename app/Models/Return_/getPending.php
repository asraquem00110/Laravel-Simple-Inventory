<?php

namespace App\Models\Return_;

use App\Models\Return_\Return_;

Class getPending {

	public function __construct(){

	}

	public function execute(){
		$data = Return_::with(['returnitem'])->pending()->orderBy('id','DESC')->get();
		return $data;
	}

}