<?php

namespace App\Models\Inbound;

use Spatie\ViewModels\ViewModel;
use App\Models\Client\getAll;
use App\Models\Item\getItemData;
use App\Models\Inbound\getInbound;
use App\Models\Temp\inboundSummary;
use App\Models\Temp\items;
use App\Models\Inbound\Inbound;
use App\Models\Setting\getCompany;

class InboundViewModel extends ViewModel
{

	private $clients;
	private $idno;
	private $item;
    private $inbound;
    private $items;

    public function __construct(int $idno = null)
    {
        $this->idno = $idno;
    }


    public function clients(): Object{
    	$action = new getAll;
    	$this->clients = $action->execute();
    	return $this->clients;
    }

    public function products(): Object{
    	$action = new getItemData;
    	$this->item = $action->execute();
    	return $this->item;
    }

    public function inbound(): Inbound{
        $action = new getInbound;
        $this->inbound = $action->execute(1,$this->idno);
        return $this->inbound;
    }

    public function inboundPending(): Inbound{
        $res = Inbound::pending()->where('id',$this->idno)->first();
        $this->inbound = $res;
        return $this->inbound;
    }


    public function inboundItemsSummary(): Object{
        $action = new inboundSummary;
        $this->inbound = $action->execute($this->idno);
        return $this->inbound;
    }

      public function getInboundItems($itemid,$inboundid): Object{
        $action = new items;
        $this->items = $action->execute($itemid,$inboundid);
        return $this->items;
    }

    public function getCompanySetting(): Object{
        $action = new getCompany;
        $res = $action->execute();
        return $res;
    }

}
