<?php

namespace App\Models\Return_;

use App\Models\Return_\Return_;

Class getApproved {

	public function __construct(){

	}

	public function execute(){
		$data = Return_::with(['returnitem'])->approved()->orderBy('id','DESC')->get();
		return $data;
	}

}