<?php

namespace App\Http\Livewire\Admin\Settings\Payments;

use App\Models\Shop\PaymentMethod;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Livewire\WithPagination;

class General extends Component
{
    use WithPagination;

    public string $search = '';

    protected $listeners = ['onPaymentMethodAdded' => 'render'];

    public function toggleStatus(int $id, int $status): void
    {
        PaymentMethod::query()->find($id)->update(['is_enabled' => ! ($status === 1)]);

        $this->dispatchBrowserEvent('toggle-saved-'.$id);

        Notification::make()
            ->title(__('layout.status.updated'))
            ->body(__('Your payment method status have been correctly updated'))
            ->success()
            ->send();
    }

    public function removePayment(int $id): void
    {
        PaymentMethod::query()->find($id)->delete();

        $this->dispatchBrowserEvent('item-update');

        Notification::make()
            ->title(__('Deleted'))
            ->body(__('Your payment method have been correctly removed'))
            ->success()
            ->send();
    }

    public function render(): View
    {
        return view('admin.livewire.settings.payments.general', [
            'methods' => PaymentMethod::query()
                ->where('title', 'like', '%'.$this->search.'%')
                ->where('slug', '<>', 'stripe')
                ->orderByDesc('title')
                ->paginate(6),
        ]);
    }
}
