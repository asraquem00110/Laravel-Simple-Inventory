<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting\Setting;
use App\Models\Setting\getSetting;
use App\Models\Setting\getBarcodeSetting;
use App\Models\User\User;
use App\Models\User\saveUser;
use Validator;
use App\Models\Setting\getCompany;

use App\Models\User\UserViewModel;
use Redirect;

class SettingController extends Controller
{
    public function __construct(){
    	//$this->middleware('auth');
    }

    public function getBarcodeSetting(getBarcodeSetting $action){
    	$res = $action->execute();
    	return $res;
    }

    public function init(getSetting $action){
    	$res = $action->execute();
    	return response()->json(['setting' => $res]);
    }

    public function updateBarcodeSettingCount(Request $req){
    	$rules = [
    		'val' => 'required|integer|min:1',
    	];

    	$validator = Validator::make($req->all(),$rules);

    	if($validator->fails()){
    		return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
    	}

    	$setting = Setting::where("key",$req->key)->update(['value'=>$req->val]);
    	$message = $setting ? "ok" : "fail";
    	return response()->json(['message'=>$message]);

    }	

    public function updateuser(int $idno,Request $req){
        $rules = [
            'name' => 'required|string|max:255',
        ];

        if($req->email != $req->oldemail){
            $rules['email'] = 'required|string|email|max:255|unique:users';
        }

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $user = User::find($idno);
        $user->name = $req->name;
        $user->email = $req->email;
        $res = $user->save();
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function changepassword(int $idno,Request $req){
        $rules = [
            'pass' => 'required|min:6',
        ];

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $user = User::find($idno);
        $user->password = bcrypt($req->pass);
        $res = $user->save();
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function userlist(){
        $viewModel = new UserViewModel();
        return view('User.index',compact('viewModel'));
    }

    public function adduser(Request $req,saveUser $action){

        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',

        ];

            $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $res = $action->execute($req->all());
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);

    }

    public function archiveuser(int $idno,Request $req){
        $user = User::find($idno);
        $user->archive = $req->status;
        $res = $user->save();
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function companysetting(getCompany $action){
        $setting = $action->execute();
        return view('companysetting',compact('setting'));
    }

    public function updateCompanySetting(Request $req){
        $res1 = true;
      if($req->file('imgfile') != NULL){
        $filename =  time().'_'.$req->file('imgfile')->getClientOriginalName();
        $req->file('imgfile')->move(public_path('images/company'),$filename);
        $setting = Setting::where("key","companylogo")->first();
        $oldimg = $setting->value;

        unlink(public_path('images/company/').$oldimg);
        $setting->value = $filename;
        $res1 = $setting->save();
      }

      $res2 = Setting::where("key","company")->update(['value'=>$req->company]);
      $res3 = Setting::where("key","companyaddress")->update(['value'=>$req->address]);

      if($res1 && $res2){
        return Redirect::back();
      }
       

    }
}
