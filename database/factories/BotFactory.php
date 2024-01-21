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
        $name = $this->localName();

        return [
            'local_name' => $name,
            'api_key' => $this->faker->unique()->uuid,
            'config' => [],
            'status' => BotStatus::STATUS_PENDING,
            'user_id' => User::factory(),
            'link' => 'https://t.me/' . $name
        ];
    }

    public function localName()
    {
        return $this->faker->word . 'Bot';
    }
}
