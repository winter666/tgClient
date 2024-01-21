<?php

namespace Actions\User;

use App\Actions\User\UpdateUserAction;
use App\DataObjects\User\UpdateUserData;
use App\Models\User;
use Tests\TestCase;

class UpdateUserActionTest extends TestCase
{
    /** @test */
    public function it_updates_user()
    {
        /** @var User $user */
        $user = User::factory()->create();

        $userData = User::factory()->make();

        $data = new UpdateUserData(
            id: $user->id,
            name: $userData->name,
            email: $userData->email,
        );

        $this->assertNotSame($user->name, $userData->name);
        $this->assertNotSame($user->email, $userData->email);

        /** @var UpdateUserAction $action */
        $action = app(UpdateUserAction::class);

        // When

        $action->handle($data);

        // Then

        $user->refresh();

        $this->assertSame($user->name, $userData->name);
        $this->assertSame($user->email, $userData->email);
    }
}
