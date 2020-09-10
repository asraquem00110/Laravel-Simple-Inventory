<?php

namespace App\Models\Reports;

use Spatie\ViewModels\ViewModel;
use App\Models\Outbound\Outbound;
use App\Models\ItemLogs\Itemlogs;
use App\Models\Item\getItemData;
use App\Models\Client\getAll;
use App\Models\ItemList\Itemlist;
use App\Models\Outbounditems\Outbounditems;
use App\Models\Inbound\Inbound;
use App\Models\Return_\Return_;
use App\Models\Returnitems\returnitems;
use App\Models\Temp\Temp;
use App\Models\Dispatch\Dispatch;
use App\Traits\CustomMethods;
use App\Models\DispatchItems\dispatchitem;
use App\Models\Setting\getCompany;
use DB;
class ReportViewModel extends ViewModel
{

    use CustomMethods;

	private $outbound;
    private $items;
    private $sites_Suppliers;
    private $itemlist;
    private $inbound;
    private $delivery;
    private $returns;

    public function __construct()
    {
        //
    }

    public function sitesSuppliers(): object{
        $action = new getAll;
        $res = $action->execute();
        $this->sites_Suppliers = $res;
        return $this->sites_Suppliers;
    }

    public function getItems(): object {
        $action = new getItemData;
        $res = $action->execute();
        $this->items = $res;
        return $this->items;
    }

    public function getDateRange($datefrom,$dateto): array {
        $dates = CustomMethods::getDateRange($datefrom,$dateto);
        return $dates;
    }

    // OUTBOUND

    // public function getOutbounds($datefrom,$dateto): object{
    // 	$res = Outbound::SelectRaw('DISTINCT(DATE(loadDate)) as datecreated')
    //             ->whereBetween(DB::RAW('DATE(loadDate)'),[$datefrom,$dateto])
    //             ->orderBy('loadDate','ASC')
    //             ->get();

    // 	$this->outbound = $res;
    // 	return $this->outbound;
    // }

    public function getOutboundsData($refdate): object{
    	$res = Outbound::whereRaw('DATE(loadDate) = ?',[$refdate])
                ->get();
    	$this->outbound = $res;
    	return $this->outbound;
    }

    public function getOutboundLogs($refdate): object {
    	$res = Itemlogs::with(['item','itemlist'])
                ->where('event','REDUCE')
                ->whereRaw('DATE(created_at) = ?',[$refdate])
                ->get();

    	$this->outbound = $res;
    	return $this->outbound;
    }

    public function getOutboundsItem($refdate): object {
        $res = Outbounditems::with(['item'])
                ->select('outbounditems.item_id')
                ->leftJoin('outbounds','outbounds.id','=','outbounditems.outbound_id')
                ->whereRaw('DATE(outbounds.loadDate) = ?',[$refdate])
                ->groupBy('outbounditems.item_id')
                ->orderBy('outbounds.refno')
                ->get();

        $this->outbound = $res;
        return $this->outbound;
    }

    public function getOutboundsItem_Logs($refdate,$item): object {

        $res = Itemlogs::with(['item','itemlist'])
                ->where('event','REDUCE')
                ->whereRaw('DATE(created_at) = ? AND item_id = ?',[$refdate,$item])
                ->get();

        $this->outbound = $res;
        return $this->outbound;
    }

    public function getOutbound_PerItem(int $itemid,string $datefrom,string $dateto): object{
        $res = Outbounditems::leftJoin('outbounds','outbounds.id','=','outbounditems.outbound_id')
                ->where('outbounditems.item_id',$itemid)
                ->whereBetween(DB::Raw("DATE(outbounds.loadDate)"),[$datefrom,$dateto])
                ->orderBy(DB::Raw('DATE(outbounds.loadDate)'))
                ->orderBy('outbounds.id')
                ->get();

        $this->itemlist = $res;
        return $this->itemlist;
    }



    public function getOutboundsItem_Logs_PerItem($item,$datefrom,$dateto): object {

        $res = Itemlogs::with(['item','itemlist'])
                ->where('event','REDUCE')
                ->whereRaw('item_id = ?',[$item])
                ->whereBetween(DB::Raw("DATE(created_at)"),[$datefrom,$dateto])
                ->orderBy(DB::Raw('DATE(created_at)'))
                ->get();

        $this->outbound = $res;
        return $this->outbound;
    }

    public function getOutbound_PerSite($clientid,$datefrom,$dateto): object{
        $res = Outbound::with(['item','outbounditems'])
                ->where('client_id',$clientid)
                ->whereBetween(DB::Raw("DATE(loadDate)"),[$datefrom,$dateto])
                ->orderBy('loadDate')
                ->get();

        $this->outbound = $res;
        return $this->outbound;
    }



    // INBOUND

    public function getInbound_PerSite($clientid,$datefrom,$dateto): object{
        $res = Inbound::with(['temp'])
                ->where('client_id',$clientid)
                ->whereBetween(DB::Raw("DATE(unloadDate)"),[$datefrom,$dateto])
                 ->orderBy('unloadDate')
                ->get();

        $this->inbound = $res;
        return $this->inbound;
    }


    public function getInbound_PerItem(int $itemid,string $datefrom,string $dateto): object{
        $res = Temp::leftJoin('inbounds','inbounds.id','=','temps.inbound_id')
                ->where('temps.item_id',$itemid)
                ->whereBetween(DB::Raw("DATE(inbounds.unloadDate)"),[$datefrom,$dateto])
                ->orderBy(DB::Raw('DATE(inbounds.unloadDate)'))
                ->orderBy('inbounds.id')
                ->get();

        $this->itemlist = $res;
        return $this->itemlist;
    }



    public function getInboundsItem_Logs_PerItem($item,$datefrom,$dateto): object {

        $res = Itemlogs::with(['item','itemlist'])
                ->where('event','<>','REDUCE')
                ->whereRaw('item_id = ?',[$item])
                ->whereBetween(DB::Raw("DATE(created_at)"),[$datefrom,$dateto])
                ->orderBy(DB::Raw('DATE(created_at)'))
                ->get();

        $this->inbound = $res;
        return $this->inbound;
    }

    // public function getInbounds($datefrom,$dateto): object{
    //     $res = Inbound::SelectRaw('DISTINCT(DATE(unloadDate)) as datecreated')
    //             ->whereBetween(DB::RAW('DATE(unloadDate)'),[$datefrom,$dateto])
    //             ->orderBy('unloadDate','ASC')
    //             ->get();

    //     $this->inbound = $res;
    //     return $this->inbound;
    // }

    public function getInboundsData($refdate): object{
        $res = Inbound::whereRaw('DATE(unloadDate) = ?',[$refdate])
                ->get();
        $this->inbound = $res;
        return $this->inbound;
    }

    public function getInboundLogs($refdate): object {
        $res = Itemlogs::with(['item','itemlist'])
                ->where('event','<>','REDUCE')
                ->whereRaw('DATE(created_at) = ?',[$refdate])
                ->get();

        $this->inbound = $res;
        return $this->inbound;
    }





    // DELIVERY


    public function getDelivery_PerSite($clientid,$datefrom,$dateto): object{
        $res = Dispatch::with(['item'])
                ->where('client_id',$clientid)
                ->whereBetween(DB::Raw("date"),[$datefrom,$dateto])
                 ->orderBy('date')
                ->get();

        $this->delivery = $res;
        return $this->delivery;
    }

    public function getItemlistInfo(int $dispatch,int $itemlistid): object{
        $res = dispatchitem::where('dispatch_id',$dispatch)
                    ->where('itemlist_id',$itemlistid)
                    ->first();
        $this->itemlist = $res;
        return $this->itemlist;
    }

    public function getDelivery_PerItem(int $itemid,string $datefrom,string $dateto): object{
        $res = dispatchitem::leftJoin('dispatches','dispatches.id','=','dispatch_item.dispatch_id')
                ->where('dispatch_item.item_id',$itemid)
                ->whereBetween(DB::Raw("dispatches.date"),[$datefrom,$dateto])
                ->orderBy(DB::Raw('dispatches.date'))
                ->orderBy('dispatches.id')
                ->get();

        $this->itemlist = $res;
        return $this->itemlist;
    }

    public function getDeliveryData($refdate): object{
        $res = Dispatch::whereRaw('date = ?',[$refdate])
                ->get();
        $this->delivery = $res;
        return $this->delivery;
    }


    // RETURN ITEMS

    public function getReturn_PerSite($clientid,$datefrom,$dateto): object{
        $res = Return_::with(['returnitem'])
                ->where('client_id',$clientid)
                ->whereBetween(DB::Raw("DATE(datereturn)"),[$datefrom,$dateto])
                ->orderBy('datereturn')
                ->get();

        $this->returns = $res;
        return $this->returns;
    }

    public function getReturn_PerItem(int $itemid,string $datefrom,string $dateto): object{
        $res = returnitems::leftJoin('returns','returns.id','=','return_item.return_id')
                ->where('return_item.item_id',$itemid)
                ->whereBetween(DB::Raw("DATE(returns.datereturn)"),[$datefrom,$dateto])
                ->orderBy(DB::Raw('DATE(returns.datereturn)'))
                ->orderBy('returns.id')
                ->get();

        $this->itemlist = $res;
        return $this->itemlist;
    }


    public function getReturnData($refdate): object{
        $res = Return_::whereRaw('DATE(datereturn) = ?',[$refdate])
                ->get();
        $this->returns = $res;
        return $this->returns;
    }




    public function getCompanySetting(): Object{
        $action = new getCompany;
        $res = $action->execute();
        return $res;
    }




}
