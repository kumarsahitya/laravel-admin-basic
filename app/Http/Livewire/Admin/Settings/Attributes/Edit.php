<?php

namespace App\Http\Livewire\Admin\Settings\Attributes;

use App\Http\Livewire\Admin\AbstractBaseComponent;
use App\Models\Shop\Product\Attribute;
use Filament\Notifications\Notification;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class Edit extends AbstractBaseComponent
{
    public Attribute $attribute;

    public int $attributeId;

    public string $name;

    public string $slug;

    public string $type = 'text';

    public ?string $description = null;

    public bool $isEnabled = false;

    public bool $isSearchable = false;

    public bool $isFilterable = false;

    public function mount(Attribute $attribute): void
    {
        $this->attribute = $attribute;
        $this->attributeId = $attribute->id;
        $this->name = $attribute->name;
        $this->slug = $attribute->slug;
        $this->type = $attribute->type;
        $this->description = $attribute->description;
        $this->isEnabled = $attribute->is_enabled;
        $this->isSearchable = $attribute->is_searchable;
        $this->isFilterable = $attribute->is_filterable;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|max:75',
            'slug' => [
                'required',
                Rule::unique('attributes', 'slug')->ignore($this->attributeId),
            ],
            'type' => 'required',
        ];
    }

    public function store(): void
    {
        $this->validate($this->rules());

        Attribute::query()->find($this->attributeId)->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'type' => $this->type,
            'description' => $this->description,
            'is_enabled' => $this->isEnabled,
            'is_searchable' => $this->isSearchable,
            'is_filterable' => $this->isFilterable,
        ]);

        Notification::make()
            ->title(__('components.tables.status.updated'))
            ->body(__('Attribute has been successfully updated!'))
            ->success()
            ->send();
    }

    public function hasValues(): bool
    {
        return in_array($this->type, Attribute::fieldsWithValues());
    }

    public function render(): View
    {
        return view('admin.livewire.settings.attributes.edit', [
            'fields' => Attribute::typesFields(),
        ]);
    }
}
