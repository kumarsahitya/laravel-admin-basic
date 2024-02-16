<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\System\Pincodes;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class PincodesTable extends DataTableComponent
{
    protected $model = Pincodes::class;

    public $columnSearch = [
        'post_office_name' => null,
        'pincode' => null,
        'city' => null,
        'district' => null,
        'state' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['id', 'status'])
            ->setDefaultSort('pincode')
            ->setTdAttributes(function (Views\Column $column) {
                if ($column->isField('pincode')) {
                    return [
                        'class' => 'text-secondary-500',
                    ];
                }

                return [];
            })
            ->setBulkActions([
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
            Pincodes::query()->whereIn('id', $this->getSelected())->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('The pincode has successfully removed!'))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function enabled(): void
    {
        if (count($this->getSelected()) > 0) {
            Pincodes::query()->whereIn('id', $this->getSelected())->update(['status' => 'Active']);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('The pincode has successfully enabled!'))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function disabled(): void
    {
        if (count($this->getSelected()) > 0) {
            Pincodes::query()->whereIn('id', $this->getSelected())->update(['status' => 'Inactive']);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('The pincode has successfully disabled!'))
                ->success()
                ->send();
        }

        $this->clearSelected();
    }

    public function filters(): array
    {
        return [
            'is_enabled' => Views\Filters\SelectFilter::make(__('layout.forms.actions.enabled'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(
                    fn (Builder $builder, string $value) => match ($value) {
                        'yes' => $builder->where('status', 'Active'),
                        'no' => $builder->where('status', 'Inactive'),
                    }
                ),
        ];
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('layout.forms.label.post_office_name'), 'post_office_name')
                ->sortable()
                ->searchable(),
            Views\Column::make(__('layout.forms.label.pincode'), 'pincode')
                ->sortable()
                ->searchable(),
            Views\Column::make(__('layout.forms.label.city'), 'city')
                ->sortable()
                ->searchable(),
            Views\Column::make(__('layout.forms.label.district'), 'district')
                ->sortable()
                ->searchable(),
            Views\Column::make(__('layout.forms.label.state'), 'state')
                ->sortable()
                ->searchable(),
            Views\Column::make(__('words.is_enabled'), 'status')
                ->view('admin.livewire.tables.cells.pincodes.status'),
        ];
    }
}
