<?php

namespace App\Http\Livewire\Admin\Settings\Management;

use App\Models\Admin\User\Role;
use App\Repositories\UserRepository;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class UsersRole extends Component
{
    public Role $role;

    public function removeUser(int $id): void
    {
        (new UserRepository())->getById($id)->delete();

        $this->dispatchBrowserEvent('user-removed');

        Notification::make()
            ->title(__('layout.forms.actions.deleted'))
            ->body(__('notifications.users_roles.admin_deleted'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        $users = (new UserRepository())
            ->makeModel()
            ->whereHas('roles', function (Builder $query) {
                $query->where('name', $this->role->name);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.livewire.settings.management.users-role', compact('users'));
    }
}
