<?php

namespace App\Listeners;

use App\Enums\RoleConst;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Spatie\Permission\Models\Role;

class AssignRoleAfterRegistrationListener
{
    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(Registered $event)
    {
        /** @var User $user */
        $user = $event->user;

        $userRole = Role::findByName(RoleConst::ROLE_USER);

        $user->assignRole($userRole);
    }
}
