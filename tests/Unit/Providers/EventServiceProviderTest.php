<?php

namespace Providers;

use App\Listeners\AssignRoleAfterRegistrationListener;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class EventServiceProviderTest extends TestCase
{
    /** @test */
    public function it_checks_event_listeners()
    {
        Event::fake();

        Event::assertListening(
            Registered::class,
            AssignRoleAfterRegistrationListener::class
        );
    }
}
