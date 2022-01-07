<?php

namespace App\Services;

use App\Jobs\BotCreatedJob;
use App\Models\Bot;

class BotService
{

    public function createBot($data) {
        $bot = Bot::create([
            'local_name' => $data['local_name'],
            'api_key' => $data['api_key'],
            'status' => Bot::STATUS_PENDING,
            'user_id' => $data['user_id']
        ]);

        BotCreatedJob::dispatch($bot);
    }

    public function getAllPending() {
        return Bot::query()
            ->where('status', Bot::STATUS_PENDING)
            ->get();
    }

}
