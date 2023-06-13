<div>
    <x-admin::breadcrumb :back="route('admin.customers.index')">
        <x-heroicon-s-chevron-left class="shrink-0 h-5 w-5 text-secondary-400" />
        <x-admin::breadcrumb.link :link="route('admin.customers.index')" :title="__('layout.sidebar.customers')" />
    </x-admin::breadcrumb>

    <x-admin::heading class="mt-3">
        <x-slot name="title">
            {{ __('words.actions_label.add_new', ['name' => __('customer')]) }}
        </x-slot>
    </x-admin::heading>

    <div class="mt-6">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-bold leading-6 text-secondary-900 dark:text-white">
                        {{ __('pages/customers.overview') }}
                    </h3>
                    <p class="mt-4 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                        {{ __('pages/customers.overview_description') }}
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="px-4 py-5 sm:p-6 shadow bg-white rounded-md dark:bg-secondary-800">
                    <div class="grid gap-4 grid-cols-6 sm:gap-5">
                        <x-admin::forms.group
                            for="first_name"
                            class="col-span-6 sm:col-span-3"
                            :label="__('layout.forms.label.first_name')"
                            :error="$errors->first('first_name')"
                        >
                            <x-admin::forms.input wire:model.defer="first_name" id="first_name" type="text" autocomplete="off" />
                        </x-admin::forms.group>

                        <x-admin::forms.group
                            for="last_name"
                            class="col-span-6 sm:col-span-3"
                            :label="__('layout.forms.label.last_name')"
                            :error="$errors->first('last_name')"
                        >
                            <x-admin::forms.input wire:model.defer="last_name" id="last_name" type="text" autocomplete="off" />
                        </x-admin::forms.group>

                        <x-admin::forms.group
                            for="email"
                            class="col-span-6"
                            :label="__('layout.forms.label.email')"
                            :error="$errors->first('email')"
                        >
                            <x-admin::forms.input wire:model.defer="email" id="email" type="email" autocomplete="off" />
                        </x-admin::forms.group>

                        <div wire:ignore x-data="internationalNumber('#phone')" class="col-span-6">
                            <div class="flex items-center justify-between">
                                <x-admin::label for="phone" :value="__('layout.forms.label.phone_number')" />
                                <span class="text-secondary-500 text-sm leading-5 dark:text-secondary-400">
                                    {{ __('layout.forms.label.optional') }}
                                </span>
                            </div>
                            <div class="mt-1 relative">
                                <x-admin::forms.input wire:model.defer="phone_number" id="phone" type="tel" class="pr-10" autocomplete="off" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator />

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-bold leading-6 text-secondary-900 dark:text-white">
                        {{ __('pages/customers.security_title') }}
                    </h3>
                    <p class="mt-4 text-sm leading-5 text-secondary-500 dark:txt-secondary-400">
                        {{ __('pages/customers.security_description') }}
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="bg-white shadow rounded-md overflow-hidden dark:bg-secondary-800">
                    <div class="px-4 py-5 sm:p-6 space-y-4">
                        <div class="grid gap-4 sm:grid-cols-6 sm:gap-6">
                            <div x-data="{ show: false }" class="sm:col-span-6">
                                <div class="flex items-center justify-between">
                                    <x-admin::label for="password" :value="__('layout.forms.label.password')" />
                                    <div class="flex items-center divide-x divide-secondary-200 dark:divide-secondary-600">
                                        <button wire:click="generate" type="button" class="pr-2 text-primary-600 text-sm font-medium leading-5 hover:text-primary-500 dark:text-primary-500/50">
                                            {{ __('words.generate') }}
                                        </button>
                                        <button
                                            @click="show = !show"
                                            x-text="show ? '{{ __('words.hide') }}' : '{{ __('words.show') }}'"
                                            type="button"
                                            class="pl-2 text-sm text-leading-5 text-primary-600 hover:text-primary-700 focus:outline-none focus:text-primary-700 hover:underline dark:text-primary-500/50">
                                        </button>
                                    </div>
                                </div>
                                <div class="mt-1 relative rounded-md shadow-sm">
                                    <x-admin::forms.input wire:model.defer="password" id="password" ::type="show ? 'text' : 'password'" type="password" autocomplete="off" class="@error('password') pr-10 @enderror" />
                                    @error('password')
                                        <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                            <x-heroicon-s-exclamation-circle class="h-5 w-5 text-danger-500" />
                                        </div>
                                    @enderror
                                </div>
                                @error('password')
                                    <p class="mt-2 text-sm text-danger-500 dark:text-danger-400">{{ $message }}</p>
                                @enderror
                            </div>

                            <x-admin::forms.group
                                for="password_confirmation"
                                class="sm:col-span-6"
                                :label="__('layout.forms.label.confirm_password')"
                                :error="$errors->first('password_confirmation')"
                            >
                                <x-admin::forms.input wire:model.defer="password_confirmation" id="password_confirmation" type="password" autocomplete="off" />
                            </x-admin::forms.group>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator />

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-bold leading-6 text-secondary-900 dark:text-white">
                        {{ __('pages/customers.address_title') }}
                    </h3>
                    <p class="mt-4 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                        {{ __('pages/customers.address_description') }}
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="bg-white shadow rounded-md dark:bg-secondary-800">
                    <div class="px-4 py-5 sm:p-6 space-y-4">
                        <div class="grid gap-4 sm:grid-cols-6 sm:gap-6">
                            <x-admin::forms.group
                                for="address_first_name"
                                class="col-span-6 sm:col-span-3"
                                :label="__('layout.forms.label.first_name')"
                                :error="$errors->first('address_first_name')"
                            >
                                <x-admin::forms.input wire:model.defer="address_first_name" id="address_first_name" type="text" autocomplete="off" />
                            </x-admin::forms.group>

                            <x-admin::forms.group
                                for="address_last_name"
                                class="col-span-6 sm:col-span-3"
                                :label="__('layout.forms.label.last_name')"
                                :error="$errors->first('address_last_name')"
                            >
                                <x-admin::forms.input wire:model="address_last_name" id="address_last_name" type="text" autocomplete="off" />
                            </x-admin::forms.group>

                            <x-admin::forms.group
                                for="company_name"
                                class="col-span-6"
                                :label="__('layout.forms.label.company_name')"
                                optional
                            >
                                <x-admin::forms.input wire:model.defer="company_name" id="company_name" type="text" autocomplete="off" />
                            </x-admin::forms.group>

                            <x-admin::forms.group
                                for="street_address"
                                class="col-span-6"
                                :label="__('layout.forms.label.street_address')"
                                :error="$errors->first('street_address')"
                            >
                                <x-admin::forms.input wire:model.defer="street_address" id="street_address" type="text" autocomplete="off" />
                            </x-admin::forms.group>

                            <x-admin::forms.group
                                for="street_address_plus"
                                class="col-span-6"
                                :label="__('layout.forms.label.street_address_plus')"
                                optional
                            >
                                <x-admin::forms.input wire:model.defer="street_address_plus" id="street_address_plus" type="text" autocomplete="off" />
                            </x-admin::forms.group>

                            <x-admin::forms.group
                                for="country_id"
                                class="col-span-6 sm:col-span-4"
                                :label="__('layout.forms.label.country')"
                                :error="$errors->first('country_id')"
                                wire:ignore
                            >
                                <select
                                    wire:model.defer="country_id"
                                    id="country_id"
                                    x-data="{}"
                                    x-init="function() { tomSelect($el, {}) }"
                                    data-placeholder="{{ __('layout.forms.label.country') }}"
                                    autocomplete="off"
                                >
                                    @foreach($countries as $country)
                                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                                    @endforeach
                                </select>
                            </x-admin::forms.group>

                            <x-admin::forms.group
                                for="city"
                                class="col-span-6 sm:col-span-3"
                                :label="__('layout.forms.label.city')"
                                :error="$errors->first('city')"
                            >
                                <x-admin::forms.input wire:model.defer="city" id="city" type="text" autocomplete="off" />
                            </x-admin::forms.group>

                            <x-admin::forms.group
                                for="zipcode"
                                class="col-span-6 sm:col-span-3"
                                :label="__('layout.forms.label.postal_code')"
                                :error="$errors->first('zipcode')"
                            >
                                <x-admin::forms.input wire:model.defer="zipcode" id="zipcode" type="text" autocomplete="off" />
                            </x-admin::forms.group>

                            <div wire:ignore x-data="internationalNumber('#phone_number')" class="col-span-6">
                                <div class="flex items-center justify-between">
                                    <x-admin::label for="phone_number" :value="__('layout.forms.label.phone_number')" />
                                </div>
                                <div class="mt-1 relative">
                                    <x-admin::forms.input wire:model.defer="address_phone_number" id="phone_number" type="tel" class="pr-10" autocomplete="off" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator />

    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-bold leading-6 text-secondary-900 dark:text-white">
                        {{ __('pages/customers.notification_title') }}
                    </h3>
                    <p class="mt-4 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                        {{ __('pages/customers.notification_description') }}
                    </p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">
                <div class="bg-white shadow rounded-md overflow-hidden dark:bg-secondary-800">
                    <div class="px-4 py-5 sm:p-6 space-y-4">
                        <div class="space-y-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <x-admin::forms.checkbox wire:model.defer="opt_in" id="opt_in" />
                                </div>
                                <div class="ml-3 text-sm leading-5">
                                    <x-admin::label for="opt_in" :value="__('pages/customers.marketing_email')" />
                                    <p class="text-sm mt-1 leading-5 text-secondary-500 dark:text-secondary-400">
                                        {{ __('pages/customers.marketing_description') }}
                                    </p>
                                </div>
                            </div>

                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <x-admin::forms.checkbox wire:model.defer="send_mail" id="send_mail" />
                                </div>
                                <div class="ml-3 text-sm leading-5">
                                    <x-admin::label for="send_mail" :value="__('pages/customers.send_credentials')" />
                                    <p class="text-sm mt-1 leading-5 text-secondary-500 dark:text-secondary-400">
                                        {{ __('pages/customers.credential_description') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 pt-5 border-t border-secondary-200 dark:border-secondary-700">
        <div class="flex justify-end">
            <x-admin::buttons.primary wire:click="store" type="button" wire:loading.attr="disabled">
                <x-admin::loader wire:loading wire:target="store" class="text-white" />
                {{ __('layout.forms.actions.save') }}
            </x-admin::buttons.primary>
        </div>
    </div>

</div>

