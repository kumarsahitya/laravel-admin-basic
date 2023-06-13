@props(['resetClass', 'resetClick', 'helpText' => false])
<div class="d-flex align-items-start align-items-sm-center gap-4" xmlns:x-admin="http://www.w3.org/1999/html">
    {{ $slot }}

    <div x-data="{ focused: false }" class="button-wrapper">
        <label for="{{ $attributes['id'] }}" class="cursor-pointer btn btn-primary me-2 mb-4" tabindex="0">
            <span class="d-none d-sm-block">{{ __('layout.forms.label.change') }}</span>
            <i class="bx bx-upload d-block d-sm-none"></i>
            <input @focus="focused = true" @blur="focused = false" type="file" {{ $attributes }}>
        </label>

        <x-admin::buttons.secondary type="button" class="btn-outline-secondary {{ $resetClass }} mb-4"
                                    wire:click="{{ $resetClick ?? '' }}">
            <span class="d-none d-sm-block">Reset</span>
            <i class="bx bx-reset d-block d-sm-none"></i>
        </x-admin::buttons.secondary>
        @if ($helpText)
            <p class="text-muted mb-0">{{ $helpText }}</p>
        @endif
    </div>
</div>
