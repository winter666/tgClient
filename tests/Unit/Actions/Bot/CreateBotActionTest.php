<?php

namespace Actions\Bot;

use App\Actions\Bot\CreateBotAction;
use App\DataObjects\Bot\CreateBotData;
use App\Enums\BotStatus;
use App\Events\Bot\CreatedBotEvent;
use App\Exceptions\User\ReachedBotLimitException;
use App\Models\Bot;
use App\Models\User;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CreateBotActionTest extends TestCase
{
    protected CreateBotAction $action;

    protected function setUp(): void
    {
        parent::setUp();

        $this->action = app(CreateBotAction::class);
    }

    /** @test */
    public function it_creates_bot()
    {
        Event::fake();

        $user = User::factory()->create();

        $this->assertEmpty($user->bots);

        $data = new CreateBotData(
            local_name: $this->faker->userName . 'Bot',
            api_key: $this->faker->uuid,
            user: $user
        );

        // When

        $this->action->handle($data);

        // Then

        $this->assertCount(1, $user->bots()->get());

        /** @var Bot $bot */
        $bot = $user->bots()->first();

        $this->assertSame($data->localName, $bot->local_name);
        $this->assertSame($data->apiKey, $bot->api_key);
        $this->assertSame(BotStatus::STATUS_PENDING, $bot->status);

        Event::assertDispatched(
            CreatedBotEvent::class,
            fn (CreatedBotEvent $event) => $bot->is($event->bot)
        );
    }

    /** @test */
    public function it_throws_reached_bot_limit_exception()
    {
        $limit = 5;

        $user = User::factory()->create(['bot_limit' => $limit]);

        Bot::factory()
            ->for($user)
            ->count($limit)
            ->create();

        $this->assertCount($limit, $user->bots()->get());

        $data = new CreateBotData(
            local_name: $this->faker->userName . 'Bot',
            api_key: $this->faker->uuid,
            user: $user
        );

        // When/Then

        $this->expectException(ReachedBotLimitException::class);

        $this->action->handle($data);
    }
}
