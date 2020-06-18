<?php

namespace App\Models\User;

use App\Models\User\User;
use Illuminate\Support\Facades\Hash;

Class saveUser {

	public function __construct(){

	}

	public function execute(array $data): bool {
		$user = new User;
		$user->name = $data['name'];
		$user->email = $data['email'];
		$user->password = Hash::make($data['password']);
		return $user->save();
	}

}