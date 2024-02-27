<?php

namespace App\Providers;

use App\Events\Bot\CreatedBotEvent;
use App\Events\Bot\UpdateBotEvent;
use App\Listeners\AssignRoleAfterRegistrationListener;
use App\Listeners\Bot\ActualizeBotListener;
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
            ActualizeBotListener::class,
        ],
        UpdateBotEvent::class => [
            ActualizeBotListener::class,
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
