<?php

namespace Database\Seeders;

use App\Models\Store\Plan;
use Illuminate\Database\Seeder;

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
    }
}
