<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item\getItemData;
use App\Models\ItemList\Itemlist;
use App\Models\Unit\getList;
use App\Models\Item\saveitem;
use App\Models\Item\getItemInfo;
use App\Models\Item\archiveItem;
use App\Models\Item\updateItemInfo;
use App\Models\Item\Item;
use App\Models\Item\getArchive;
use App\Models\Item\manualaddstocks;
use App\Models\ItemList\itemlistmanualadd;
use Validator;
use Redirect;
use SimpleXLSX;
use DB;

use App\Models\Item\ItemViewModel;

class ItemController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }


    public function index(){
        $viewModel = new ItemViewModel();
    	return view('Item.index',compact('viewModel'));
    }

    public function getarchive(){
        return view('Item.archive');
    }

    public function restore(int $idno){
        $item = Item::find($idno);
        $item->archive = 0;
        $res = $item->save();
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function getItemArchive(getArchive $action){
        $items = $action->execute();
        $data=[];
        $x=1;
        foreach($items as $item){
            $data[] = [
                $x++,
                $item->description,
                $item->productCode,
                $item->unitMeasurement,
                '<a href="javascript:void(0)" style="color:green"
                          data-id="'.$item->id.'"
                          class="restoredata" 
                          >
                          <span class="fas fa-trash-restore"></span> Restore</a>',
            ];
        }

        return response()->json(['aaData'=>$data]);
    }

    public function getItemData(string $filter,getItemData $action){
    	$items = $action->execute();
    	$data = [];
    	foreach($items as $item){
    		$image = asset("images/Items/{$item->img}");
    		$url = url();
    		$list = $item->itemList;
    		// $quantity = 0;
    		
    		// foreach($list as $l){
    		// 	$quantity += $l->qty;
    		// }
    		$quantity = Itemlist::getTotal($list);
            $status = "<span style='color:green'>GOOD</span>";
            if($quantity <= $item->warning && $quantity >= $item->danger){
                $status = "<span style='color:orange;'>WARNING</span>";
            }elseif($quantity <= $item->danger && $quantity > 0){
                $status = "<span style='color:maroon;'>LOW</span>";
            }elseif($quantity <= 0){
                $status = "<span style='color:maroon;'>NO STOCK</span>";
            }


            if($filter == "ALL"){
                $data[] = [
            '<img src="'.$image.'" style="width:100px;height:100px;">',
            '<span style="font-weight:bold;font-size: 16pt;">'.$item->description.'</span><br/><span>CODE: '.$item->productCode.'</span>',
            '<span style="font-weight:bold;font-size: 16pt;">'.$quantity.'<br/>'.$status.'</span>',
            '<span style="font-weight:bold;font-size: 16pt;">'.$item->unitMeasurement.'</span>',
            // '<a style="color:green" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-edit"></span> Edit</a>',
            '<a style="color:blue" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-search-plus"></span> Details</a>',
            ];
            }elseif($filter ==  "LOW"){
                if($quantity <= $item->danger && $quantity > 0){
                    $data[] = [
                        '<img src="'.$image.'" style="width:100px;height:100px;">',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->description.'</span><br/><span>CODE: '.$item->productCode.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$quantity.'<br/>'.$status.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->unitMeasurement.'</span>',
                        // '<a style="color:green" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-edit"></span> Edit</a>',
                        '<a style="color:blue" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-search-plus"></span> Details</a>',
                        ];
                }
            }elseif($filter == "NO STOCK"){
                if($quantity <= 0){
                     $data[] = [
                        '<img src="'.$image.'" style="width:100px;height:100px;">',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->description.'</span><br/><span>CODE: '.$item->productCode.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$quantity.'<br/>'.$status.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->unitMeasurement.'</span>',
                        // '<a style="color:green" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-edit"></span> Edit</a>',
                        '<a style="color:blue" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-search-plus"></span> Details</a>',
                        ];
                }
            }elseif($filter == "WARNING"){
                 if($quantity <= $item->warning && $quantity >= $item->danger){
                                  $data[] = [
                        '<img src="'.$image.'" style="width:100px;height:100px;">',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->description.'</span><br/><span>CODE: '.$item->productCode.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$quantity.'<br/>'.$status.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->unitMeasurement.'</span>',
                        // '<a style="color:green" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-edit"></span> Edit</a>',
                        '<a style="color:blue" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-search-plus"></span> Details</a>',
                        ];
                 }
            }else{
                if($quantity > $item->warning){
                     $data[] = [
                        '<img src="'.$image.'" style="width:100px;height:100px;">',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->description.'</span><br/><span>CODE: '.$item->productCode.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$quantity.'<br/>'.$status.'</span>',
                        '<span style="font-weight:bold;font-size: 16pt;">'.$item->unitMeasurement.'</span>',
                        // '<a style="color:green" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-edit"></span> Edit</a>',
                        '<a style="color:blue" href="'.url('item/list/details/'.$item->id.'').'"><span class="fa fa-search-plus"></span> Details</a>',
                        ];
                }
            }

    		
    	}

    	  return response()->json(['aaData'=>$data]);
    }

    public function saveitem(Request $req,saveitem $action){

    		$rules = [
    			'product' => 'required|',
    			// 'productCode' => 'required|unique:Items|min:3',
                'warningStock' => 'required|min:0|numeric',
                'dangerStock' => 'required|min:0|numeric'
    		];

    		$validator = Validator::make($req->all(),$rules);

    		if($validator->fails()){
    			return response()->json(['errors'=> $validator->getMessageBag()->toArray()]);
    		}

    	$message = $action->execute($req);

    	//Session::put('message',"TEST");
    	return response()->json(['message'=> $message]);
    }

    public function updateImage(Request $req){
        $Item = Item::find($req->id);
        $filename =  time().'_'.$req->file('imgfile')->getClientOriginalName();
        $req->file('imgfile')->move(public_path('images/items'),$filename);
        $oldimage = $Item->img;
        if($oldimage != 'default.png'){
             unlink(public_path('images/items/').$oldimage);
        }
        $Item->img = $filename;
        $res = $Item->save();
        return Redirect::back();
    }

    public function getItemListDetails($idno,Request $req){
        $viewModel = new ItemViewModel($idno);
        if($req->barcode == NULL){
            $itemlist = $viewModel->paginateItem();
        }else{
            if($req->barcode == ""){
                return Redirect('item/list/details/'+$idno+'/page=1');
            }else{
             $itemlist = $viewModel->searchItem($req->barcode,$idno);
            }
        }
       
        return view('Item.Iteminfo',compact('viewModel','itemlist'));
    }

    public function archive($idno,archiveItem $action){
        $res = $action->execute($idno);
        $message = $res ? "Successful" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function updateItemInfo(Request $req,updateItemInfo $action){

        if($req->oldcode == $req->productCode){
            $rules = [
                'product' => 'required|',
                'warningStock' => 'required|min:0|numeric',
                'dangerStock' => 'required|min:0|numeric'
            ];
        }else{
            $rules = [
                'product' => 'required|',
                // 'productCode' => 'required|unique:Items|min:3',
                'warningStock' => 'required|min:0|numeric',
                'dangerStock' => 'required|min:0|numeric'
            ];
        }

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $message = $action->execute($req->all()) ? "Success" : "Fail";
        return response()->json(['message'=>$message]);

    }

    public function testitem(){
       
        $items = Item::leftjoin('itemlists','items.id','=','itemlists.item_id')->get();
        foreach($items as $item){
            echo $item->barcode."<hr/>";
            foreach($item->outbound as $obitem){
                echo $obitem->pivot->quantity."<br/>";
            }

        }


    }

    public function manualaddstocks(Request $req, manualaddstocks $action){
        $res = $action->execute($req->all());
        $message = $res ? "success" : "fail";
        return response()->json(['message'=>$message]);
    }

    public function itemlistmanualadd(int $idno,Request $req,itemlistmanualadd $action){

        $rules = [
            'quantity' => 'required|min:1|numeric',
            'remarks' => 'required',
        ];

        if($req->action == "Reduce"){
            $rules['quantity'] = 'required|min:1|numeric|lte:remaining';
        }

        $validator = Validator::make($req->all(),$rules);

        if($validator->fails()){
            return response()->json(['errors'=>$validator->getMessageBag()->toArray()]);
        }

        $res = $action->execute($idno,$req->all());
        $message  = $res ? "success" : "fail";
         return response()->json(['message'=>$message]);

    }


    public function scanbarcodeItem(string $bcode) {
        $res = Itemlist::with(['item'])->where('barcode',trim($bcode))->first();
        return response()->json(['item'=>$res]);
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
                            $product = $xlsx_data[$x][0];
                            $code = $xlsx_data[$x][1];
                            $unit = $xlsx_data[$x][2];
                            $warning = $xlsx_data[$x][3];
                            $low = $xlsx_data[$x][4];

                            $item = new Item;
                            $item->description =  $product;
                            $item->productCode =  $code;
                            $item->unitMeasurement = $unit;
                            $item->warning = $warning;
                            $item->danger = $low;
                            $item->save();
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
