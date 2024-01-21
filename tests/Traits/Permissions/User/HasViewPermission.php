<?php

namespace Tests\Traits\Permissions\User;

use App\Enums\PermissionConst;
use Spatie\Permission\Models\Permission;
use Tests\Traits\HasUser;

trait HasViewPermission
{
    use HasUser;

    protected function setupViewUserPermission()
    {
        if (! isset($this->user)) {
            $this->setupUser();
        }

        $permission = Permission::create([
            'name' => PermissionConst::USER_VIEW
        ]);

        $this->user->givePermissionTo($permission);
    }
}
