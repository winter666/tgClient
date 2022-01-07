<?php

namespace App\Jobs;

use App\Models\Bot;
use App\Services\BotService;
use App\Services\TAPI\TelegramApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BotCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bot;
    private $telegramApi;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
        $this->telegramApi = new TelegramApi($bot->api_token);
        $this->connection = 'redis';
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // TODO: setWebhook
        $this->telegramApi->setWebhook([
            'url' => env('APP_URL') . '/api/bot/webhook/' . $this->bot->id
        ]);
    }
}
