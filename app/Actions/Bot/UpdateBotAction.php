<?php

namespace App\Actions\Bot;

use App\DataObjects\Bot\UpdateBotData;
use App\Enums\BotStatus;
use App\Events\Bot\UpdateBotEvent;
use App\Models\Bot;

class UpdateBotAction
{
    public function handle(Bot $bot, UpdateBotData $data): Bot
    {
        $bot->local_name = $data->localName;
        $bot->api_key = $data->apiKey;
        $bot->link = "https://t.me/{$data->localName}";
        $bot->status = BotStatus::STATUS_PENDING;

        $bot->save();

        event(new UpdateBotEvent($bot));

        return $bot;
    }
}
