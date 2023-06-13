<x-admin::modal footerClasses="px-4 pb-5 sm:px-6 sm:flex sm:flex-row-reverse">
    <x-slot name="content">
        <div class="sm:flex sm:items-start">
            <div
                class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                <svg class="h-6 w-6 text-red-600" x-description="Heroicon name: exclamation"
                     xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                <h3 class="text-lg leading-6 font-medium text-secondary-900" id="modal-headline">
                    {{ __('layout.forms.actions.delete') }}
                </h3>
                <div class="mt-2">
                    <p class="text-sm leading-5 text-secondary-500">
                        {{ __('modals.roles.confirm_delete_msg') }}
                    </p>
                </div>
            </div>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-admin::buttons.danger wire:click="delete" type="button"
                                 style="display: inline-flex; align-items: center;">
            <x-admin::loader wire:loading wire:target="delete" class="text-white me-2"/>
            {{ __('layout.forms.actions.confirm') }}
        </x-admin::buttons.danger>
        <x-admin::buttons.secondary class="mr-2 btn-outline-secondary" wire:click="$emit('closeModal')" type="button">
            {{ __('layout.forms.actions.cancel') }}
        </x-admin::buttons.secondary>
    </x-slot>
</x-admin::modal>
