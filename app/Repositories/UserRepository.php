<?php

namespace App\Repositories;

use App\Models\Admin\User\User;

class UserRepository extends BaseRepository
{
    public function model(): string
    {
        return config('auth.providers.users.model', User::class);
    }
}
