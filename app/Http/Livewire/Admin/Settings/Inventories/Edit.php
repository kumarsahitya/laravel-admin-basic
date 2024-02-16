<?php

namespace App\Http\Livewire\Admin\Settings\Inventories;

use App\Http\Livewire\Admin\AbstractBaseComponent;
use App\Models\Shop\Inventory\Inventory;
use App\Models\System\Country;
use App\Rules\Phone;
use Illuminate\Contracts\View\View;
use Illuminate\Validation\Rule;

class Edit extends AbstractBaseComponent
{
    public Inventory $inventory;

    public int $inventoryId;

    public string $name;

    public ?string $description = null;

    public string $email;

    public string $city;

    public string $street_address;

    public ?string $street_address_plus = null;

    public string $zipcode;

    public ?string $phone_number = null;

    public int $country_id;

    public bool $isDefault = false;

    public function mount(Inventory $inventory): void
    {
        $this->inventory = $inventory;
        $this->inventoryId = $inventory->id;
        $this->name = $inventory->name;
        $this->email = $inventory->email;
        $this->description = $inventory->description;
        $this->street_address = $inventory->street_address;
        $this->street_address_plus = $inventory->street_address_plus;
        $this->country_id = $inventory->country_id;
        $this->city = $inventory->city;
        $this->zipcode = $inventory->zipcode;
        $this->isDefault = $inventory->is_default;
        $this->phone_number = $inventory->phone_number;
    }

    public function rules(): array
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('inventories', 'email')->ignore($this->inventoryId),
            ],
            'name' => 'required|max:100',
            'city' => 'required',
            'street_address' => 'required',
            'zipcode' => 'required',
            'phone_number' => ['nullable', new Phone()],
            'country_id' => 'required|exists:system_countries,id',
        ];
    }

    public function store(): void
    {
        $this->validate($this->rules());

        $this->inventory->update([
            'name' => $this->name,
            'email' => $this->email,
            'city' => $this->city,
            'description' => $this->description,
            'street_address' => $this->street_address,
            'street_address_plus' => $this->street_address_plus,
            'zipcode' => $this->zipcode,
            'phone_number' => $this->phone_number,
            'country_id' => $this->country_id,
            'is_default' => $this->isDefault,
        ]);

        session()->flash('success', __('Inventory Successfully updated.'));

        $this->redirectroute('admin.settings.inventories.index');
    }

    public function render(): View
    {
        return view('admin.livewire.settings.inventories.edit', [
            'countries' => Country::query()->orderBy('name')->get(),
        ]);
    }
}
