<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\Shop\Product\Attribute;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class AttributesTable extends DataTableComponent
{
    protected $model = Attribute::class;

    public $columnSearch = [
        'name' => null,
        'type' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['id', 'is_enabled'])
            ->setDefaultSort('name')
            ->setTableRowUrl(fn ($row) => route('admin.settings.attributes.edit', $row))
            ->setTdAttributes(function (Views\Column $column) {
                if ($column->isField('type')) {
                    return [
                        'class' => 'text-secondary-500',
                    ];
                }

                return [];
            })
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

    public function deleteSelected(): void
    {
        if (count($this->getSelected()) > 0) {
            Attribute::query()->whereIn('id', $this->getSelected())->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('The attribute has successfully removed!'))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function enabled(): void
    {
        if (count($this->getSelected()) > 0) {
            Attribute::query()->whereIn('id', $this->getSelected())->update(['is_enabled' => true]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('The attribute has successfully enabled!'))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function disabled(): void
    {
        if (count($this->getSelected()) > 0) {
            Attribute::query()->whereIn('id', $this->getSelected())->update(['is_enabled' => false]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('The attribute has successfully disabled!'))
                ->success()
                ->send();
        }

        $this->clearSelected();
    }

    public function filters(): array
    {
        return [
            'is_searchable' => Views\Filters\SelectFilter::make(__('layout.forms.label.is_searchable'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(function (Builder $builder, string $value) {
                    match ($value) {
                        'yes' => $builder->where('is_searchable', true),
                        'no' => $builder->where('is_searchable', false),
                    };
                }),
            'is_filterable' => Views\Filters\SelectFilter::make(__('layout.forms.label.is_filterable'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(
                    fn (Builder $builder, string $value) => match ($value) {
                        'yes' => $builder->where('is_filterable', true),
                        'no' => $builder->where('is_filterable', false),
                    }
                ),
            'is_enabled' => Views\Filters\SelectFilter::make(__('layout.forms.actions.enabled'))
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
        ];
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('layout.forms.label.name'), 'name')
                ->sortable()
                ->searchable()
                ->view('admin.livewire.tables.cells.attributes.name'),
            Views\Column::make(__('layout.forms.label.type'), 'type')
                ->sortable()
                ->searchable()
                ->format(fn ($value, $row, Views\Column $column) => $row->type_formatted),
            Views\Columns\BooleanColumn::make(__('layout.forms.label.is_searchable'), 'is_searchable')
                ->sortable(),
            Views\Columns\BooleanColumn::make(__('layout.forms.label.is_filterable'), 'is_filterable')
                ->sortable(),
            Views\Column::make(__('layout.forms.label.updated_at'), 'updated_at')
                ->view('admin.livewire.tables.cells.date'),
        ];
    }
}
