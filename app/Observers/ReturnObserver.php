<?php

namespace App\Observers;

use App\Models\Return_\Return_;
use App\Traits\CustomMethods;
use App\Models\Setting\getReturnSetting;

class ReturnObserver
{
    /**
     * Handle the return_ "created" event.
     *
     * @param  \App\Models\Return_\Return_  $return
     * @return void
     */
    public function created(Return_ $return)
    {
        $setting = new getReturnSetting();
        $zeroformat = $setting->execute();
        $return->refNo = 'RE'.CustomMethods::fillzeroes($zeroformat->value,$return->id);
        $return->save();
    }

    /**
     * Handle the return_ "updated" event.
     *
     * @param  \App\Models\Return_\Return_  $return
     * @return void
     */
    public function updated(Return_ $return)
    {
        //
    }

    /**
     * Handle the return_ "deleted" event.
     *
     * @param  \App\Models\Return_\Return_  $return
     * @return void
     */
    public function deleted(Return_ $return)
    {
        //
    }

    /**
     * Handle the return_ "restored" event.
     *
     * @param  \App\Models\Return_\Return_  $return
     * @return void
     */
    public function restored(Return_ $return)
    {
        //
    }

    /**
     * Handle the return_ "force deleted" event.
     *
     * @param  \App\Models\Return_\Return_  $return
     * @return void
     */
    public function forceDeleted(Return_ $return)
    {
        //
    }
}
