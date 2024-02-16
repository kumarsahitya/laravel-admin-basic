<?php

namespace App\Http\Livewire\Admin\Settings\Management;

use App\Models\Admin\User\Role as RoleModel;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Role extends Component
{
    public RoleModel $role;

    public string $name;

    public string $display_name = '';

    public ?string $description = null;

    public function mount(RoleModel $role): void
    {
        $this->name = $role->name;
        $this->display_name = $role->display_name;
        $this->description = $role->description;
    }

    public function save(): void
    {
        $this->validate([
            'name' => [
                'required',
                Rule::unique('roles', 'name')->ignore($this->role->id),
            ],
        ], [
            'name.required' => __('The role name is required.'),
            'name.unique' => __('This name is already used.'),
        ]);

        RoleModel::query()->find($this->role->id)->update([
            'name' => $this->name,
            'display_name' => $this->display_name,
            'description' => $this->description,
        ]);

        Notification::make()
            ->title(__('components.tables.status.updated'))
            ->body(__('Role updated successfully'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('admin.livewire.settings.management.role');
    }
}
