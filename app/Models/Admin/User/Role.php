<?php

namespace App\Models\Admin\User;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    public function isAdmin(): bool
    {
        return $this->name === config('system.users.admin_role');
    }
}
