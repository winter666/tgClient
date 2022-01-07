<?php

namespace App\Services;

use App\Jobs\BotCreatedJob;
use App\Models\Bot;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class BotService
{

    public function createBot(User $user, $data) {
        $bot = Bot::create([
            'local_name' => $data['local_name'],
            'api_key' => $data['api_key'],
            'status' => Bot::STATUS_PENDING,
            'user_id' => $user->id
        ]);

        try {
            BotCreatedJob::dispatchIf($user->bot_limit > 0, $bot);
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
        }
    }

    public function getAllPending() {
        return Bot::query()
            ->where('status', Bot::STATUS_PENDING)
            ->get();
    }

}
