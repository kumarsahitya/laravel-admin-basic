<?php

namespace App\Http\Livewire\Admin\Settings\Attributes;

use App\Models\Shop\Product\Attribute;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Browse extends Component
{
    public function render(): View
    {
        return view('admin.livewire.settings.attributes.browse', [
            'total' => Attribute::query()->count(),
        ]);
    }
}
