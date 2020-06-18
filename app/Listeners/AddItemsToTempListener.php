<?php

namespace App\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Models\Temp\Temp;    

class AddItemsToTempListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle($event)
    {
        $items = $event->itemdata["item"];
        $quantity = $event->itemdata["quantity"];
        $remarks = $event->itemdata["remarks"];
        $hasbarcode = $event->itemdata["hasbarcode"];
        $inboundid = $event->inbound->id;
        $data = [];

        for($x=0;$x<count($items);$x++){
            $data[] = [
                'inbound_id' => $inboundid,
                'item_id' => $items[$x],
                'hasbarcode' => $hasbarcode[$x],
                'quantity' => $quantity[$x],
                'remarks' => $remarks[$x],
                'created_at' => date('Y-m-d H:i:s'),
            ];
        }

        Temp::insert($data);

    }
}
