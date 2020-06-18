<?php

namespace App\Observers;

use App\Models\Dispatch\Dispatch;
use App\Traits\CustomMethods;
use App\Models\Setting\getDispatchSetting;


class DispatchObserver
{
    /**
     * Handle the dispatch "created" event.
     *
     * @param  \App\Models\Dispatch\Dispatch  $dispatch
     * @return void
     */
    public function created(Dispatch $dispatch)
    {
        $setting = new getDispatchSetting();
        $zeroformat = $setting->execute();
        $dispatch->refNo = 'DR'.CustomMethods::fillzeroes($zeroformat->value,$dispatch->id);
        $dispatch->save();
    }

    /**
     * Handle the dispatch "updated" event.
     *
     * @param  \App\Models\Dispatch\Dispatch  $dispatch
     * @return void
     */
    public function updated(Dispatch $dispatch)
    {
        //
    }

    /**
     * Handle the dispatch "deleted" event.
     *
     * @param  \App\Models\Dispatch\Dispatch  $dispatch
     * @return void
     */
    public function deleted(Dispatch $dispatch)
    {
        //
    }

    /**
     * Handle the dispatch "restored" event.
     *
     * @param  \App\Models\Dispatch\Dispatch  $dispatch
     * @return void
     */
    public function restored(Dispatch $dispatch)
    {
        //
    }

    /**
     * Handle the dispatch "force deleted" event.
     *
     * @param  \App\Models\Dispatch\Dispatch  $dispatch
     * @return void
     */
    public function forceDeleted(Dispatch $dispatch)
    {
        //
    }
}
