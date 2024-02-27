<?php

namespace App\Listeners\Bot;

use App\Actions\Bot\ActualizeBotAction;
use App\Events\Bot\CreatedBotEvent;
use App\Events\Bot\UpdateBotEvent;
use App\Jobs\Bot\ActualizeBotJob;

class ActualizeBotListener
{
    /**
     * Create the event listener.
     *
     * @param ActualizeBotAction $action
     */
    public function __construct(
        protected ActualizeBotAction $action
    ) {
        //
    }

    /**
     * Handle the event.
     *
     * @param CreatedBotEvent|UpdateBotEvent $event
     * @return void
     */
    public function handle(CreatedBotEvent|UpdateBotEvent $event)
    {
        dispatch(new ActualizeBotJob($event->bot));
    }
}
