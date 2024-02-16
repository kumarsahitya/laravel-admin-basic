<?php

namespace App\Http\Livewire\Admin;

use App\Repositories\UserRepository;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
    public string $full_name = '';

    public int $total_customers = 0;

    public int $total_orders = 0;

    public int $total_products = 0;

    public int $total_reviews = 0;

    public ?int $average_reviews = 0;

    public string $rating_chart_filter = 'All';

    public int $customer_chart_current_week_count = 0;

    public int $customer_chart_last_week_count = 0;

    public $rating_chart_label = [];

    public $rating_chart_cur_year = [];

    public $rating_chart_last_year = [];

    public $customer_chart_label = [];

    public $customer_chart_last_week = [];

    public $order_chart_label = [];

    public $order_chart_cur_year = [];

    public function mount(): void
    {
        $user = Auth::user();

        $this->full_name = $user->full_name;
    }

    public function render(): View
    {
        return view('admin.livewire.dashboard', [
            'users' => (new UserRepository())
                ->makeModel()
                ->whereHas('roles', function (Builder $query) {
                    $query->whereIn('name', [config('system.users.admin_role'), 'manager']);
                })
                ->orderBy('created_at', 'desc')
                ->limit(5)->get(),
        ]);
    }
}
