<?php

namespace App\Actions\Bot;

use App\DataObjects\Bot\UpdateBotData;
use App\Models\Bot;

class UpdateBotAction
{
    public function handle(Bot $bot, UpdateBotData $data): Bot
    {
        $bot->local_name = $data->localName;
        $bot->api_key = $data->apiKey;
        $bot->link = "https://t.me/{$data->localName}";

        $bot->save();

        return $bot;
    }
}
