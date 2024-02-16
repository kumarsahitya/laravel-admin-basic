<?php

namespace Database\Seeders;

use App\Traits\Database\DisableForeignKeys;
use App\Traits\Database\TruncateTable;
use Database\Seeders\Auth\PermissionRoleTableSeeder;
use Database\Seeders\Auth\PermissionsTableSeeder;
use Database\Seeders\Auth\RolesTableSeeder;
use Illuminate\Database\Seeder;

class AuthTableSeeder extends Seeder
{
    use DisableForeignKeys;
    use TruncateTable;

    public function run(): void
    {
        $this->disableForeignKeys();

        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $this->truncateMultiple([
            config('permission.table_names.model_has_permissions'),
            config('permission.table_names.model_has_roles'),
            config('permission.table_names.role_has_permissions'),
            config('permission.table_names.permissions'),
            config('permission.table_names.roles'),
            'users',
        ]);

        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(PermissionRoleTableSeeder::class);

        $this->enableForeignKeys();
    }
}
