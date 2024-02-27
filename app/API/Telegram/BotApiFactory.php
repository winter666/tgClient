<?php

namespace App\API\Telegram;

use App\Models\Bot;

class BotApiFactory
{
    public function make(Bot $bot): BotApi
    {
        return app(BotApi::class, [
            'api_key' => $bot->api_key,
            'base_uri' => config('app.integrations.telegram.base_uri')
        ]);
    }
}
