<?php

namespace App\Http\Livewire\Admin\Settings\Mails;

use App\Services\Mailable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Templates extends Component
{
    public bool $isLocal = false;

    protected $listeners = ['onTemplateRemoved' => '$refresh'];

    public function mount(): void
    {
        if (in_array(app()->environment(), config('mails.allowed_environments'))) {
            $this->isLocal = true;
        }
    }

    public function render(): View
    {
        return view('admin.livewire.settings.mails.templates.browse', [
            'templates' => Mailable::getTemplates(),
        ]);
    }
}
