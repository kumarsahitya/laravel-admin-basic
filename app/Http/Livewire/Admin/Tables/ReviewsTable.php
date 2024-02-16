<?php

namespace App\Http\Livewire\Admin\Tables;

use App\Models\Shop\Review;
use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views;

class ReviewsTable extends DataTableComponent
{
    public $columnSearch = [
        'name' => null,
        'author' => null,
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setAdditionalSelects([
                'id',
                'title',
                'rating',
                'content',
                'is_recommended',
                'reviewrateable_type',
                'author_type',
            ])
            ->setTdAttributes(function (Views\Column $column) {
                if ($column->isField('reviewrateable_id')) {
                    return [
                        'class' => 'w-full max-w-xl whitespace-nowrap',
                    ];
                }

                if ($column->isField('content')) {
                    return [
                        'class' => 'md:table-cell whitespace-no-wrap text-sm leading-5 text-secondary-500 dark:text-secondary-400',
                    ];
                }

                if ($column->isField('author_id')) {
                    return [
                        'class' => 'table-cell whitespace-no-wrap text-sm leading-5',
                    ];
                }

                return [];
            })
            ->setBulkActions([
                'deleteSelected' => __('layout.forms.actions.delete'),
                'approved' => __('layout.forms.actions.approve'),
                'disapproved' => __('layout.forms.actions.disapprove'),
            ]);
    }

    public function boot(): void
    {
        $this->queryString['columnSearch'] = ['except' => null];
    }

    public function deleteSelected(): void
    {
        if (count($this->getSelected()) > 0) {
            Review::query()
                ->whereIn('id', $this->getSelected())
                ->delete();

            Notification::make()
                ->title(__('components.tables.status.delete'))
                ->body(__('components.tables.messages.delete', ['name' => __('words.review')]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function approved(): void
    {
        if (count($this->getSelected()) > 0) {
            Review::query()
                ->whereIn('id', $this->getSelected())
                ->update(['approved' => true]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('components.tables.messages.approved', ['name' => __('words.review')]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function disapproved(): void
    {
        if (count($this->getSelected()) > 0) {
            Review::query()
                ->whereIn('id', $this->getSelected())
                ->update(['approved' => false]);

            Notification::make()
                ->title(__('components.tables.status.updated'))
                ->body(__('components.tables.messages.disapproved', ['name' => __('words.review')]))
                ->success()
                ->send();
        }

        $this->selected = [];

        $this->clearSelected();
    }

    public function filters(): array
    {
        return [
            'approved' => Views\Filters\SelectFilter::make(__('pages/products.reviews.approved'))
                ->options([
                    '' => __('layout.forms.label.any'),
                    'yes' => __('layout.forms.label.yes'),
                    'no' => __('layout.forms.label.no'),
                ])
                ->filter(fn (Builder $query, $value) => $query->where('approved', $value === 'yes')),
        ];
    }

    public function columns(): array
    {
        return [
            Views\Column::make(__('words.product'), 'reviewrateable_id')
                ->sortable()
                ->secondaryHeader(function () {
                    return view('admin.livewire.tables.cells.input-search', [
                        'field' => 'name',
                        'columnSearch' => $this->search,
                    ]);
                })
                ->view('admin.livewire.tables.cells.reviews.product'),
            Views\Column::make(__('pages/products.reviews.reviewer'), 'author_id')
                ->view('admin.livewire.tables.cells.reviews.author'),
            Views\Column::make(__('pages/products.reviews.review'), 'content')
                ->view('admin.livewire.tables.cells.reviews.content'),
            Views\Columns\BooleanColumn::make(__('pages/products.reviews.status'), 'approved'),
        ];
    }

    public function builder(): Builder
    {
        return Review::query()
            ->with(['reviewrateable', 'reviewrateable.media', 'author'])
            ->whereHasMorph('reviewrateable', config('system.models.product'), function (Builder $query) {
                $query->when(
                    $this->columnSearch['name'] ?? null,
                    fn (Builder $query, $name) => $query->where('name', 'like', '%'.$name.'%')
                );
            });
    }
}
