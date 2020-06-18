<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ItemList\Itemlist;
use App\Traits\CustomMethods;
use App\Models\Setting\getBarcodeSetting;

class AddFreeStorageListener
{

    use CustomMethods;
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $getBarcodeSetting = new getBarcodeSetting;
        $bcodezero = $getBarcodeSetting->execute();
        $Itemlist = new Itemlist;
        $Itemlist->item_id = $event->item->id;
        $Itemlist->barcode = "STR".CustomMethods::fillzeroes($bcodezero->value,$event->item->id,0);
        $Itemlist->qrcode = "";
        $Itemlist->serialNumber = "";
        $Itemlist->specs = "";
        $Itemlist->description = "";
        $Itemlist->qty = 0;
        $Itemlist->freeStorage = 1;
        $Itemlist->save();
    }


}
