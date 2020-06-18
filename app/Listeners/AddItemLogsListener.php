<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\ItemList\Itemlist;
use App\Models\ItemLogs\Itemlogs;
use Auth;

class AddItemLogsListener
{
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
        $data = $event->data;
        $itemlogs = new ItemLogs;
        $itemlogs->event = $data['event'];
        $itemlogs->item_id = $data['item_id'];
        $itemlogs->itemlist_id = $data['itemlist_id'];
        $itemlogs->oldvalue = $data['oldvalue'];
        $itemlogs->newvalue = $data['newvalue'];
        $itemlogs->inbound_id = $data['inbound_id'];
        $itemlogs->outbound_id = $data['outbound_id'];
        $itemlogs->modifiedby = $data['modifiedby'];
        $itemlogs->remarks = $data['remarks'];
        $itemlogs->save();
    }
}
