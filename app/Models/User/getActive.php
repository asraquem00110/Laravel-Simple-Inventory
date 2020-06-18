<?php 

namespace App\Models\User;

use App\Models\User\User;

Class getActive {

	public function __construct(){

	}

	public function execute(): object {
		$users = User::active()->get();
		return $users;
	}

}