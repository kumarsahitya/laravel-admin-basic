<?php

namespace App\Http\Livewire\Admin\Settings\Mails;

use App\Services\Mailable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class AddTemplate extends Component
{
    public function render(): View
    {
        return view('admin.livewire.settings.mails.templates.add-template', [
            'skeletons' => Mailable::getTemplateSkeletons(),
        ]);
    }
}
