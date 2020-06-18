<?php

namespace App\Observers;
use App\Models\Outbound\Outbound;
use App\Traits\CustomMethods;
use App\Models\Setting\getOutboundSetting;

class OutboundObserver
{
    /**
     * Handle the outbound "created" event.
     *
     * @param  \App\App\Models\Outbound\Outbound  $outbound
     * @return void
     */
    public function created(Outbound $outbound)
    {
        $setting = new getOutboundSetting();
        $zeroformat = $setting->execute();
        $outbound->refno = 'OB'.CustomMethods::fillzeroes($zeroformat->value,$outbound->id);
        $outbound->save();
    }

    /**
     * Handle the outbound "updated" event.
     *
     * @param  \App\App\Models\Outbound\Outbound  $outbound
     * @return void
     */
    public function updated(Outbound $outbound)
    {
        //
    }

    /**
     * Handle the outbound "deleted" event.
     *
     * @param  \App\App\Models\Outbound\Outbound  $outbound
     * @return void
     */
    public function deleted(Outbound $outbound)
    {
        //
    }

    /**
     * Handle the outbound "restored" event.
     *
     * @param  \App\App\Models\Outbound\Outbound  $outbound
     * @return void
     */
    public function restored(Outbound $outbound)
    {
        //
    }

    /**
     * Handle the outbound "force deleted" event.
     *
     * @param  \App\App\Models\Outbound\Outbound  $outbound
     * @return void
     */
    public function forceDeleted(Outbound $outbound)
    {
        //
    }
}
