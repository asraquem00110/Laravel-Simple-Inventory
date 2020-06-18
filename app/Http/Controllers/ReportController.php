<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use App\Models\Reports\ReportViewModel;
use Session;
use App\Models\Item\Item;
use App\Models\Client\Client;
use App;

class ReportController extends Controller
{
  	private $viewModel = NULL;

  	public function __construct(ReportViewModel $reportviewmodel){
  		$this->middleware('auth');
  		$this->viewModel = $reportviewmodel;
  	}

  	public function index(){
      $viewModel = new ReportViewModel;
  		return view('reports.index',compact('viewModel'));
  	}

  	public function validation(Request $req){

  		$rules = [
  			'datefrom' => 'required|date',
  			'dateto' => 'required|after_or_equal:datefrom',
  		];

      if($req->selecttype == "SELECT"){
        $rules['selectitem'] = 'required';
        Session(['selecteditem'=> $req->selectitem]);
      }

      if($req->selecttypeSupplier == "SELECT"){
        $rules['selectsupplier'] = 'required';
        Session(['selectedsupplier'=> $req->selectsupplier]);
      }

       Session(['selecttype'=> $req->selecttype]);
       Session(['selecttypeSupplier'=> $req->selecttypeSupplier]);


  		$validator = Validator::make($req->all(),$rules);

  		if($validator->fails()){
  			return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
  		}

  		return response()->json(['message'=> 'success']);
  	}

  	public function outbound($datefrom,$dateto,$type){
  		$viewModel = new ReportViewModel;
  		$field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
          return view('reports.outbound.ref',compact('viewModel','field'));
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $items = $viewModel->getItems();
           }else{
             $itemID = explode(",", Session('selecteditem'));
             $items = Item::whereIn('id',$itemID)->get();
          }
           return view('reports.outbound.itemnew',compact('viewModel','field','items'));
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $sites = Client::active()->site()->get();
           
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $sites = Client::whereIn('id',$sitesID)->get();
          }
            return view('reports.outbound.sites',compact('viewModel','field','sites'));
      }
  	
  	}

    public function inbound($datefrom,$dateto,$type){
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
          return view('reports.inbound.ref',compact('viewModel','field'));
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $items = $viewModel->getItems();
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $items = Item::whereIn('id',$itemID)->get();             
          }
          return view('reports.inbound.item',compact('viewModel','field','items'));
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $sites = Client::active()->supplier()->get();
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $sites = Client::whereIn('id',$sitesID)->get(); 
          }
          return view('reports.inbound.sites',compact('viewModel','field','sites'));
      }
    }


    public function delivery($datefrom,$dateto,$type){
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
          return view('reports.delivery.ref',compact('viewModel','field'));
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $items = $viewModel->getItems();
            
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $items = Item::whereIn('id',$itemID)->get();
  
          }
           return view('reports.delivery.item',compact('viewModel','field','items'));
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $sites = Client::active()->site()->get();
            
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $sites = Client::whereIn('id',$sitesID)->get();
  
          }
           return view('reports.delivery.sites',compact('viewModel','field','sites'));
      }
    }

    public function returnItem($datefrom,$dateto,$type){
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
          return view('reports.returnitem.ref',compact('viewModel','field'));
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $items = $viewModel->getItems();
            
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $items = Item::whereIn('id',$itemID)->get();
  
          }
           return view('reports.returnitem.item',compact('viewModel','field','items'));
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $sites = Client::active()->site()->get();
            
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $sites = Client::whereIn('id',$sitesID)->get();
  
          }
           return view('reports.returnitem.sites',compact('viewModel','field','sites'));
      }
    }


    public function inboundPdf($datefrom,$dateto,$type){
      $pdf = App::make('dompdf.wrapper');
       
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
          
          $pdf->loadView('reports.inbound.refPDF',compact('viewModel','field'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Inbound_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $items = $viewModel->getItems();
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $items = Item::whereIn('id',$itemID)->get();
          }
           $pdf->loadView('reports.inbound.itemPDF',compact('viewModel','field','items'))->setPaper('letter', 'landscape')->setWarnings(false);
           return $pdf->stream("Inbound_Reports_Per_Item_From_".$datefrom."_To_".$dateto.".pdf");
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $sites = Client::active()->supplier()->get();
            
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $sites = Client::whereIn('id',$sitesID)->get();
            
          }

           $pdf->loadView('reports.inbound.sitePDF',compact('viewModel','field','sites'))->setPaper('letter', 'landscape')->setWarnings(false);
           return $pdf->stream("Inbound_Reports_Per_Site_From_".$datefrom."_To_".$dateto.".pdf");
      }
    }


    public function outboundPdf($datefrom,$dateto,$type){
       $pdf = App::make('dompdf.wrapper');
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
           $pdf->loadView('reports.outbound.refPDF',compact('viewModel','field'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Outbound_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $items = $viewModel->getItems();
           }else{
             $itemID = explode(",", Session('selecteditem'));
             $items = Item::whereIn('id',$itemID)->get();
          }
           $pdf->loadView('reports.outbound.itemPDF',compact('viewModel','field','items'))->setPaper('letter', 'landscape')->setWarnings(false);
           return $pdf->stream("Outbound_Reports_Per_Item_From_".$datefrom."_To_".$dateto.".pdf");
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $sites = Client::active()->site()->get();
           
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $sites = Client::whereIn('id',$sitesID)->get();
          }
          $pdf->loadView('reports.outbound.sitePDF',compact('viewModel','field','sites'))->setPaper('letter', 'landscape')->setWarnings(false);
           return $pdf->stream("Outbound_Reports_Per_Site_From_".$datefrom."_To_".$dateto.".pdf");
      }
    
    }


    public function deliveryPdf($datefrom,$dateto,$type){
       $pdf = App::make('dompdf.wrapper');
        $viewModel = new ReportViewModel;
        $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
        if($type=='a'){
           $pdf->loadView('reports.delivery.refPDF',compact('viewModel','field'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Delivery_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
        }elseif($type=='b'){
            if(Session('selecttype') == "ALL"){
               $items = $viewModel->getItems();
              
            }else{
               $itemID = explode(",", Session('selecteditem'));
               $items = Item::whereIn('id',$itemID)->get();
    
            }
              $pdf->loadView('reports.delivery.itemPDF',compact('viewModel','field','items'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Delivery_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
           
        }else{
            if(Session('selecttypeSupplier') == "ALL"){
               $sites = Client::active()->site()->get();
              
            }else{
               $sitesID = explode(",", Session('selectedsupplier'));
               $sites = Client::whereIn('id',$sitesID)->get();
    
            }
             $pdf->loadView('reports.delivery.sitePDF',compact('viewModel','field','sites'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Delivery_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
        }
    }

    public function returnPdf($datefrom,$dateto,$type){
        $pdf = App::make('dompdf.wrapper');
        $viewModel = new ReportViewModel;
        $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
        if($type=='a'){
           $pdf->loadView('reports.returnitem.refPDF',compact('viewModel','field'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Return_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
        }elseif($type=='b'){
            if(Session('selecttype') == "ALL"){
               $items = $viewModel->getItems();
              
            }else{
               $itemID = explode(",", Session('selecteditem'));
               $items = Item::whereIn('id',$itemID)->get();
    
            }
              $pdf->loadView('reports.returnitem.itemPDF',compact('viewModel','field','items'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Return_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
           
        }else{
            if(Session('selecttypeSupplier') == "ALL"){
               $sites = Client::active()->site()->get();
              
            }else{
               $sitesID = explode(",", Session('selectedsupplier'));
               $sites = Client::whereIn('id',$sitesID)->get();
    
            }
          $pdf->loadView('reports.returnitem.sitePDF',compact('viewModel','field','sites'))->setPaper('letter', 'landscape')->setWarnings(false);
          return $pdf->stream("Return_Reports_Daily_From_".$datefrom."_To_".$dateto.".pdf");
        }

    }


}
