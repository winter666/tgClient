<?php


namespace Database\Seeders;


use App\Enums\PermissionConst;
use App\Enums\RoleConst;
use App\Policies\BotPolicy;
use App\Policies\UserPolicy;
use App\Providers\AuthServiceProvider;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    private const POLICY_MODELS = [
        BotPolicy::class => 'bot',
        UserPolicy::class => 'user',
    ];

    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        /** @var Role $adminRole */
        $adminRole = Role::query()->create([
            'name' => RoleConst::ROLE_SUPER_ADMIN,
        ]);

        /** @var Role $userRole */
        $userRole = Role::query()->create([
            'name' => RoleConst::ROLE_USER
        ]);

        $this->createPermissions();

        $adminRole->syncPermissions(Permission::all());

        $userRole->syncPermissions(
            Permission::query()
                ->whereIn('name', [
                    PermissionConst::BOT_VIEW_ANY,
                    PermissionConst::BOT_VIEW,
                    PermissionConst::BOT_DELETE,
                    PermissionConst::BOT_UPDATE,
                    PermissionConst::BOT_CREATE,
                    PermissionConst::USER_VIEW,
                    PermissionConst::USER_UPDATE,
                ])
                ->get()
        );
    }

    protected function createPermissions()
    {
        $policyClasses = $this->getPolicyClasses();

        $permissions = $this->getPermissions($policyClasses);

        foreach ($permissions as $permission) {
            Permission::query()->firstOrCreate(
                ['name' => $permission]
            );
        }
    }

    protected function getPermissions(array $policyClasses): array
    {
        $permissions = collect();

        foreach ($policyClasses as $policyClass) {
            $modelName = $this->getModelName($policyClass);

            $policyMethods = get_class_methods($policyClass);

            $permissions = collect($policyMethods)
                ->map(
                    fn($method) => "{$modelName}.{$method}"
                )->concat($permissions);
        }

        return $permissions->toArray();
    }

    protected function getPolicyClasses(): array
    {
        return app()->resolveProvider(AuthServiceProvider::class)->policies();
    }

    public function getModelName(string $policyClass): string
    {
        return static::POLICY_MODELS[$policyClass];
    }
}
