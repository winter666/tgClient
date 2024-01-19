<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class UserPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->can('user.create');
    }

    public function update(User $user)
    {
        return $user->can('user.update');
    }

    public function view(User $user)
    {
        return $user->can('user.view');
    }

    public function viewAny(User $user)
    {
        return $user->can('user.viewAny');
    }

    public function delete(User $user)
    {
        return $user->can('user.delete');
    }
}
