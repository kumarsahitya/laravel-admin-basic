<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Exceptions\GeneralException;
use App\Repositories\UserRepository;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class CustomersTable extends DataTableComponent
{
    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects([
                'id',
                'first_name',
                'last_name',
                'email',
                'email_verified_at',
                'avatar_type',
                'avatar_location',
            ])
            ->setDefaultSort('first_name')
            ->setBulkActions([
                'delete' => __('layout.forms.actions.delete'),
                'verified' => __('layout.forms.actions.verified'),
            ]);
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('layout.forms.label.full_name'), 'first_name')
                ->sortable()
                ->searchable()
                ->view('admin.livewire.tables.cells.customers.name'),
            Views\Column::make(__('layout.forms.label.email_subscription'), 'opt_in')
                ->view('admin.livewire.tables.cells.customers.opt-in'),
            Views\Column::make(__('layout.forms.label.registered_at'), 'created_at')
                ->view('admin.livewire.tables.cells.date'),
        ];
    }

    /**
     * @throws GeneralException
     */
    public function verified(): void
    {
        if (count($this->getSelected()) > 0) {
            (new UserRepository())->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->update(['email_verified_at' => now()]);

            Notification::make()
                ->title(__('components.tables.status.verified'))
                ->body(__('components.tables.messages.verified', ['name' => __('words.customer')]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    /**
     * @throws GeneralException
     */
    public function delete(): void
    {
        if (count($this->getSelected()) > 0) {
            (new UserRepository())->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('components.tables.messages.delete', ['name' => __('words.customer')]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function filters(): array
    {
        return [
            'mailing' => Views\Filters\SelectFilter::make(__('layout.forms.label.email_subscription'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(fn (Builder $query, string $value) => $query->where('opt_in', $value === 'yes')),
            'verified' => Views\Filters\SelectFilter::make(__('layout.forms.label.email_verified'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(fn (Builder $query, $verified) => $verified === 'yes' ? $query->whereNotNull('email_verified_at') : $query->whereNull('email_verified_at')),
        ];
    }

    /**
     * @throws GeneralException
     */
    public function builder(): Builder
    {
        return (new UserRepository())->makeModel()->newQuery()
            ->whereHas('roles', fn (Builder $query) => $query->where('name', config('system.users.default_role')))
            ->when($this->getAppliedFilterWithValue('search'), fn (Builder $query, $term) => $query->research($term));
    }
}
