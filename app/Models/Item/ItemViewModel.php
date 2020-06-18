<?php

namespace App\Models\Item;

use Spatie\ViewModels\ViewModel;
use App\Models\Unit\getList;
use App\Models\Item\getItemInfo;
use App\Models\Item\getArchive;
use App\Models\ItemList\Itemlist;

class ItemViewModel extends ViewModel
{
	private $idno;
	private $units;
	private $item;

    public function __construct(int $idno = null)
    {
        $this->idno = $idno;
    }

    public function units(): object{
    	$action = new getList;
    	$this->units = $action->execute();
    	return $this->units;
    }

    public function item(): Item {
    	$action = new getItemInfo;
    	$this->item = $action->execute($this->idno);
    	return $this->item;

    }	

    public function archive(): object {
        $action = new getArchive;
        $this->item = $action->execute();
        return $this->item;
    }

    public function paginateItem(): object {
        $items = Itemlist::barcode()->where('item_id',$this->idno)->orderby('qty','desc')->simplepaginate(50);
        $this->item = $items;
        return $this->item;
    }

    public function searchItem(string $bcode,int $itemid): object {
        $items = ItemList::barcode()->whereRaw('barcode = ? AND item_id = ?',[$bcode,$itemid])->simplepaginate(50);
        $this->item = $items;
        return $this->item;
    }
}
