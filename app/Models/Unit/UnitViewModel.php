<?php

namespace App\Models\Unit;

use Spatie\ViewModels\ViewModel;
use App\Models\Unit\getList;
use App\Models\Unit\archiveList;

class UnitViewModel extends ViewModel
{
	public $idno;
	public $units;
	public $archive;

    public function __construct(int $idno = null)
    {
        $this->idno = $idno;
    }

 	public function units(): object{
    	$action = new getList;
    	$this->units = $action->execute();
    	return $this->units;
    }

    public function archive(): object{
    	$action = new archiveList;
    	$this->archive = $action->execute();
    	return $this->archive;
    }
}
