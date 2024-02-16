<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Models\Admin\User\Role;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteRole extends ModalComponent
{
    public int $roleId;

    public function mount(int $id): void
    {
        $this->roleId = $id;
    }

    public function delete(): void
    {
        Role::query()->find($this->roleId)->delete();

        session()->flash('success', __('Role deleted successfully.'));

        $this->redirectroute('admin.settings.users');
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render(): View
    {
        return view('admin.livewire.modals.delete-role');
    }
}
