<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\User\Role;
use Illuminate\Contracts\View\View;
use Illuminate\Routing\Controller;

class SettingController extends Controller
{
    public function initialize(): View
    {
        return view('admin.pages.settings.initialize');
    }

    public function role(Role $role): View
    {
        return view('admin.pages.settings.management.role', compact('role'));
    }
}
