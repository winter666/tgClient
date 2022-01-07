<?php

namespace App\Jobs;

use App\Models\Bot;
use App\Services\BotService;
use App\Services\TAPI\TelegramApi;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class BotCreatedJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $bot;
//    private $telegramApi;

    public function __construct(Bot $bot)
    {
        $this->bot = $bot;
//        $this->connection = 'redis';
    }

    public function handle()
    {
        $user = $this->bot->user;
        $user->bot_limit--;
        $user->save();
        $telegramApi = new TelegramApi($this->bot->api_key);
        // TODO: setWebhook
        /*$this->telegramApi->setWebhook([
            'url' => env('APP_URL') . '/api/bot/webhook/' . $this->bot->id
        ]);*/
    }
}
