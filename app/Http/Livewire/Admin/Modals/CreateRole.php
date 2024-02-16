<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Admin\User\Role;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class CreateRole extends ModalComponent
{
    public string $name = '';

    public string $display_name = '';

    public string $description = '';

    public function save(): void
    {
        $this->validate(['name' => 'required|unique:roles'], [
            'name.required' => __('The role name is required.'),
            'name.unique' => __('This name is already used.'),
        ]);

        Role::create([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);

        $this->emit('onRoleAdded');

        Notification::make()
            ->body(__('notifications.users_roles.role_added'))
            ->success()
            ->send();

        $this->closeModal();
    }

    public function render(): View
    {
        return view('admin.livewire.modals.create-role');
    }
}
