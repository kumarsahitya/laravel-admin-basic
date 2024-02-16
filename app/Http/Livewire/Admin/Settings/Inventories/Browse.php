<?php

namespace App\Http\Livewire\Admin\Settings\Inventories;

use App\Models\Shop\Inventory\Inventory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Browse extends Component
{
    public function render(): View
    {
        return view('admin.livewire.settings.inventories.browse', [
            /** @phpstan-ignore-next-line */
            'inventories' => Inventory::query()->with('country')->get()->take(4),
        ]);
    }
}
