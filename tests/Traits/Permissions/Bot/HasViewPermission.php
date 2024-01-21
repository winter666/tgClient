<?php

namespace Tests\Traits\Permissions\Bot;

use App\Enums\PermissionConst;
use Spatie\Permission\Models\Permission;
use Tests\Traits\HasUser;

trait HasViewPermission
{
    use HasUser;

    protected function setupViewBotPermission()
    {
        if (! isset($this->user)) {
            $this->setupUser();
        }

        $botView = Permission::create(['name' => PermissionConst::BOT_VIEW]);
        $botViewAny = Permission::create(['name' => PermissionConst::BOT_VIEW_ANY]);

        $this->user->givePermissionTo($botView);
        $this->user->givePermissionTo($botViewAny);
    }
}
