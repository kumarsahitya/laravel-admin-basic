<?php

namespace App\Http\Livewire\Admin\Customers;

use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Browse extends Component
{
    public function render(): View
    {
        return view('admin.livewire.customers.browse', [
            'total' => (new UserRepository())
                ->makeModel()
                ->whereHas('roles', function (Builder $query) {
                    $query->where('name', config('system.users.default_role'));
                })
                ->count(),
        ]);
    }
}
