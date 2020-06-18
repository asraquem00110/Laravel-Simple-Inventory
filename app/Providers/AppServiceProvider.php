<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Schema;
use App\Models\Item\Item;
use App\Observers\ItemObserver;
use App\Models\Inbound\Inbound;
use App\Observers\InboundObserver;
use App\Models\ItemList\Itemlist;
use App\Observers\ItemListObserver;
use App\Models\Outbound\Outbound;
use App\Observers\OutboundObserver;
use App\Models\Dispatch\Dispatch;
use App\Observers\DispatchObserver;
use App\Models\Return_\Return_;
use App\Observers\ReturnObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);
         Item::observe(ItemObserver::class);
         Inbound::observe(InboundObserver::class);
         Itemlist::observe(ItemListObserver::class);
         Outbound::observe(OutboundObserver::class);
         Dispatch::observe(DispatchObserver::class);
         Return_::observe(ReturnObserver::class);
    }
}
