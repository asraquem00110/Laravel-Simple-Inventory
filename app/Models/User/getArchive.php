<?php 

namespace App\Models\User;

use App\Models\User\User;

Class getArchive {

	public function __construct(){

	}

	public function execute(): object {
		$users = User::archive()->get();
		return $users;
	}

}