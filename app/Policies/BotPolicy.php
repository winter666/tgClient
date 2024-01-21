<?php

namespace App\Policies;

use App\Models\Bot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class BotPolicy
{
    use HandlesAuthorization;

    public function create(User $user)
    {
        return $user->can('bot.create');
    }

    public function update(User $user, Bot $bot)
    {
        if ($this->viewAdmin($user)) {
            return true;
        }

        return $user->id === $bot->user_id;
    }

    public function view(User $user, Bot $bot)
    {
        if ($this->viewAdmin($user)) {
            return true;
        }

        return $user->id === $bot->user_id;
    }

    public function viewAny(User $user)
    {
        if ($this->viewAdmin($user)) {
            return true;
        }

        return $user->can('bot.viewAny');
    }

    public function viewAdmin(User $user)
    {
        return $user->can('bot.viewAdmin');
    }

    public function delete(User $user, Bot $bot)
    {
        if ($this->viewAdmin($user)) {
            return true;
        }

        return $user->id === $bot->user_id;
    }
}
