<?php

namespace App\Models\Outbound;

use Spatie\ViewModels\ViewModel;
use App\Models\Client\getAll;
use App\Models\Item\getItemData;
use App\Models\Outbound\getOutbound;
use App\Models\Outbounditems\outboundSummary;
use App\Models\Outbounditems\items;
use App\Models\Outbound\Outbound;
use App\Models\Setting\getCompany;

class OutboundViewModel extends ViewModel
{
	private $idno;
	private $clients;
    private $outbound;
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

    public function pending(): Object{
        $this->outbound = Outbound::pending()->orderBy('id','DESC')->get();
        return $this->outbound;
    }


    public function outbound(): Outbound{
        $action = new getOutbound;
        $this->outbound = $action->execute(1,$this->idno);
        return $this->outbound;
    }

    public function pendingOutbound(): Outbound{
        $action = new getOutbound;
        $this->outbound = $action->execute(0,$this->idno);
        return $this->outbound;
    }

    public function outboundItemsSummary(): Object{
        $action = new outboundSummary;
        $this->outbound = $action->execute($this->idno);
        return $this->outbound;
    }

    public function getOutboundItems($itemid,$outboundid): Object{
        $action = new items;
        $this->items = $action->execute($itemid,$outboundid);
        return $this->items;
    }

      public function getCompanySetting(): Object{
        $action = new getCompany;
        $res = $action->execute();
        return $res;
    }
}
