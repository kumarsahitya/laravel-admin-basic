<div>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"
                                  class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.inventories.index')" :title="__('words.locations')"
                                  class="text-muted"/>
        <x-admin::breadcrumb.view :title="$inventory->name" class="active"/>
    </x-admin::breadcrumb>

    <div class="text-right space-x-3 my-3">
        <span class="shadow-sm rounded-md">
            <x-admin::buttons.primary wire:click="store" wire.loading.attr="disabled" type="button"
                                      style="display: inline-flex; align-items: center;">
                <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
                {{ __('layout.forms.actions.update') }}
            </x-admin::buttons.primary>
        </span>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/settings.location.detail') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.location.detail_summary') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group :label="__('layout.forms.label.name')" for="name"
                                              isRequired
                                              class="mb-3 col-md-6" :error="$errors->first('name')">
                            <x-admin::forms.input wire:model.defer="name" id="name" type="text"
                                                  autocomplete="off" placeholder="White House"
                                                  class="{{($errors->first('name') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <x-admin::forms.group :label="__('layout.forms.label.email')" for="email"
                                              isRequired
                                              class="mb-3 col-md-6" :error="$errors->first('email')">
                            <x-admin::forms.input wire:model.defer="email" id="email" type="email"
                                                  autocomplete="off" placeholder="{{ __('layout.forms.label.email') }}"
                                                  class="{{($errors->first('email') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <div class="mb-3 col-md-12">
                            <div class="flex items-center justify-between">
                                <x-admin::label class="form-label" :value="__('layout.forms.label.description')"
                                                for="description"/>
                                <span class="ml-4 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                    {{ __('layout.forms.label.optional') }}
                                </span>
                            </div>
                            <div class="mt-1 relative shadow-sm rounded-md">
                                <x-admin::forms.textarea wire:model.defer="description" id="description"/>
                            </div>
                        </div>
                        <div class="mb-3 col-md-12">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <x-admin::forms.checkbox wire:model.defer="isDefault" id="isDefault"/>
                                </div>
                                <div class="ml-3 text-sm leading-5">
                                    <label for="isDefault"
                                           class="font-medium text-secondary-700 cursor-pointer dark:text-secondary-200">
                                        {{ __('pages/settings.location.set_default') }}
                                    </label>
                                    <p class="text-secondary-500 dark:text-secondary-400">
                                        {{ __('pages/settings.location.set_default_summary') }}
                                    </p>
                                </div>
                            </div>
                            @if($inventory->is_default)
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                    <i class='bx bxs-info-circle'></i>
                                    <div class="ms-sm-2">
                                        {{ __('pages/settings.location.is_default') }}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator/>

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/settings.location.address') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.location.address_summary') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group :label="__('layout.forms.label.street_address')"
                                              class="mb-3 col-md-12" isRequired
                                              for="street_address" :error="$errors->first('street_address')">
                            <x-admin::forms.input wire:model.defer="street_address" id="street_address"
                                                  type="text" autocomplete="off"
                                                  placeholder="Akwa Avenue 34..."
                                                  class="{{($errors->first('street_address') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <div class="mb-3 col-md-12">
                            <div class="flex items-center justify-between">
                                <x-admin::label class="form-label" :value="__('layout.forms.label.street_address_plus')"
                                                for="street_address_plus"/>
                                <span class="ml-4 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                        {{ __('layout.forms.label.optional') }}
                                    </span>
                            </div>
                            <div class="mt-1 relative shadow-sm rounded-md">
                                <x-admin::forms.input wire:model.defer="street_address_plus"
                                                      id="street_address_plus" type="text" autocomplete="off"/>
                            </div>
                        </div>
                        <x-admin::forms.group for="country_id" :label="__('layout.forms.label.country')"
                                              noShadow wire:ignore class="mb-3 col-md-12">
                            <select
                                wire:model.defer="country_id"
                                id="country_id"
                                x-data="{}"
                                placeholder="{{ __('layout.forms.placeholder.select_country') }}"
                                autocomplete="off"
                            >
                                @foreach($countries as $country)
                                    <option value="{{ $country->id }}">
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </x-admin::forms.group>
                        <x-admin::forms.group :label="__('layout.forms.label.city')" for="city"
                                              isRequired
                                              :error="$errors->first('city')"
                                              class="mb-3 col-md-6">
                            <x-admin::forms.input wire:model.defer="city" id="city" type="text"
                                                  autocomplete="off"
                                                  class="{{($errors->first('city') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <x-admin::forms.group :label="__('layout.forms.label.postal_code')" for="zipcode"
                                              isRequired
                                              :error="$errors->first('zipcode')"
                                              class="mb-3 col-md-6">
                            <x-admin::forms.input wire:model.defer="zipcode" id="zipcode" type="text"
                                                  autocomplete="off"
                                                  class="{{($errors->first('zipcode') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <div
                            wire:ignore
                            class="mb-3 col-md-12"
                        >
                            <x-admin::forms.group :label="__('layout.forms.label.phone_number')" for="phone_number"
                                                  :error="$errors->first('phone_number')">
                                <x-admin::forms.input wire:model.defer="phone_number" id="phone_number" type="tel"
                                                      class="pr-10" autocomplete="off"/>
                                @error('phone_number')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <svg class="h-5 w-5 text-danger-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                              d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z"
                                              clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                @enderror
                            </x-admin::forms.group>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 pt-5 pb-10 border-t border-secondary-200 dark:border-secondary-700">
        <div class="flex items-center justify-between space-x-4">
            @can('delete_inventories')
                <span class="w-full sm:w-auto">
                    <x-admin::buttons.danger
                        wire:click="$emit('openModal', 'modals.delete-inventory', {{ json_encode([$inventoryId, $name]) }})"
                        type="button">
                        <x-heroicon-o-trash class="w-5 h-5 -ml-1 mr-2"/>
                        {{ __('layout.status.delete') }}
                    </x-admin::buttons.danger>
                </span>
            @endcan
            <span class="ml-auto flex justify-end">
                <x-admin::buttons.primary wire:click="store" type="button" wire:loading.attr="disabled"
                                          style="display: inline-flex; align-items: center;">
                    <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
                    {{ __('layout.forms.actions.update') }}
                </x-admin::buttons.primary>
            </span>
        </div>
    </div>
</div>
