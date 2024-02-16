<?php

namespace App\Http\Livewire\Admin\Settings\Management;

use App\Models\Admin\User\Role;
use App\Repositories\UserRepository;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithPagination;

class Management extends Component
{
    use WithPagination;

    protected $listeners = ['onRoleAdded' => '$refresh'];

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
        return view('admin.livewire.settings.management.index', [
            'roles' => Role::query()
                ->with('users')
                ->orderBy('created_at')
                ->get(),
            'users' => (new UserRepository())
                ->makeModel()
                ->whereHas('roles', function (Builder $query) {
                    $query->whereIn('name', [config('system.users.admin_role'), 'manager']);
                })
                ->orderBy('created_at', 'desc')
                ->paginate(3),
        ]);
    }
}
