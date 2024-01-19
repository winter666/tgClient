<?php

namespace App\Policies;

use App\Models\Bot;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class BotPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Bot $bot)
    {
        if ($user->cannot('bot.create')) {
            return false;
        }

        return $user->id === $bot->user_id;
    }

    public function update(User $user, Bot $bot)
    {
        if ($user->cannot('bot.update')) {
            return false;
        }

        return $user->id === $bot->user_id;
    }

    public function view(User $user, Bot $bot)
    {
        if ($user->cannot('bot.view')) {
            return false;
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
        if ($user->cannot('bot.delete')) {
            return false;
        }

        return $user->id === $bot->user_id;
    }
}
