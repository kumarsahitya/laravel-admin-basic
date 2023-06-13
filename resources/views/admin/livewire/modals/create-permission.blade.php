<x-admin::modal
    headerClasses="p-4 sm:px-6 sm:py-4 border-b border-secondary-100 dark:border-secondary-700"
    contentClasses="relative p-4 sm:px-6 sm:px-5"
    footerClasses="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
>

    <x-slot name="title">
        <span class="flex flex-col">
            {{ __('modals.permissions.new') }}
            <span class="mt-0.5 font-normal text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                {{ __('modals.permissions.new_description') }}
            </span>
        </span>
    </x-slot>

    <x-slot name="content">
        <div class="row">
            <x-admin::forms.group :label="__('layout.forms.label.group_name')" for="group" class="mb-3 col-md-12">
                <x-admin::forms.select id="group" wire:model.defer="group">
                    <option>{{ __('words.no_group') }}</option>
                    @foreach($groups as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </x-admin::forms.select>
            </x-admin::forms.group>
            <x-admin::forms.group
                for="permission_name"
                class="mb-3 col-md-12"
                :label="__('modals.permissions.labels.name')"
                :error="$errors->first('name')"
                isRequired
            >
                <x-admin::forms.input wire:model.defer="name" type="text" id="permission_name"
                                      placeholder="create_post, manage_articles, etc" autocomplete="off"
                                      class="{{($errors->first('name') ?  'is-invalid' : '')}}"/>
            </x-admin::forms.group>
            <x-admin::forms.group
                :label="__('layout.forms.label.display_name')"
                for="permission_display_name"
                class="mb-3 col-md-12"
                :error="$errors->first('display_name')"
                isRequired
            >
                <x-admin::forms.input wire:model.defer="display_name" type="text" id="permission_display_name"
                                      placeholder="Create Blog posts" autocomplete="off"
                                      class="{{($errors->first('display_name') ?  'is-invalid' : '')}}"/>
            </x-admin::forms.group>
            <x-admin::forms.group
                for="permission_description"
                class="col-md-12"
                :label="__('layout.forms.label.description')"
            >
                <x-admin::forms.textarea wire:model.defer="description" id="permission_description"/>
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
