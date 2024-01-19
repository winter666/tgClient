<?php

namespace Http\Controllers\Api;

use Tests\Feature\Http\Controllers\Api\ApiTestCase;
use Tests\Traits\Permissions\User\HasViewPermission;

class UserControllerTest extends ApiTestCase
{
    use HasViewPermission;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setupViewUserPermission();
    }

    /** @test */
    public function it_gets_authorized_user(): void
    {
        $this->requestGet('user/auth')
            ->assertStatus(200)
            ->assertJsonFragment([
                'id' => $this->user->id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'bot_limit' => $this->user->bot_limit,
            ]);
    }
}
