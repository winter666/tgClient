<?php


namespace Database\Seeders;


use App\Enums\PermissionConst;
use App\Enums\RoleConst;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    public const PERMISSIONS = [
        PermissionConst::BOT_CREATE,
        PermissionConst::BOT_VIEW,
        PermissionConst::BOT_VIEW_ANY,
        PermissionConst::BOT_UPDATE,
        PermissionConst::BOT_DELETE,

        PermissionConst::USER_CREATE,
        PermissionConst::USER_VIEW,
        PermissionConst::USER_VIEW_ANY,
        PermissionConst::USER_UPDATE,
        PermissionConst::USER_DELETE,
    ];

    public function run()
    {
        // Permissions

        foreach (self::PERMISSIONS as $permission) {
            Permission::query()->create([
                'name' => $permission
            ]);
        }

        // Role

        /** @var Role $adminRole */
        $adminRole = Role::query()->create([
            'name' => RoleConst::ROLE_SUPER_ADMIN,
        ]);

        /** @var Role $userRole */
        $userRole = Role::query()->create([
            'name' => RoleConst::ROLE_USER
        ]);

        $adminRole->syncPermissions(self::PERMISSIONS);

        $userRole->syncPermissions([
            PermissionConst::BOT_CREATE,
            PermissionConst::BOT_VIEW,
            PermissionConst::BOT_VIEW_ANY,
            PermissionConst::BOT_UPDATE,
            PermissionConst::BOT_DELETE,

            PermissionConst::USER_VIEW,
            PermissionConst::USER_UPDATE,
        ]);
    }
}
