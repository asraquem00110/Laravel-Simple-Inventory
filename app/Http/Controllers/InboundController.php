<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client\getList;
use App\Models\Item\getItemData;
use App\Models\Inbound\createInbound;
use App\Models\Inbound\getInbound;
use App\Models\Inbound\pendingView;
use App\Models\Inbound\updateInboundStatus;
use App\Models\ItemList\updateItemListInfo;
use App\Models\Inbound\getFilteredData;
use App\Models\Inbound\update;
use App\Models\Inbound\approved;
use App\Models\Inbound\Inbound;
use Validator;
use App;

use App\Models\Inbound\InboundViewModel;

class InboundController extends Controller
{
    
    public function __construct(){
    	$this->middleware('auth');
    }

    public function createInbound(){
        $viewModel = new InboundViewModel();
        return view('Inbound.create',compact('viewModel'));
    }

    public function saveInbound(Request $req,createInbound $action){
    	$rules = [
    		'client' => 'required',
    		// 'driver' => 'required',
    		'refdate' => 'required|date',
    		'unloadtime' => 'required|date_format:H:i',
    		'finishtime' => 'required|date_format:H:i|after:unloadtime',
    		'item'=> 'required',
    	];

    	$validator = Validator::make($req->all(),$rules);
    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
    	}

    	$res = $action->execute($req->all());
    	$message = $res ? "Successful" : "Failed";
    	return response()->json(['message'=>$message]);
    }

    public function pendingInbound(getInbound $action){
    	$inbounds = $action->execute(0);
    	return view('Inbound.pending',compact('inbounds'));
    }

    public function pendingView(int $idno){
        $viewModel = new InboundViewModel($idno);
        return view('Inbound.pendingview_new',compact('viewModel'));
    }

    public function updateInboundStatus(int $idno,Request $req,updateInboundStatus $action){
        $res = $action->execute($idno,$req->all());
        $message = $res ? "Successful" : "Failed";
        return response()->json(['message'=>$message]);
    }

    public function updateItemListInfo(int $idno,Request $req,updateItemListInfo $action){
        $rules = [
            'qty' => 'required|numeric',
        ];

        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $res = $action->execute($idno,$req->all());
        $message = $res ? "Successful" : "Failed";
        return response()->json(['message'=>$message,'itemlist'=> $res]);
    }

    public function getItemInfoData(int $idno,pendingView $action){
        return response()->json(['itemdata'=>$action->execute($idno)]);
    }

    public function approvedInbound(getList $getList){
        //$clients = $getList->execute();
        return view('Inbound.approved');
    }

    public function detailedreports(){
        return view('Inbound.reports.index');
    }

    public function getInboundData(Request $req, getFilteredData $action){
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

        $res =$action->execute($req->all()); 

        return response()->json(['inbounds'=>$res]);     

    }

    public function viewInbound(int $idno){
        $viewModel = new InboundViewModel($idno);
        return view('Inbound.view',compact('viewModel'));
    }

    public function viewInboundSummary(int $idno){
        $viewModel = new InboundViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Inbound.viewSummary',compact('viewModel'));
        return $pdf->stream($viewModel->inbound()->refNo."_summary.pdf");
        // return view('Inbound.viewSummary',compact('viewModel'));
    }

    public function viewInboundDetailed(int $idno){
        $viewModel = new InboundViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Inbound.viewDetailed',compact('viewModel'));
        return $pdf->stream($viewModel->inbound()->refNo."_detailed.pdf");
        //return view('Inbound.viewDetailed',compact('viewModel'));
    }

    public function update(int $idno,Request $req,update $action){
       $rules = [
            'client' => 'required',
            // 'driver' => 'required',
            'refdate' => 'required|date',
            'unloadtime' => 'required|date_format:H:i',
            'finishtime' => 'required|date_format:H:i|after:unloadtime',
            'item'=> 'required',
        ];

        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
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
