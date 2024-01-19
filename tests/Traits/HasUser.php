<?php

namespace Tests\Traits;

use App\Models\User;

trait HasUser
{
    protected User $user;

    protected function setupUser(): void
    {
        $this->user = User::factory()->create();
    }
}
