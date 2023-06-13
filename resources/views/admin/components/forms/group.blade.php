@props([
    'label' => false,
    'for' => false,
    'noShadow' => false,
    'isRequired' => false,
    'error' => false,
    'helpText' => false,
    'optional' => false,
])

<div {{ $attributes }}>
    @if($label)
        <label for="{{ $for }}" class="form-label">
            {{ $label }} @if($isRequired) <span class="text-danger">*</span> @endif
        </label>
        @if($optional)
            <span class="text-secondary text-sm leading-5 dark:text-secondary">
                {{ __('layout.forms.label.optional') }}
            </span>
        @endif
    @endif

    <div class="relative @if(!$noShadow) rounded-md shadow-sm @endif">
        {{ $slot }}
    </div>
    @if ($error)
        <p class="mt-1 mb-0 text-danger dark:text-danger">{{ $error }}</p>
    @endif

    @if ($helpText)
        <p class="mt-2 text-sm text-secondary dark:text-secondary">{{ $helpText }}</p>
    @endif
</div>
