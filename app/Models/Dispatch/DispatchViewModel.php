<?php

namespace App\Models\Dispatch;

use Spatie\ViewModels\ViewModel;
use App\Models\Client\getAll;
use App\Models\Item\getItemData;
use App\Models\Dispatch\getDispatch;
use App\Models\Dispatch\dispatchSummary;
use App\Models\Dispatch\getItemlist;
use App\Models\Dispatch\Dispatch;
use App\Models\Item\Item;
use App\Models\Setting\getCompany;

class DispatchViewModel extends ViewModel
{
	private $idno;
	private $clients;
    private $item;
    private $dispatch;

    public function __construct(int $idno = null)
    {
        $this->idno  = $idno;
    }

    public function dispatch(): object {
        $action = new getDispatch;
        $this->dispatch = $action->execute($this->idno);
        return $this->dispatch;
    }

    public function dispatchPending(): object {
        $res = Dispatch::pending()->where('id',$this->idno)->first();
        $this->dispatch = $res;
        return $this->dispatch;
    }

    public function clients(): object{
    	$action = new getAll;
    	$this->clients = $action->execute();
    	return $this->clients;

    }

     public function products(): object{
        $action = new getItemData;
        $this->item = $action->execute();
        return $this->item;
    }

    public function ItemsSummary(): object{
        $action = new dispatchSummary;
        $this->dispatch = $action->execute($this->idno);
        return $this->dispatch;
    }

    public function itemInfo(int $idno): Item{
        $this->item = Item::find($idno);
        return $this->item;
    }

    public function getItemlist(int $itemid): object{
        $action = new getItemlist;
        $this->item = $action->execute($itemid,$this->idno);
        return $this->item;
    }

    public function pendingDispatch(): object {
        $res = Dispatch::pending()->orderBy('id','DESC')->get();
        $this->dispatch = $res;
        return $this->dispatch;
    }

          public function getCompanySetting(): Object{
        $action = new getCompany;
        $res = $action->execute();
        return $res;
    }
}
