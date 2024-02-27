<?php

namespace App\Actions\Bot;

use App\API\Telegram\BotApiFactory;
use App\Enums\BotStatus;
use App\Models\Bot;
use Throwable;

class ActualizeBotAction
{
    public function __construct(
        protected BotApiFactory $botApiFactory,
    ) {
        //
    }

    public function handle(Bot $bot)
    {
        try {
            $botApi = $this->botApiFactory->make($bot);

            $data = $botApi->getMe();

            $status = $data->ok ? BotStatus::STATUS_ACTIVE : BotStatus::STATUS_ERROR;

            if ($bot->external_id !== $data->result->id) {
                $bot->external_id = $data->result->id;
            }

            $bot->status = $status;

            $bot->save();
        } catch (Throwable $e) {
            report($e);
        }
    }
}
