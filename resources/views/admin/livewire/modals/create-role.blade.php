<x-admin::modal
    headerClasses="p-4 sm:px-6 sm:py-4 border-b border-secondary-100 dark:border-secondary-700"
    contentClasses="relative p-4 sm:px-6 sm:px-5"
    footerClasses="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
>
    <x-slot name="title">
        <span>{{ __('modals.roles.new') }}</span>
        <p class="mt-1 mb-0 sm:mt-0 sm:ml-3 text-sm leading-5 font-normal text-secondary-500 dark:text-secondary-400">
            {{ __('modals.roles.new_description') }}
        </p>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <x-admin::forms.group :label="__('modals.roles.labels.name')" for="name" class="mb-3 col-md-6"
                                  :error="$errors->first('name')" isRequired>
                <x-admin::forms.input wire:model.defer="name" type="text" id="name" placeholder="manager"
                                      autocomplete="off"
                                      class="{{($errors->first('name') ?  'is-invalid' : '')}}"/>
            </x-admin::forms.group>
            <x-admin::forms.group :label="__('layout.forms.label.display_name')" for="display_name"
                                  class="mb-3 col-md-6">
                <x-admin::forms.input wire:model.defer="display_name" type="text" id="display_name"
                                      placeholder="Manager" autocomplete="off"/>
            </x-admin::forms.group>
            <x-admin::forms.group :label="__('layout.forms.label.description')" for="description" class="col-md-12">
                <x-admin::forms.textarea wire:model.defer="description" id="description"/>
            </x-admin::forms.group>
        </div>
    </x-slot>

    <x-slot name="buttons">
        <x-admin::buttons.primary wire:click="save" type="button"
                                  style="display: inline-flex; align-items: center;">
            <x-admin::loader wire:loading wire:target="save" class="text-white me-2"/>
            {{ __('layout.forms.actions.save') }}
        </x-admin::buttons.primary>
        <x-admin::buttons.secondary class="mr-2 btn-outline-secondary" wire:click="$emit('closeModal')" type="button">
            {{ __('layout.forms.actions.cancel') }}
        </x-admin::buttons.secondary>
    </x-slot>

</x-admin::modal>
