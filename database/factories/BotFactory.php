<?php

namespace Database\Factories;

use App\Enums\BotStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class BotFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'local_name' => $this->faker->userName,
            'api_key' => $this->faker->unique()->uuid,
            'config' => [],
            'status' => BotStatus::STATUS_PENDING,
            'user_id' => User::factory(),
            'link' => 'https://t.me/' . $this->faker->unique()->uuid
        ];
    }
}
