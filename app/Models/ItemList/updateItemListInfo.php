<?php
namespace App\Models\ItemList;
use App\Models\ItemList\Itemlist;
use Auth;

Class updateItemListInfo {

	public function __construct(){

	}

	public function execute(int $idno,array $data): Object {
		$Itemlist = Itemlist::with(['item','Inbound'])->find($idno);
		$Itemlist->serialNumber = $data['serial'];
		$Itemlist->qrcode = $data['qrcode'];
		$Itemlist->description = $data['description'];
		$Itemlist->qty = $data['qty'];
		$Itemlist->remarks = $data['remarks'];
		$Itemlist->lastmodifiedBy = Auth::User()->name;
		$Itemlist->save();
		return $Itemlist;
	}

}