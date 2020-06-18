<?php

namespace App\Models\Return_;
use App\Models\Client\getList;
use App\Models\Item\getItemData;
use App\Models\Return_\getPending;
use App\Models\Return_\getReturn;
use App\Models\Return_\returnSummary;
use App\Models\Item\Item;
use App\Models\Returnitems\items;
use App\Models\Setting\getCompany;
use Spatie\ViewModels\ViewModel;

class ReturnViewModel extends ViewModel
{
	private $idno;
	private $sites;
    private $returns;
    private $item;

    public function __construct(int $idno = NULL)
    {
        $this->idno = $idno;
    }

    public function getReturn(): Return_ {
        $action = new getReturn;
        $this->returns = $action->execute($this->idno);
        return $this->returns;
    }

    public function sites(): object {
    	$action = new getList;
    	$res = $action->execute();
    	$this->sites = $res;
    	return $this->sites;
    }

    public function products(): object{
        $action = new getItemData;
        $this->item = $action->execute();
        return $this->item;
    }

    public function pendingList(): object {
        $action = new getPending;
        $this->returns = $action->execute();
        return $this->returns;
    }

    public function ItemsSummary(): object{
        $action = new returnSummary;
        $this->returns = $action->execute($this->idno);
        return $this->returns;
    }

    public function itemInfo(int $idno): Item{
        $this->item = Item::find($idno);
        return $this->item;
    }

    public function getReturnItems(int $itemid,int $returnid): Object{
        $action = new items;
        $this->items = $action->execute($itemid,$returnid);
        return $this->items;
    }

    public function getCompanySetting(): Object{
        $action = new getCompany;
        $res = $action->execute();
        return $res;
    }
}
