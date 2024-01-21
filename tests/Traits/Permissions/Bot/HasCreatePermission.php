<?php

namespace Tests\Traits\Permissions\Bot;

use App\Enums\PermissionConst;
use Spatie\Permission\Models\Permission;
use Tests\Traits\HasUser;

trait HasCreatePermission
{
    use HasUser;

    protected function setupCreateBotPermission()
    {
        if (! isset($this->user)) {
            $this->setupUser();
        }

        $botView = Permission::create(['name' => PermissionConst::BOT_CREATE]);

        $this->user->givePermissionTo($botView);
    }
}
