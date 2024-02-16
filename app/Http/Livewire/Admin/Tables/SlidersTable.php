<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Exceptions\GeneralException;
use App\Repositories\SliderRepository;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class SlidersTable extends DataTableComponent
{
    public $columnSearch = [
        'name' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['id', 'is_enabled', 'description'])
            ->setDefaultSort('id', 'desc')
            ->setBulkActions([
                'deleteSelected' => __('layout.forms.actions.delete'),
                'enabled' => __('layout.forms.actions.enable'),
                'disabled' => __('layout.forms.actions.disable'),
            ]);
    }

    public function boot(): void
    {
        $this->queryString['columnSearch'] = ['except' => null];
    }

    /**
     * @throws GeneralException
     */
    public function deleteSelected(): void
    {
        if (count($this->getSelected()) > 0) {
            (new SliderRepository())->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('components.tables.messages.delete', ['name' => strtolower(__('layout.forms.label.slider'))]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    /**
     * @throws GeneralException
     */
    public function enabled(): void
    {
        if (count($this->getSelected()) > 0) {
            (new SliderRepository())->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->update(['is_enabled' => true]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('components.tables.messages.enabled', ['name' => strtolower(__('layout.forms.label.slider'))]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    /**
     * @throws GeneralException
     */
    public function disabled(): void
    {
        if (count($this->getSelected()) > 0) {
            (new SliderRepository())->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->update(['is_enabled' => false]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('components.tables.messages.disabled', ['name' => strtolower(__('layout.forms.label.slider'))]))
                ->success()
                ->send();
        }

        $this->clearSelected();
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('layout.forms.label.name'), 'name')
                ->sortable()
                ->searchable()
                ->view('admin.livewire.tables.cells.sliders.name'),
            Views\Column::make(__('layout.forms.label.url'), 'link_url')
                ->view('admin.livewire.tables.cells.sliders.site'),
            Views\Column::make(__('layout.forms.label.benefit'), 'benefit'),
            Views\Column::make(__('layout.forms.label.position_order'), 'position'),
            Views\Column::make(__('layout.forms.label.updated_at'), 'updated_at')
                ->view('admin.livewire.tables.cells.date'),
        ];
    }

    /**
     * @throws GeneralException
     */
    public function builder(): Builder
    {
        return (new SliderRepository())
            ->makeModel()
            ->newQuery()
            ->with('media')
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', '%'.$name.'%'));
    }
}
