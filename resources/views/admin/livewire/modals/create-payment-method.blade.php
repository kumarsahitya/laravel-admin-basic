<x-admin::modal
    headerClasses="p-4 sm:px-6 sm:py-4 border-b border-secondary-100 dark:border-secondary-700"
    contentClasses="relative p-4 sm:px-6 sm:px-5"
    footerClasses="px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse"
>

    <x-slot name="title">
        {{ __('pages/settings.payment.create_payment') }}
    </x-slot>

    <x-slot name="content">
        <div class="row h-96 overflow-y-scroll hide-scroll">
            <div class="mb-3 col-md-12">
                <x-admin::forms.group :label="__('layout.forms.label.provider_logo')" for="logo"
                                      :error="$errors->first('logo')" noShadow>
                    <x-admin::forms.avatar-upload wire:model.lazy='logo' id="photo"
                                                  class="setting-logo-input" hidden
                                                  :resetClass="('setting-logo-reset')"
                                                  :resetClick="('removeLogo')"
                                                  accept="image/png, image/jpeg"
                                                  :helpText="__('components.files.type_size_kb', ['size' => '150'])">
                        <span
                            class="inline-block h-12 w-12 rounded-full overflow-hidden bg-secondary-100 dark:bg-secondary-700">
                            @if ($logo)
                                <img class="h-full w-full bg-center" src="{{ $logo->temporaryUrl() }}"
                                     alt="">
                            @else
                                <span class="h-12 w-12 flex items-center justify-center">
                                <x-heroicon-o-photograph
                                    class="w-8 h-8 text-secondary-400 dark:text-secondary-500"/>
                            </span>
                            @endif
                        </span>
                    </x-admin::forms.avatar-upload>
                </x-admin::forms.group>
            </div>
            <div class="mb-3 col-md-12">
                <x-admin::forms.group
                    for="title"
                    :label="__('layout.forms.label.payment_method')"
                    :error="$errors->first('title')"
                    isRequired
                >
                    <x-admin::forms.input wire:model.defer="title" id="title" type="text"
                                          class="{{($errors->first('name') ?  'is-invalid' : '')}}"/>
                </x-admin::forms.group>
            </div>
            <div class="mb-3 col-md-12">
                <x-admin::forms.group :label="__('layout.forms.label.payment_doc')" for="link_url">
                    <x-admin::forms.input wire:model.defer="linkUrl" type="url" id="link_url"
                                          placeholder="https://doc.myprovider.com"/>
                </x-admin::forms.group>
            </div>
            <div class="mb-3 col-md-12">
                <x-admin::forms.group
                    for="description"
                    :label="__('layout.forms.label.additional_details')"
                    :helpText="__('words.payment_method_help_text')"
                >
                    <x-admin::forms.textarea wire:model.defer="description" id="description"/>
                </x-admin::forms.group>
            </div>
            <div class="col-md-12">
                <x-admin::forms.group
                    for="instructions"
                    :label="__('layout.forms.label.payment_instruction')"
                    :helpText="__('words.payment_method_instruction')"
                >
                    <x-admin::forms.textarea wire:model.defer="instructions" id="instructions"/>
                </x-admin::forms.group>
            </div>
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
