<?php

namespace Database\Seeders\Auth;

use App\Traits\Database\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RolesTableSeeder extends Seeder
{
    use DisableForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();

        Role::create([
            'name' => config('system.users.admin_role'),
            'display_name' => 'Administrator',
            'description' => 'Site administrator with access to shop admin panel and developer tools.',
            'can_be_removed' => false,
        ]);

        Role::create([
            'name' => 'manager',
            'display_name' => 'Manager',
            'description' => 'Site manager with access to shop admin panel and publishing menus.',
            'can_be_removed' => false,
        ]);

        Role::create([
            'name' => config('system.users.default_role'),
            'display_name' => 'User',
            'description' => 'Site customer role with access on front site.',
            'can_be_removed' => false,
        ]);

        $this->enableForeignKeys();
    }
}
