<?php

namespace Database\Seeders;

use App\Models\Bot;
use App\Models\Store\Plan;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Plan::query()->truncate();

        // Plans

        $pricingArr = [
            [
                'name' => 'Trial',
                'description' => 'Get free trial plan with only one telegram bot!',
                'price' => 0,
                'bot_count' => 1
            ],
            [
                'name' => 'Standard',
                'description' => 'Get standard plan with three telegram bots!',
                'price' => 7,
                'bot_count' => 3
            ],
            [
                'name' => 'Premium',
                'description' => 'Get premium plan with seven telegram bot!',
                'price' => 10,
                'bot_count' => 7
            ]
        ];

        foreach ($pricingArr as $plan) {
            Plan::query()->create($plan);
        }

        // User

        $me = User::query()->create([
            'name' => 'Davut Sergeev',
            'email' => 'sergeevdavut@mail.ru',
            'bot_limit' => 7,
            'password' => bcrypt('password'),
            'email_verified_at' => now(),
        ]);

        // Bots

        Bot::query()->create([
            'local_name' => 'TestBot',
            'api_key' => Str::random(),
            'config' => [],
            'status' => Bot::STATUS_PENDING,
            'user_id' => $me->id,
            'link' => 'https://t.me/testbot'
        ]);

        Bot::query()->create([
            'local_name' => 'Test2Bot',
            'api_key' => Str::random(),
            'config' => [],
            'status' => Bot::STATUS_PENDING,
            'user_id' => $me->id,
            'link' => 'https://t.me/test2bot'
        ]);

        Bot::query()->create([
            'local_name' => 'Test3Bot',
            'api_key' => Str::random(),
            'config' => [],
            'status' => Bot::STATUS_PENDING,
            'user_id' => $me->id,
            'link' => 'https://t.me/test3bot'
        ]);
    }
}
