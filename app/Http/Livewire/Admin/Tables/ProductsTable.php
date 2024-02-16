<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Exceptions\GeneralException;
use App\Repositories\Ecommerce\BrandRepository;
use App\Repositories\Ecommerce\ProductRepository;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class ProductsTable extends DataTableComponent
{
    public $columnSearch = [
        'name' => null,
        'main_sale_price' => null,
    ];

    public function boot(): void
    {
        $this->queryString['columnSearch'] = ['except' => null];
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects(['status'])
            ->setTdAttributes(function (Views\Column $column) {
                if ($column->isField('name')) {
                    return [
                        'class' => 'max-w-md whitespace-nowrap',
                    ];
                }

                return [];
            })
            ->setBulkActions([
                'delete' => __('layout.forms.actions.delete'),
                'activate' => __('layout.forms.actions.activate'),
                'deactivate' => __('layout.forms.actions.disabled'),
            ]);
    }

    /**
     * @throws GeneralException
     */
    public function delete(): void
    {
        if (count($this->getSelected()) > 0) {
            (new ProductRepository())
                ->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('components.tables.messages.delete', ['name' => Str::plural('product', count($this->getSelected()))]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    /**
     * @throws GeneralException
     */
    public function deactivate(): void
    {
        $this->setVisibility(false);
    }

    /**
     * @throws GeneralException
     */
    public function activate(): void
    {
        $this->setVisibility();
    }

    /**
     * @throws GeneralException
     */
    public function setVisibility(bool $status = true): void
    {
        if (count($this->getSelected()) > 0) {
            (new ProductRepository())
                ->makeModel()
                ->newQuery()
                ->whereIn('id', $this->getSelected())
                ->update(['status' => ($status ? 'Active' : 'Inactive')]);

            Notification::make()
                ->title(__('components.tables.status.visibility'))
                ->body(__('components.tables.messages.visibility', ['name' => Str::plural('product', count($this->getSelected()))]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function filters(): array
    {
        return [
            'is_visible' => Views\Filters\SelectFilter::make(__('layout.forms.label.visible'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(fn (Builder $query, $value) => $query->where('status', ($value === 'yes') ? 'Active' : 'Inactive')),
            'featured' => Views\Filters\SelectFilter::make(__('layout.forms.label.featured'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(fn (Builder $query, $value) => $query->where('featured', ($value === 'yes') ? true : false)),
            'brands' => Views\Filters\MultiSelectFilter::make(__('layout.sidebar.brands'))
                ->options(
                    (new BrandRepository())->makeModel()->newQuery()
                        ->orderBy('name')
                        ->get()
                        ->keyBy('id')
                        ->map(fn ($brand) => $brand->name)
                        ->toArray()
                )
                ->filter(
                    fn (Builder $query, array $brands) => $query->whereHas(
                        'brand',
                        fn (Builder $query) => $query->whereIn('brand_id', $brands)
                    )
                ),
        ];
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('layout.forms.label.name'), 'name')
                ->excludeFromColumnSelect()
                ->searchable()
                ->sortable()
                ->view('admin.livewire.tables.cells.products.name'),
            Views\Column::make(__('layout.forms.label.main_sale_price'), 'main_sale_price')
                ->sortable()
                ->searchable()
                ->format(function ($value) {
                    return $value ? '<span class="font-medium text-secondary-500 dark:text-secondary-400">'.money_format($value).'</span>' : null;
                })->html(),
            Views\Column::make(__('layout.tables.sku'), 'sku')
                ->sortable()
                ->format(function ($value) {
                    return $value ? '<span class="font-medium text-secondary-500 dark:text-secondary-400">'.$value.'</span>' : '<span class="inline-flex text-secondary-700 dark:text-secondary-500">&mdash;</span>';
                })->html(),
            Views\Column::make(__('layout.forms.label.brand'), 'brand.name')
                ->view('admin.livewire.tables.cells.products.brand'),
            Views\Column::make(__('layout.tables.stock'), 'security_stock')
                ->view('admin.livewire.tables.cells.products.stock'),
            Views\Column::make(__('layout.forms.label.published_at'), 'published_at')
                ->view('admin.livewire.tables.cells.date'),
        ];
    }

    /**
     * @throws GeneralException
     */
    public function builder(): Builder
    {
        return (new ProductRepository())
            ->makeModel()
            ->newQuery()
            ->with(['brand', 'variations', 'media'])
            ->withCount(['variations'])
            ->where('parent_id', null);
    }
}
