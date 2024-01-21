<?php

namespace Actions\Bot;

use App\Actions\Bot\UpdateBotAction;
use App\DataObjects\Bot\UpdateBotData;
use App\Events\Bot\UpdateBotEvent;
use App\Models\Bot;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class UpdateBotActionTest extends TestCase
{
    /** @test */
    public function it_update_bot()
    {
        Event::fake();

        /** @var Bot $bot */
        $bot = Bot::factory()->create();

        $botData = Bot::factory()->make();

        $data = new UpdateBotData(
            local_name: $botData->local_name,
            api_key: $botData->api_key,
        );

        $this->assertNotSame($bot->local_name, $botData->local_name);
        $this->assertNotSame($bot->api_key, $botData->api_key);
        $this->assertNotSame($bot->link, "https://t.me/{$botData->local_name}");

        /** @var UpdateBotAction $action */
        $action = app(UpdateBotAction::class);

        // When

        $action->handle($bot, $data);

        // Then

        $this->assertSame($bot->local_name, $botData->local_name);
        $this->assertSame($bot->api_key, $botData->api_key);
        $this->assertSame($bot->link, "https://t.me/{$botData->local_name}");

        Event::assertDispatched(
            UpdateBotEvent::class,
            fn(UpdateBotEvent $event) => $bot->is($event->bot)
        );
    }
}
