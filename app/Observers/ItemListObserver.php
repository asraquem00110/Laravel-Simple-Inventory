<?php

namespace App\Observers;

use App\Models\ItemList\Itemlist;
use App\Traits\CustomMethods;
use App\Models\Setting\getBarcodeSetting; 
class ItemListObserver
{
    /**
     * Handle the itemlist "created" event.
     *
     * @param  \App\Models\ItemList\Itemlist  $itemlist
     * @return void
     */
    public function created(Itemlist $itemlist)
    {   
        if($itemlist->freeStorage != 1){
            $setting = new getBarcodeSetting();
            $zeroformat = $setting->execute();
            // $itemlist->barcode = $itemlist->item->productCode.CustomMethods::fillzeroes($zeroformat->value,$itemlist->id,0);
             $itemlist->barcode = date('Y',time()).CustomMethods::fillzeroes($zeroformat->value,$itemlist->id,0);
            $itemlist->save();  
        }
        
    }

    /**
     * Handle the itemlist "updated" event.
     *
     * @param  \App\Models\ItemList\Itemlist  $itemlist
     * @return void
     */
    public function updated(Itemlist $itemlist)
    {
        //
    }

    /**
     * Handle the itemlist "deleted" event.
     *
     * @param  \App\Models\ItemList\Itemlist  $itemlist
     * @return void
     */
    public function deleted(Itemlist $itemlist)
    {
        //
    }

    /**
     * Handle the itemlist "restored" event.
     *
     * @param  \App\Models\ItemList\Itemlist  $itemlist
     * @return void
     */
    public function restored(Itemlist $itemlist)
    {
        //
    }

    /**
     * Handle the itemlist "force deleted" event.
     *
     * @param  \App\Models\ItemList\Itemlist  $itemlist
     * @return void
     */
    public function forceDeleted(Itemlist $itemlist)
    {
        //
    }
}
