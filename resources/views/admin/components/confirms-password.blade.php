@props([
    'title' => __('layout.forms.label.confirm_password'),
    'content' => __('components.modal.content'),
    'button' => __('layout.forms.label.confirm')
])

@php
    $confirmableId = md5($attributes->wire('then'));
@endphp

<span
    {{ $attributes->wire('then') }}
    x-data
    x-ref="span"
    x-on:click="$wire.startConfirmingPassword('{{ $confirmableId }}')"
    x-on:password-confirmed.window="setTimeout(() => $event.detail.id === '{{ $confirmableId }}' && $refs.span.dispatchEvent(new CustomEvent('then', { bubbles: false })), 250);"
>
    {{ $slot }}
</span>

@once
    <x-admin::dialog-modal wire:model="confirmingPassword" maxWidth="lg">
        <x-slot name="title">
            {{ $title }}
        </x-slot>

        <x-slot name="content">
            <p>{{ $content }}</p>

            <div class="mt-4" x-data="{}"
                 x-on:confirming-password.window="setTimeout(() => $refs.confirmable_password.focus(), 250)">
                <x-admin::forms.input
                    x-ref="confirmable_password"
                    wire:model.defer="confirmablePassword"
                    wire:keydown.enter="confirmPassword"
                    id="confirmable_password"
                    type="password"
                    placeholder="{{ __('layout.forms.placeholder.password') }}"
                    aria-label="{{ __('layout.forms.label.password') }}"
                    class="{{($errors->first('confirmable_password') ?  'is-invalid' : '')}}"
                />

                @error('confirmable_password')
                <p class="mt-2 text-sm text-red-500 dark:text-red-400">{{ $message }}</p>
                @enderror
            </div>
        </x-slot>

        <x-slot name="footer">
            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <x-admin::buttons.primary wire:click="confirmPassword" wire:loading.attr="disabled" type="button"
                                          style="display: inline-flex; align-items: center;">
                    <x-admin::loader wire:loading wire:target="confirmPassword" class="text-white me-2"/>
                    {{ $button }}
                </x-admin::buttons.primary>
            </span>

            <span class="flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <x-admin::buttons.secondary wire:click="stopConfirmingPassword" wire:loading.attr="disabled"
                                            type="button">
                    {{ __('layout.forms.actions.nevermind') }}
                </x-admin::buttons.secondary>
            </span>
        </x-slot>
    </x-admin::dialog-modal>
@endonce
