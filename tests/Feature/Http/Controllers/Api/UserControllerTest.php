<?php

namespace Http\Controllers\Api;

use App\Models\User;
use Tests\Feature\Http\Controllers\Api\ApiTestCase;
use Tests\Traits\Permissions\User\HasUpdatePermission;
use Tests\Traits\Permissions\User\HasViewPermission;

class UserControllerTest extends ApiTestCase
{
    use HasViewPermission;
    use HasUpdatePermission;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setupViewUserPermission();
        $this->setupUpdateUserPermission();
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

    /** @test */
    public function it_updates_user()
    {
        $userData = User::factory()->make();

        $this->assertNotSame($this->user->name, $userData->name);
        $this->assertNotSame($this->user->email, $userData->email);

        // When

        $response = $this->requestPatch("user/{$this->user->id}/update", [
            'name' => $userData->name,
            'email' => $userData->email,
        ]);

        // Then

        $this->user->refresh();

        $response->assertStatus(200);

        $this->assertSame($this->user->name, $userData->name);
        $this->assertSame($this->user->email, $userData->email);
    }
}
