<?php

namespace App\Http\Livewire\Admin\Settings\Mails;

use App\Services\Mailable;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Mailables extends Component
{
    public bool $isLocal = false;

    protected $listeners = ['onMailableAction' => '$refresh'];

    public function mount(): void
    {
        if (in_array(app()->environment(), config('mails.allowed_environments'))) {
            $this->isLocal = true;
        }
    }

    public function render(): View
    {
        return view('admin.livewire.settings.mails.mailables', [
            'mailables' => (null !== $mailables = Mailable::getMailables())
                ? $mailables->sortBy('name')
                : collect([]),
        ]);
    }
}
