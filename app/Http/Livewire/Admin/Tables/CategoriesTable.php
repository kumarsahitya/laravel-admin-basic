<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Exceptions\GeneralException;
use App\Repositories\Ecommerce\CategoryRepository;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class CategoriesTable extends DataTableComponent
{
    public ?string $defaultSortColumn = 'name';

    public $columnSearch = [
        'name' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('id', 'desc')
            ->setAdditionalSelects(['id', 'is_enabled', 'description', 'parent_id'])
            ->setBulkActions([
                'deleteSelected' => __('layout.forms.actions.delete'),
                'enabled' => __('layout.forms.actions.enable'),
                'disabled' => __('layout.forms.actions.disable'),
            ])
            ->setTdAttributes(function (Views\Column $column) {
                if ($column->isField('slug')) {
                    return [
                        'class' => 'text-secondary-500 dark:text-secondary-400 truncate font-normal',
                    ];
                }

                return [];
            });
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
            (new CategoryRepository())->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('components.tables.messages.delete', ['name' => __('words.category')]))
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
            (new CategoryRepository())->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->update(['is_enabled' => true]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('components.tables.messages.enabled', ['name' => __('words.category')]))
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
            (new CategoryRepository())
                ->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->update(['is_enabled' => false]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('components.tables.messages.disabled', ['name' => __('words.category')]))
                ->success()
                ->send();
        }

        $this->clearSelected();
    }

    public function filters(): array
    {
        return [
            'is_enabled' => Views\Filters\SelectFilter::make(__('words.is_enabled'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(
                    fn (Builder $builder, string $value) => match ($value) {
                        'yes' => $builder->where('is_enabled', true),
                        'no' => $builder->where('is_enabled', false),
                    }
                ),
            'display_as_menu' => Views\Filters\SelectFilter::make(__('layout.forms.label.display_as_menu'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(
                    fn (Builder $builder, string $value) => match ($value) {
                        'yes' => $builder->where('display_as_menu', true),
                        'no' => $builder->where('display_as_menu', false),
                    }
                ),
        ];
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('layout.forms.label.name'), 'name')
                ->sortable()
                ->searchable()
                ->format(
                    fn ($value, $row, Views\Column $column) => view('admin.livewire.tables.cells.categories.name')
                        ->with('category', $row->load('media'))
                ),
            Views\Column::make(__('layout.forms.label.slug'), 'slug'),
            Views\Column::make(__('layout.forms.label.display_as_menu'), 'display_as_menu')
                ->view('admin.livewire.tables.cells.categories.display_as_menu'),
            Views\Column::make(__('layout.forms.label.updated_at'), 'updated_at')
                ->view('admin.livewire.tables.cells.date'),
        ];
    }

    /**
     * @throws GeneralException
     */
    public function builder(): Builder
    {
        return (new CategoryRepository())
            ->makeModel()
            ->newQuery()
            ->when($this->columnSearch['name'] ?? null, fn ($query, $name) => $query->where('name', 'like', '%'.$name.'%'));
    }
}
