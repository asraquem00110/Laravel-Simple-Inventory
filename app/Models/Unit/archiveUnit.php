<?php

namespace App\Models\Unit;

use App\Models\Unit\Unit;

Class archiveUnit {

	public function __construct(){

	}

	public function execute(int $idno, Array $data): bool{
		$unit = Unit::find($idno);
        $unit->archive = $data['status'];
        $res = $unit->save();
        return $res;
	}


}