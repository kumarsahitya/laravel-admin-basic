<?php

namespace App\Http\Livewire\Admin\Customers;

use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public Model $customer;

    public function mount($customer): void
    {
        $this->customer = $customer;
    }

    public function paginationSimpleView(): string
    {
        return 'admin.livewire.wire-mobile-pagination-links';
    }

    public function render(): View
    {
        return view('admin.livewire.customers.orders', [
            'orders' => $this->customer->orders()
                ->with(['customer', 'items', 'shippingAddress', 'paymentMethod'])
                ->simplePaginate(3),
        ]);
    }
}
