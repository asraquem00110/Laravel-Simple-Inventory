<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dispatch\DispatchViewModel;
use App\Models\Item\getItemInfo;
use App\Models\Item\getItemData;
use App\Models\ItemList\getItemListInfo_dispatch;
use App\Models\Dispatch\save;
use App\Models\Dispatch\update;
use App\Models\Dispatch\getDeliveryData;
use App\Models\Dispatch\Dispatch;
use Validator;
use App;
use Auth;

class DispatchController extends Controller
{
    private $viewModel;
	public function __construct(DispatchViewModel $dispatchViewModel){
		$this->middleware('auth');
		$this->viewModel = $dispatchViewModel;
	}

	public function create(){
		$viewModel = $this->viewModel;
		return view('Dispatch.create',compact('viewModel'));
	}

	public function list(){
		return view('Dispatch.approved');
	}

	public function dispatchItemlist(int $idno,getItemInfo $action){
		    $itemlist = $action->execute($idno);
            $data = [];
            foreach($itemlist->itemList as $item){
                 $data[] = [
                
                   $item->barcode,
                   $item->serialNumber,
                   $item->qrcode,
                   // $item->qty,
                   $item->item->unitMeasurement,
                   '<button data-barcode="'.$item->barcode.'" class="btn btn-success addItemWithBcode"><span class="fa fa-plus"></span></button>',
                ]; 
            }
           
            return response()->json(['aaData'=>$data]);
	}


	 public function getItem(string $bcode,getItemListInfo_dispatch $getItemListInfo){
    	$res = $getItemListInfo->execute($bcode);
    	return response()->json(['itemlist'=>$res]);
    }

    public function save(Request $req,save $action){

    	$rules = [
    		'client' => 'required',
    		'date' => 'required|date',
    		'items' => 'required',
    	];

    	$validator = Validator::make($req->all(),$rules);

    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
    	}

    	$res = $action->execute($req->all());

    	$message = $res ? "success" : "fail";
    	return response()->json(['message'=>$message]);

    }

    public function getDeliveryData(Request $req,getDeliveryData $action){
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

        return response()->json(['dispatches'=>$res]);     

    }

    public function viewDispatch(int $idno){
        $viewModel = new DispatchViewModel($idno);
        return view('Dispatch.view',compact('viewModel'));
    }

    public function viewDispatchSummary(int $idno){
        $viewModel = new DispatchViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Dispatch.viewSummary',compact('viewModel'));
        return $pdf->stream($viewModel->dispatch()->refNo."_summary.pdf");
        //return view('Outbound.viewSummary',compact('viewModel'));
    }

    public function viewDispatchDetailed(int $idno){
        $viewModel = new DispatchViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Dispatch.viewDetailed',compact('viewModel'));
        return $pdf->stream($viewModel->dispatch()->refNo."_detailed.pdf");
       // return view('Outbound.viewDetailed',compact('viewModel'));
    }

    public function pending(){
        $viewModel = new DispatchViewModel();
        return view('Dispatch.pending',compact('viewModel'));
    }

    public function pendingDispatchView(int $idno){
        $viewModel = new DispatchViewModel($idno);
        return view('Dispatch.pendingView',compact('viewModel'));
    }

    public function update(int $idno,Request $req,update $action){
        $rules = [
            'client' => 'required',
            'date' => 'required|date',
            'items' => 'required',
        ];

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $res = $action->execute($idno,$req->all());

        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function approved(int $idno,Request $req){
        $dispatch = Dispatch::find($idno);
        $dispatch->status = $req->status;
        $dispatch->approvedby = Auth::User()->name;
        $dispatch->ApprovedDateTime = date('Y-m-d H:i:s',time());  
        $res = $dispatch->save();
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }


}
