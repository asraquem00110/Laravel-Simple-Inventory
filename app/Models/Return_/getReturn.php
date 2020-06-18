<?php

namespace App\Models\Return_;

use App\Models\Return_\Return_;

Class getReturn {

	public function __construct(){

	}

	public function execute(int $idno): Return_ {
		$data = Return_::with(['returnitem'])->find($idno);
		return $data;
	}
}