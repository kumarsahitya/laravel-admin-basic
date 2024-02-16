<?php

namespace App\Http\Livewire\Admin\Modals;

use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class DeleteCustomer extends ModalComponent
{
    public int $customerId;

    public function mount(int $customerId): void
    {
        $this->customerId = $customerId;
    }

    public function delete(): void
    {
        (new UserRepository())->getById($this->customerId)->delete();

        session()->flash('success', __('pages/customers.modal.success_message'));

        $this->redirectroute('admin.customers.index');
    }

    public static function modalMaxWidth(): string
    {
        return 'lg';
    }

    public function render(): View
    {
        return view('admin.livewire.modals.delete-customer');
    }
}
