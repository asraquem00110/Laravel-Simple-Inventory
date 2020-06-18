<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Return_\ReturnViewModel;
use App\Models\Return_\createReturn;
use App\Models\Return_\update;
use App\Models\Return_\approved;
use App\Models\Return_\getFilteredData;
use Validator;
use App;

class ReturnController extends Controller
{
	private $viewModel = NULL;

    public function __construct(ReturnViewModel $viewModel){
    	$this->middleware('auth');
    	$this->viewModel = $viewModel;
    }

    public function create(){
    	$viewModel = $this->viewModel;
    	return view('Return.create',compact('viewModel'));
    }

    public function save(Request $req,createReturn $action){
    	$rules = [
    		'client' => 'required',
    		'date' => 'date|required',
    		// 'refno' => 'required',
    		'items' => 'required'
    	];

    	$validator = Validator::make($req->all(),$rules);
    	if($validator->fails()){
    		return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
    	}

    	$res = $action->execute($req->all());
    	$message = $res ? "success" : "fail";
    	return response()->json(['message'=>$message]);
    }

    public function pending(){
        $viewModel = $this->viewModel;
        return view('Return.pending',compact('viewModel'));
    }

    public function pendingview(int $id){
        $viewModel = new ReturnViewModel($id);
        return view('Return.pendingView',compact('viewModel'));
    }

    public function update(int $id,Request $req,update $action){
        $rules = [
            'client' => 'required',
            'date' => 'date|required',
            // 'refno' => 'required',
            'items' => 'required'
        ];

        $validator = Validator::make($req->all(),$rules);
        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $res = $action->execute($id,$req->all());
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

     public function approved(int $idno,Request $req,approved $action){
        $res = $action->execute($idno,$req->status);
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function getlist(){
        return view('Return.approved');
    }

    public function getReturnData(Request $req, getFilteredData $action){
        $data = $rules =[];
        if($req->datefrom != ""){
           $rules['datefrom'] = 'date';
           $rules['dateto'] = 'date|after_or_equal:datefrom'; 
        }   

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['aaData'=>$data,'errors'=>$validator->getMessageBag()->toArray()]);
        }

        $res =$action->execute($req->all()); 

        return response()->json(['returns'=>$res]);     
    }

    public function view(int $idno){
        $viewModel = new ReturnViewModel($idno);
        return view('Return.view',compact('viewModel'));
    }

    public function viewSummary(int $idno){
        $viewModel = new ReturnViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Return.viewSummary',compact('viewModel'));
        return $pdf->stream($viewModel->getReturn()->refNo."_summary.pdf");
       // return view('Return.viewSummary',compact('viewModel'));
    }

    public function viewDetailed(int $idno){
        $viewModel = new ReturnViewModel($idno);
        $pdf = App::make('dompdf.wrapper');
        $pdf->loadView('Return.viewDetailed',compact('viewModel'));
        return $pdf->stream($viewModel->getReturn()->refNo."_detailed.pdf");
       // return view('Return.viewDetailed',compact('viewModel'));
    }

}
