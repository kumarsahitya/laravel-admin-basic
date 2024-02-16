<?php

namespace App\Http\Livewire\Admin\Settings\Pincodes;

use App\Models\System\Pincodes;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Browse extends Component
{
    public function render(): View
    {
        return view('admin.livewire.settings.pincodes.browse', [
            'total' => Pincodes::query()->count(),
        ]);
    }
}
