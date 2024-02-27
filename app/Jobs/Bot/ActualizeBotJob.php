<?php

namespace App\Jobs\Bot;

use App\Actions\Bot\ActualizeBotAction;
use App\Models\Bot;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ActualizeBotJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @param Bot $bot
     */
    public function __construct(
        protected Bot $bot
    ) {
        //
    }

    /**
     * Execute the job.
     *
     * @param ActualizeBotAction $action
     * @return void
     */
    public function handle(ActualizeBotAction $action)
    {
        $action->handle($this->bot);
    }
}
