<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit\Unit;
use App\Models\Unit\getArchive;
use App\Models\Unit\addUnit;
use App\Models\Unit\archiveUnit;
use Redirect;
use App\Models\Unit\UnitViewModel;
use Validator;
//use App\Traits\CustomMethods;

class UnitController extends Controller
{
    //use CustomMethods;

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){

        $viewModel = new UnitViewModel();
        return view('Unit.index',compact('viewModel'));
    }

    public function addUnit(Request $req,addUnit $action){
    	$res = $action->execute($req->all());
    	if($res){
    		return Redirect::back();
    	}
    	
    }

    public function archive(int $idno,archiveUnit $action,Request $req){
        $action->execute($idno,$req->all());
    }

    public function update(Request $req){
        $rules = [
            'unit' => 'required',
        ];

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $unit = Unit::find($req->unitid);
        $unit->unit = $req->unit;
        $res = $unit->save();
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

}
