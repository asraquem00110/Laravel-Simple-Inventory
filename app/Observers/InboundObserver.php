<?php

namespace App\Observers;

use App\Models\Inbound\Inbound;
use App\Traits\CustomMethods;
use App\Models\Setting\getInboundSetting;

class InboundObserver
{
    /**
     * Handle the inbound "created" event.
     *
     * @param  \App\Models\Inbound\Inbound  $inbound
     * @return void
     */
    public function created(Inbound $inbound)
    {
        $setting = new getInboundSetting();
        $zeroformat = $setting->execute();
        $inbound->refno =  'IB'.CustomMethods::fillzeroes($zeroformat->value,$inbound->id);
        $inbound->save();
    }

    /**
     * Handle the inbound "updated" event.
     *
     * @param  \App\Models\Inbound\Inbound  $inbound
     * @return void
     */
    public function updated(Inbound $inbound)
    {
        //
    }

    /**
     * Handle the inbound "deleted" event.
     *
     * @param  \App\Models\Inbound\Inbound  $inbound
     * @return void
     */
    public function deleted(Inbound $inbound)
    {
        //
    }

    /**
     * Handle the inbound "restored" event.
     *
     * @param  \App\Models\Inbound\Inbound  $inbound
     * @return void
     */
    public function restored(Inbound $inbound)
    {
        //
    }

    /**
     * Handle the inbound "force deleted" event.
     *
     * @param  \App\Models\Inbound\Inbound  $inbound
     * @return void
     */
    public function forceDeleted(Inbound $inbound)
    {
        //
    }
}
