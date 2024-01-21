<?php

namespace App\Actions\User;

use App\DataObjects\User\UpdateUserData;
use App\Models\User;

class UpdateUserAction
{
    public function handle(UpdateUserData $data): User
    {
        /** @var User $user */
        $user = User::query()->find($data->id);

        $user->name = $data->name;
        $user->email = $data->email;

        $user->save();

        return $user;
    }
}
