<?php

namespace App\Http\Controllers\Api;

use App\Actions\User\UpdateUserAction;
use App\DataObjects\User\UpdateUserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserUpdateFormRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserController extends Controller
{
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    public function authorized(Request $request): JsonResource
    {
        return UserResource::make($request->user());
    }

    public function update(
        User $user,
        UserUpdateFormRequest $request,
        UpdateUserAction $action
    ): JsonResource
    {
        $updatedUser = $action->handle(
            new UpdateUserData(
                id: $user->id,
                name: $request->get('name'),
                email: $request->get('email')
            )
        );

        return UserResource::make($updatedUser);
    }
}
