<?php

namespace Tests\Feature\Http\Controllers\Api;

use App\Models\Bot;
use Tests\Traits\Permissions\Bot\HasCreatePermission;
use Tests\Traits\Permissions\Bot\HasViewPermission;

class BotControllerTest extends ApiTestCase
{
    use HasViewPermission;
    use HasCreatePermission;

    public function setUp(): void
    {
        parent::setUp();

        $this->setupViewBotPermission();
        $this->setupCreateBotPermission();
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

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => $jsonFormatStructure
            ]);
    }

    /** @test */
    public function it_create_new_bot()
    {
        $botData = Bot::factory()->make();

        $this->assertEmpty($this->user->bots()->get());

        // When

        $response = $this->requestPost('bot/store', [
            'local_name' => $botData->local_name,
            'api_key' => $botData->api_key,
        ]);

        // Then

        $response->assertStatus(201);

        $this->assertCount(1, $this->user->bots()->get());

        /** @var Bot $bot */
        $bot = $this->user->bots()->first();

        $this->assertSame($bot->local_name, $botData->local_name);
        $this->assertSame($bot->api_key, $botData->api_key);
    }

    /** @test */
    public function it_gets_one_bot()
    {
        /** @var Bot $bot */
        $bot = Bot::factory()
            ->for($this->user)
            ->create();

        $response = $this->requestGet("bot/{$bot->id}");

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'id' => $bot->id,
                    'local_name' => $bot->local_name,
                    'api_key' => $bot->api_key,
                    'config' => $bot->config,
                    'status' => $bot->status,
                    'user_id' => $bot->user->id,
                    'link' => $bot->link
                ]
            ]);
    }

    /** @test */
    public function it_updates_bot()
    {
        /** @var Bot $bot */
        $bot = Bot::factory()
            ->for($this->user)
            ->create();

        $botData = Bot::factory()->make();

        $this->assertNotSame($bot->local_name, $botData->local_name);
        $this->assertNotSame($bot->api_key, $botData->api_key);

        // When

        $response = $this->requestPatch("bot/{$bot->id}", [
            'local_name' => $botData->local_name,
            'api_key' => $botData->api_key,
        ]);

        // Then

        $bot->refresh();

        $response->assertStatus(200)
            ->assertJsonFragment([
                'data' => [
                    'id' => $bot->id,
                    'local_name' => $bot->local_name,
                    'api_key' => $bot->api_key,
                    'config' => $bot->config,
                    'status' => $bot->status,
                    'user_id' => $bot->user->id,
                    'link' => $bot->link
                ]
            ]);

        $this->assertSame($bot->local_name, $botData->local_name);
        $this->assertSame($bot->api_key, $botData->api_key);
    }

    /** @test */
    public function it_deletes_bot()
    {
        /** @var Bot $bot */
        $bot = Bot::factory()
            ->for($this->user)
            ->create();

        $this->assertModelExists($bot);

        // When

        $response = $this->requestDelete("bot/{$bot->id}");

        // Then

        $response->assertStatus(204);

        $this->assertModelMissing($bot);
    }
}
