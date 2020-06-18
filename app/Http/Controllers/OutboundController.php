<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outbound\OutboundViewModel;
use App\Models\ItemList\getItemListInfo;
use App\Models\Item\getItemData;
use App\Models\Item\getItemInfo;
use App\Models\Outbound\createOutbound;
use App\Models\Outbound\update;
use App\Models\Outbound\approved;
use App\Models\Outbound\getFilteredData;
use Validator;
use App;

class OutboundController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }

    public function createOutbound(){
    	$viewModel = new OutboundViewModel();
    	return view('Outbound.create',compact('viewModel'));
    }

    public function getItem(string $bcode,getItemListInfo $getItemListInfo){
    	$res = $getItemListInfo->execute($bcode);
    	return response()->json(['itemlist'=>$res]);
    }

    public function outboundItemlist(int $idno,getItemInfo $action){
            $itemlist = $action->execute($idno);
            $data = [];
            foreach($itemlist->itemListCurrent as $item){
                 $data[] = [
                
                   $item->barcode,
                   $item->serialNumber,
                   $item->qrcode,
                   $item->qty,
                   $item->item->unitMeasurement,
                   '<button data-barcode="'.$item->barcode.'" class="btn btn-success addItemWithBcode"><span class="fa fa-plus"></span></button>',
                ]; 
            }
           
            return response()->json(['aaData'=>$data]);
    }

    public function manualAddItem(getItemData $getItems){
        $items = $getItems->execute();
        $data = [];

        foreach($items as $item){
            $nobarcode = $withbarcode = "";
            $total = 0;

            if($item->itemListStorage->qty == 0){
                $nobarcode.= "<span>No Barcode Items<br/>{$item->itemListStorage->qty}</span>";
            }else{
                $nobarcode.= "<a href='#'>No Barcode Items<br/><span>{$item->itemListStorage->qty}</span></a>";
            }

            foreach($item->itemListCurrent as $_item){
                $total += $_item->qty;
            }

                if($total == 0){
                    $withbarcode.= "<span>With Barcode Items<br/>{$total}</span>";
                }else{
                    $withbarcode.= "<a href='#'>With Barcode Items<br/><span>
                      {$total}
                    </span></a>";
                }

            $data[]=[
                '<img src="'.asset('images/items').'/'.$item->img.'" style="height: 50px;width: 70px;" />',
                $item->description,
                $item->productcode,
                $item->unitMeasurement,
                $nobarcode,
                $withbarcode,
                
            ];
        }

         return response()->json(['aaData'=>$data]);
    }

    public function saveOutbound(Request $req,createOutbound $action){
        $rules = [
            'items' => 'required',
            'client' => 'required',
            'date' => 'required|date',
            'loadtime' => 'required|date_format:H:i',
            'finishtime' => 'required|date_format:H:i|after:loadtime',
            'preparedby' => 'required',
            //'approvedby' => 'required',
            // 'control' => 'required',
        ];

        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }
       
        $res = $action->execute($req->all());
        $message = $res ? "Successful" : "Failed";
        return response()->json(['message'=>$message]);
    }

    public function approvedOutbound(){
        return view('Outbound.approved');
    }

    public function getOutboundData(Request $req, getFilteredData $action){
        $data = $rules =  $params =[];
        $query = "";
     
        if($req->datefrom != ""){
           $rules['datefrom'] = 'date';
           $rules['dateto'] = 'date|after_or_equal:datefrom'; 
        }   
        
        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['aaData'=>$data,'errors'=>$validator->getMessageBag()->toArray()]);
        }

 
         $res = $action->execute($req->all()); 

         return response()->json(['outbounds'=>$res]);     

    }

    public function viewOutbound(int $idno){
        $viewModel = new OutboundViewModel($idno);
        return view('Outbound.view',compact('viewModel'));
    }

    public function viewOutboundSummary(int $idno){
        $viewModel = new OutboundViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Outbound.viewSummary',compact('viewModel'));
        return $pdf->stream($viewModel->outbound()->refNo."_summary.pdf");
        //return view('Outbound.viewSummary',compact('viewModel'));
    }

    public function viewOutboundDetailed(int $idno){
        $viewModel = new OutboundViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Outbound.viewDetailed',compact('viewModel'));
        return $pdf->stream($viewModel->outbound()->refNo."_detailed.pdf");
       // return view('Outbound.viewDetailed',compact('viewModel'));
    }

    public function pendingOutbound(){
        $viewModel = new OutboundViewModel();
        return view('Outbound.pending',compact('viewModel'));
    }

    public function pendingOutboundView(int $idno){
        $viewModel = new OutboundViewModel($idno);
        return view('Outbound.pendingView',compact('viewModel'));
    }

    public function update(int $idno,Request $req,update $action){

        $rules = [
            'items' => 'required',
            'client' => 'required',
            'date' => 'required|date',
            'loadtime' => 'required|date_format:H:i',
            'finishtime' => 'required|date_format:H:i|after:loadtime',
            'preparedby' => 'required',
            //'approvedby' => 'required',
            // 'control' => 'required',
        ];

        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $res = $action->execute($idno,$req->all());
        $message = $res ? "Successful" : "Failed";
        return response()->json(['message'=>$message]);
       
    }

    public function approved(int $idno,Request $req,approved $action){
        $res = $action->execute($idno,$req->status);
        $message = $res ? "Successful" : "Failed";
        return response()->json(['message'=>$message]);
    }
}
