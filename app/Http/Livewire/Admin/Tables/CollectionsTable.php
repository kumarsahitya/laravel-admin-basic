<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Exceptions\GeneralException;
use App\Repositories\Ecommerce\CollectionRepository;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class CollectionsTable extends DataTableComponent
{
    public $columnSearch = [
        'name' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['id', 'slug', 'sort'])
            ->setDefaultSort('name')
            ->setBulkActions([
                'deleteSelected' => __('layout.forms.actions.delete'),
            ]);
    }

    /**
     * @throws GeneralException
     */
    public function deleteSelected(): void
    {
        if (count($this->getSelected()) > 0) {
            (new CollectionRepository())
                ->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('The attribute has successfully disabled!'))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function filters(): array
    {
        return [
            'type' => Views\Filters\SelectFilter::make(__('pages/collections.filter_type'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'auto' => __('pages/collections.automatic'),
                    'manual' => __('pages/collections.manual'),
                ])
                ->filter(fn (Builder $query, string $type) => $query->where('type', $type)),
        ];
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('layout.forms.label.name'), 'name')
                ->sortable()
                ->searchable()
                ->view('admin.livewire.tables.cells.collections.name'),
            Views\Column::make(__('layout.forms.label.type'), 'type')
                ->view('admin.livewire.tables.cells.collections.type'),
            Views\Column::make(__('pages/collections.product_conditions'), 'match_conditions')
                ->view('admin.livewire.tables.cells.collections.conditions'),
            Views\Column::make(__('layout.forms.label.updated_at'), 'updated_at')
                ->view('admin.livewire.tables.cells.date'),
        ];
    }

    /**
     * @throws GeneralException
     */
    public function builder(): Builder
    {
        return (new CollectionRepository())
            ->makeModel()
            ->newQuery()
            ->with('rules')
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', '%'.$name.'%'));
    }
}
