<?php

namespace App\Http\Livewire\Admin\Settings\Integrations\Github;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Issues extends Component
{
    public function render(): View
    {
        return view('admin.livewire.settings.integrations.github.issues');
    }
}
