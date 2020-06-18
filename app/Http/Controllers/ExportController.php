<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item\ItemViewModel;
use App\Models\Export\Itemlist;
use App\Models\Export\ItemlistDetailed;
use App\Models\Export\InboundSite;
use App\Models\Export\InboundItem;
use App\Models\Export\InboundRef;
use App\Models\Export\OutboundSite;
use App\Models\Export\OutboundItem;
use App\Models\Export\OutboundRef;
use App\Models\Export\DeliverySite;
use App\Models\Export\DeliveryItem;
use App\Models\Export\DeliveryRef;
use App\Models\Export\ReturnRef;
use App\Models\Export\ReturnItem;
use App\Models\Export\ReturnSite;
use App\Models\Reports\ReportViewModel;
use App\Models\Client\Client;
use App\Models\Item\Item;

class ExportController extends Controller
{
   public function __construct(){
   	$this->middleware('auth');
   }

   public function exportItemList(Itemlist $action){
   		$action->execute();
   }

   public function exportItemListDetailed(ItemlistDetailed $action){
   		$action->execute();
   }

   public function Inbound($datefrom,$dateto,$type){
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
          // return view('reports.inbound.ref',compact('viewModel','field'));
      	$others = NULL;
      	$action = new InboundRef;
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $others = $viewModel->getItems();
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $others = Item::whereIn('id',$itemID)->get();
          }

          $action = new InboundItem;
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $others = Client::active()->supplier()->get();
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $others = Client::whereIn('id',$sitesID)->get();
          }

          $action = new InboundSite;
      }

      $action->execute($viewModel,$field,$others);

   }


   public function Outbound($datefrom,$dateto,$type){
   	  $viewModel = new ReportViewModel;
  	  $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
          	$others = NULL;
          	 $action = new OutboundRef;
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $others = $viewModel->getItems();
             
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $others = Item::whereIn('id',$itemID)->get();
          
          }

          $action = new OutboundItem;
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $others = Client::active()->site()->get();
            
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $others = Client::whereIn('id',$sitesID)->get();
           
          }
          $action = new OutboundSite;
      }

      $action->execute($viewModel,$field,$others);

   }

   public function Delivery($datefrom,$dateto,$type){
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
            $others = NULL;
             $action = new DeliveryRef;
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $others = $viewModel->getItems();
            
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $others = Item::whereIn('id',$itemID)->get();
  
          }
         $action = new DeliveryItem;
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $others = Client::active()->site()->get();
            
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $others = Client::whereIn('id',$sitesID)->get();
  
          }
            $action = new DeliverySite;
      }


       $action->execute($viewModel,$field,$others);

   }

   public function Returnitem($datefrom,$dateto,$type){
      $viewModel = new ReportViewModel;
      $field = (object)['datefrom'=>$datefrom,'dateto'=>$dateto,'type'=>$type];
      if($type=='a'){
            $others = NULL;
             $action = new ReturnRef;
      }elseif($type=='b'){
          if(Session('selecttype') == "ALL"){
             $others = $viewModel->getItems();
            
          }else{
             $itemID = explode(",", Session('selecteditem'));
             $others = Item::whereIn('id',$itemID)->get();
  
          }
         $action = new ReturnItem;
         
      }else{
          if(Session('selecttypeSupplier') == "ALL"){
             $others = Client::active()->site()->get();
            
          }else{
             $sitesID = explode(",", Session('selectedsupplier'));
             $others = Client::whereIn('id',$sitesID)->get();
  
          }
            $action = new ReturnSite;
      }


       $action->execute($viewModel,$field,$others);

   }
}
