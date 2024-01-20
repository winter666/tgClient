<?php

namespace App\Providers;

use App\Events\Bot\CreatedBotEvent;
use App\Events\Bot\UpdateBotEvent;
use App\Listeners\AssignRoleAfterRegistrationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            AssignRoleAfterRegistrationListener::class,
            SendEmailVerificationNotification::class,
        ],
        CreatedBotEvent::class => [
            // CheckUpdates for set active or error status
        ],
        UpdateBotEvent::class => [
            // CheckUpdates for set active or error status
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
