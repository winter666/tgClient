<?php

namespace App\Actions\Bot;

use App\DataObjects\Bot\CreateBotData;
use App\Enums\BotStatus;
use App\Events\Bot\CreatedBotEvent;
use App\Exceptions\User\ReachedBotLimitException;
use App\Models\Bot;

class CreateBotAction
{
    /**
     * @param CreateBotData $data
     *
     * @throws ReachedBotLimitException
     */
    public function handle(CreateBotData $data)
    {
        $user = $data->user;

        throw_if($user->botLimitIsOut(), new ReachedBotLimitException());

        /** @var Bot $bot */
        $bot = Bot::query()->create([
            'local_name' => $data->localName,
            'link' => "https://t.me/{$data->localName}",
            'api_key' => $data->apiKey,
            'status' => BotStatus::STATUS_PENDING,
            'user_id' => $user->id,
            'config' => []
        ]);

        event(new CreatedBotEvent($bot));
    }
}
