<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;
use App\Events\NewItemEvent;
use App\Listeners\AddFreeStorageListener;
use App\Events\NewInboundEvent;
use App\Listeners\AddItemsToTempListener;
use App\Events\AddItemLogsEvent;
use App\Listeners\AddItemLogsListener;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        NewItemEvent::class => [
            AddFreeStorageListener::class,
        ],
        NewInboundEvent::class => [
            AddItemsToTempListener::class,
        ],
        AddItemLogsEvent::class => [
            AddItemLogsListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
