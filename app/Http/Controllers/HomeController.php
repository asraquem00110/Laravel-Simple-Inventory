<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User\User;
use App\Models\Client\Client;
use App\Models\Item\Item;
use App\Models\Item\getItemData;
use App\Models\ItemList\Itemlist;
use App\Models\Inbound\Inbound;
use App\Models\Outbound\Outbound;
use App\Models\Dispatch\Dispatch;
use App\Models\Return_\Return_;

use DB;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(getItemData $getitems)
    {
        $no = $low = $warning = $good = 0;
        $items = $getitems->execute();
       

        foreach($items as $item){
             $list = $item->itemList;
             $quantity = Itemlist::getTotal($list);
            if($quantity <= $item->warning && $quantity >= $item->danger){
                $warning++;
            }elseif($quantity <= $item->danger && $quantity > 0){
                $low++;
            }elseif($quantity <= 0){
                $no++;
            }elseif($quantity > $item->warning){
                $good++;
            }
        }

        $itemdata = [$good,$warning,$low,$no];


        $inbounds = Inbound::approved()->SelectRaw('count(id) as inbound,MONTH(created_at) as monthdes')->whereRaw('YEAR(created_at) = YEAR(NOW())')->groupby(DB::raw('MONTH(created_at)'))->get();

             $Inbound_displayarray = $Outbound_displayarray = $Dispatch_displayarray = [
                    0,0,0,0,0,0,0,0,0,0,0,0
                ];

        foreach($inbounds as $inbound){
            $Inbound_displayarray[$inbound->monthdes-1] = $inbound->inbound;
        }

        $outbounds = Outbound::approved()->SelectRaw('count(id) as outbound,MONTH(created_at) as monthdes')->whereRaw('YEAR(created_at) = YEAR(NOW())')->groupby(DB::raw('MONTH(created_at)'))->get();

        foreach($outbounds as $outbound){
            $Outbound_displayarray[$outbound->monthdes-1] = $outbound->outbound;
        }

        $dispatches = Dispatch::approved()->SelectRaw('count(id) as dispatch,MONTH(created_at) as monthdes')->whereRaw('YEAR(created_at) = YEAR(NOW())')->groupby(DB::raw('MONTH(created_at)'))->get();

        foreach($dispatches as $dispatch){
            $Dispatch_displayarray[$dispatch->monthdes-1] = $dispatch->dispatch;
        }


        $usercount = User::where('archive',0)->count();
        $clientcount = Client::site()->active()->count();
        $suppliercount = Client::supplier()->active()->count();
        $itemcount = Item::where('archive',0)->count();
        $pendingInbound = Inbound::pending()->count();
        $pendingOutbound = Outbound::pending()->count();
        $pendingDelivery = Dispatch::pending()->count();
        $pendingReturn = Return_::pending()->count();
        return view('home',compact('usercount','clientcount','itemcount','itemdata','Inbound_displayarray','Outbound_displayarray','Dispatch_displayarray','suppliercount','pendingInbound','pendingOutbound','pendingDelivery','pendingReturn'));
    }
}
