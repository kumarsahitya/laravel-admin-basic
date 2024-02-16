<?php

namespace App\Http\Livewire\Admin\Forms;

use Illuminate\Contracts\View\View;
use Livewire\Component;

class Trix extends Component
{
    public string $trixId;

    public ?string $value = null;

    public ?string $title = null;

    public function mount(?string $value = null, ?string $title = null): void
    {
        $this->title = $title;
        $this->value = $value;
        $this->trixId = 'trix-'.uniqid();
    }

    public function updatedValue(string $value): void
    {
        $this->emitUp('trix:valueUpdated', $value, $this->title);
    }

    public function render(): View
    {
        return view('admin.livewire.forms.trix');
    }
}
