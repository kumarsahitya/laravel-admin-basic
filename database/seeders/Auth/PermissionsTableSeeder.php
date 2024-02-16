<?php

namespace Database\Seeders\Auth;

use App\Models\admin\User\Permission;
use App\Traits\Database\DisableForeignKeys;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    use DisableForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();

        Permission::query()->create([
            'name' => 'access_dashboard',
            'group_name' => 'system',
            'display_name' => __('Access Dashboard'),
            'description' => __('This permission allow user to access to the dashboard.'),
            'can_be_removed' => false,
        ]);

        Permission::query()->create([
            'name' => 'access_setting',
            'group_name' => 'system',
            'display_name' => __('Access Setting'),
            'description' => __('This permission allow user to view the setting page.'),
            'can_be_removed' => false,
        ]);

        Permission::query()->create([
            'name' => 'view_users',
            'group_name' => 'system',
            'display_name' => __('Views Users'),
            'description' => __('This permission allow user to access to the administrator area.'),
            'can_be_removed' => false,
        ]);

        Permission::query()->create([
            'name' => 'impersonate',
            'group_name' => 'system',
            'display_name' => __('Impersonate User'),
            'description' => __('This permission allow user to logged with the account of another user.'),
            'can_be_removed' => false,
        ]);

        /*
         * Shop management default permissions.
         */
        Permission::generate('customers');

        $this->enableForeignKeys();
    }
}
