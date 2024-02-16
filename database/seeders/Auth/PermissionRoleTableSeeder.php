<?php

namespace Database\Seeders\Auth;

use App\Models\admin\User\Permission;
use App\Traits\Database\DisableForeignKeys;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class PermissionRoleTableSeeder extends Seeder
{
    use DisableForeignKeys;

    public function run(): void
    {
        $this->disableForeignKeys();

        $administrator = Role::query()->where('name', config('system.users.admin_role'))->firstOrFail();

        $permissions = Permission::all();

        $administrator->permissions()->sync($permissions->pluck('id')->all());

        $this->enableForeignKeys();
    }
}
