<x-admin::modal
    contentClasses="relative p-4 sm:px-6 sm:px-5"
    footerClasses="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
>

    <x-slot name="content">
        <div class="sm:flex sm:items-start px-4 sm:px-6 pt-4">
            <div class="text-left">
                <h3 class="text-lg leading-6 font-medium text-secondary-900 dark:text-white">
                    {{ __('words.logout_session') }}
                </h3>
                <p class="mt-1 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                    {{ __('words.logout_session_confirm') }}
                </p>
            </div>
        </div>
        <div class="p-4 sm:px-6">
            <div>
                <div class="relative">
                    <x-admin::forms.input wire:model.lazy="password"
                                          aria-label="{{ __('layout.forms.label.password') }}" type="password"
                                          placeholder="{{ __('Enter your password') }}"
                                          class="{{($errors->first('password') ?  'is-invalid' : '')}}"/>
                </div>
                @error('password')
                <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                @enderror
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <x-admin::buttons.danger wire:click="logoutOtherBrowserSessions" wire:loading.attr="disabled" type="button"
                                     style="display: inline-flex; align-items: center;">
                <x-admin::loader wire:loading wire:target="logoutOtherBrowserSessions" class="white me-2"/>
                {{ __('layout.forms.actions.logout_session') }}
            </x-admin::buttons.danger>
        </span>
        <span class="flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <x-admin::buttons.secondary wire:click="$emit('closeModal')" wire:loading.attr="disabled" type="button">
                {{ __('layout.forms.actions.nevermind') }}
            </x-admin::buttons.secondary>
        </span>
    </x-slot>

</x-admin::modal>
