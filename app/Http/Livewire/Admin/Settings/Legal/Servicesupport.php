<?php

namespace App\Http\Livewire\Admin\Settings\Legal;

use App\Traits\WithLegalActions;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Servicesupport extends Component
{
    use WithLegalActions;

    public string $title = 'Service & Support';

    protected $listeners = [
        'trix:valueUpdated' => 'onTrixValueUpdate',
    ];

    public function onTrixValueUpdate(string $value): void
    {
        $this->content = $value;
    }

    public function store(): void
    {
        $this->storeValues($this->title, $this->content, $this->isEnabled);

        Notification::make()
            ->title(__('layout.status.updated'))
            ->body(__('Your service & support has been successfully updated'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('admin.livewire.settings.legal.service_support');
    }
}
