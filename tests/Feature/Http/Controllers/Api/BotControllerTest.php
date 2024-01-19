<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Bot;
use Tests\Traits\Permissions\Bot\HasViewPermission;

class BotControllerTest extends ApiTestCase
{
    use HasViewPermission;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupViewBotPermission();
    }

    /** @test */
    public function it_gets_bot_list_test()
    {
        $bots = Bot::factory()
            ->count(10)
            ->create([
                'user_id' => $this->user->id
            ]);

        $jsonFormatStructure = $bots
            ->sortByDesc('id')
            ->values()
            ->map(fn (Bot $bot) => ([
                "id" => $bot->id,
                "local_name" => $bot->local_name,
                "api_key" => $bot->api_key,
                "config" => $bot->config,
                "status" => $bot->status,
                "user_id" => $this->user->id,
                "link" => $bot->link,
            ]))->toArray();

        $response = $this->requestGet('bot/list');

        $response->assertStatus(200);

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => $jsonFormatStructure
            ]);
    }
}
