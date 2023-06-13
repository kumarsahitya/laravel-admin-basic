@props([
    'label' => __('layout.forms.label.search'),
    'for' => 'search-filter',
    'placeholder' => __('layout.forms.label.search'),
])

<div class="flex flex-1">
    <label for="{{ $for }}" class="sr-only">{{ $label }}</label>
    <div class="input-group input-group-merge">
        <span class="input-group-text" id="basic-addon-search31"><i class="bx bx-search"></i></span>
        <x-admin::forms.input type="search" id="search-filter" wire:model.debounce.300ms="search" class="pl-10"
                              :placeholder="$placeholder"/>
        <div class="input-group-text">
            <x-admin::loader wire:loading wire:target="search" class="text-primary-600"/>
        </div>
    </div>
</div>


