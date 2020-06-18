<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client\Client;
use App\Models\Client\getList;
use App\Models\Client\getSupplier;
use App\Models\Client\saveClient;
use App\Models\Client\updateClient;
use App\Models\Client\archiveClient;
use App\Models\Client\archivelist;
use App\Models\Client\getClient;
use App\Models\Client\supplierarchiveList;
use Session;
use Validator;
use Redirect;
use SimpleXLSX;
use DB;

class ClientController extends Controller
{
    public function __construct(){
    	$this->middleware('auth');
    }


    public function index(){
    	return view('Client.index');
    }

    public function getClient(int $idno,getClient $action){
      $res = $action->execute($idno);
      return response()->json(['client'=>$res]);
    }

    public function create(){
    	$message = Session::get('message') ?? "";
    	return view('Client.create',compact('message'));
    }

    public function save(Request $req,saveClient $action){
    	$rules = [
            'client' => 'required',
            'address' => 'required',
    		'tin' => '',
    	];

    	$validator = Validator::make($req->all(),$rules);

    	if($validator->fails()){
    		return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
    	}

    	$message = $action->execute($req->all());

    	//Session::put('message',"TEST");
    	return response()->json(['message'=> $message]);
    }


    public function update(Request $req,updateClient $action){
        $rules = [
            'client' => 'required',
            'address' => 'required',
            'tin' => '',
        ];

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
        }

        $message = $action->execute($req->all());

        //Session::put('message',"TEST");
        return response()->json(['message'=> $message]);

    }

    public function archive(int $idno,archiveClient $action,Request $req){
        $action->execute($idno,$req->all());
    }

    public function getClientData(getList $action){
        $clients = $action->execute();
        $counter = 1;
        $data=[];
        foreach($clients as $client){
            $data[] = [
              $counter++,
              $client->name,
              $client->address,
              '<a href="javascript:void(0)" style="color:green"
                              data-id="'.$client->id.'"
                              data-name="'.$client->name.'"
                              data-address="'.$client->address.'"
                              data-tin="'.$client->tin.'"
                              class="editdata"
                              >
                              <span class="fa fa-edit"></span> Edit</a>',
              '<a href="javascript:void(0)" style="color:maroon"
                              data-id="'.$client->id.'"
                              class="archivedata" 
                              >
                              <span class="fa fa-trash-alt"></span> Archive</a>',

          ];
        }


        return response()->json(['aaData'=>$data]);
    }

    public function getSupplierDate(getSupplier $action){
              $clients = $action->execute();
        $counter = 1;
        $data=[];
        foreach($clients as $client){
            $data[] = [
              $counter++,
              $client->name,
              $client->address,
              '<a href="javascript:void(0)" style="color:green"
                              data-id="'.$client->id.'"
                              data-name="'.$client->name.'"
                              data-address="'.$client->address.'"
                              data-tin="'.$client->tin.'"
                              class="editdata"
                              >
                              <span class="fa fa-edit"></span> Edit</a>',
              '<a href="javascript:void(0)" style="color:maroon"
                              data-id="'.$client->id.'"
                              class="archivedata" 
                              >
                              <span class="fa fa-trash-alt"></span> Archive</a>',

          ];
        }


        return response()->json(['aaData'=>$data]);
    }


    public function archiveindex(){
        return view('Client.archive');
    }

    public function archivelist(archiveList $action){
        $clients = $action->execute();
        $counter = 1;
        $data = [];
        foreach($clients as $client){
            $data[] = [
              $counter++,
              $client->name,
              $client->address,
             '<a href="javascript:void(0)" style="color:green"
                          data-id="'.$client->id.'"
                          class="restoredata" 
                          >
                          <span class="fas fa-trash-restore"></span> Restore</a>',
          ];
        }


        return response()->json(['aaData'=>$data]);
    }

        public function supplierarchivelist(supplierarchiveList $action){
        $clients = $action->execute();
        $counter = 1;
        $data = [];
        foreach($clients as $client){
            $data[] = [
              $counter++,
              $client->name,
              $client->address,
             '<a href="javascript:void(0)" style="color:green"
                          data-id="'.$client->id.'"
                          class="restoredata" 
                          >
                          <span class="fas fa-trash-restore"></span> Restore</a>',
          ];
        }


        return response()->json(['aaData'=>$data]);
    }

    public function supplier(){
        return view('supplier.index');
    }

    public function archivesupplier(){
      return view('supplier.archive');
    }

    public function bulkinsert(Request $req){
         $filename =  time().'_'.$req->file('excelfile')->getClientOriginalName();
         $req->file('excelfile')->move(public_path('excel'),$filename);

         $xlsx = SimpleXLSX::parse(public_path('excel').'/'.$filename);
         $xlsx_data = $xlsx->rows();


         DB::beginTransaction();
         try {  
                for($x=0;$x<count($xlsx_data);$x++){
                        if($x > 0){
                            $site = $xlsx_data[$x][0];
                            $address = $xlsx_data[$x][1];
                  
                            $client = new Client;
                            $client->name = $site;
                            $client->address = $address;
                            $client->type = $req->type;
                            $client->save();
                        }
                     }
         }catch (Exception $e){
              DB::rollBack();
              unlink(public_path('excel').'/'.$filename);
              return Redirect::back()->with('error','Something Went Wrong! Please try Again!!');
         }finally {
             DB::commit();
             unlink(public_path('excel').'/'.$filename);
             return Redirect::back()->with('success','Successfu!');
         }
     

        
    }


}
