<?php

namespace Tests\Traits\Permissions\User;

use App\Enums\PermissionConst;
use Spatie\Permission\Models\Permission;
use Tests\Traits\HasUser;

trait HasUpdatePermission
{
    use HasUser;

    protected function setupUpdateUserPermission()
    {
        if (! isset($this->user)) {
            $this->setupUser();
        }

        $permission = Permission::create([
            'name' => PermissionConst::USER_UPDATE
        ]);

        $this->user->givePermissionTo($permission);
    }
}
