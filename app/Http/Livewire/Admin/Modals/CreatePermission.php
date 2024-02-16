<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Admin\User\Permission;
use App\Models\Admin\User\Role;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class CreatePermission extends ModalComponent
{
    public int $roleId;

    public string $name = '';

    public string $display_name = '';

    public string $description = '';

    public ?string $group = null;

    public function mount(int $id): void
    {
        $this->roleId = $id;
    }

    public function save(): void
    {
        $this->validate([
            'name' => 'required|max:50|unique:permissions,name',
            'display_name' => 'required|max:75',
        ]);

        $permission = Permission::query()->create([
            'name' => $this->name,
            'group_name' => $this->group,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);

        Role::findById($this->roleId)->givePermissionTo($permission->name);

        $this->dispatchBrowserEvent('permission-added');

        Notification::make()
            ->title(__('Saved'))
            ->body(__('A new permission has been create and add to this role!'))
            ->success()
            ->send();

        $this->emit('permissionAdded', $this->roleId);

        $this->closeModal();
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render(): View
    {
        return view('admin.livewire.modals.create-permission', [
            'groups' => Permission::groups(),
        ]);
    }
}
