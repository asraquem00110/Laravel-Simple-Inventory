<?php

namespace App\Models\User;

use Spatie\ViewModels\ViewModel;
use App\Models\User\getArchive;
use App\Models\User\getActive;

class UserViewModel extends ViewModel
{
	private $idno;
	private $users;

    public function __construct(int $idno = null)
    {
        $this->idno = $idno;
    }

    public function active(){
    	$action = new getActive;
    	$this->users = $action->execute();
    	return $this->users;
    }

    public function archive(){
    	$action = new getArchive;
    	$this->users = $action->execute();
    	return $this->users;
    }

}
