<div>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.customers.index')"
                                  :title="__('layout.sidebar.customers')"
                                  class="text-muted" />
        <x-admin::breadcrumb.view :title="__('words.actions_label.add_new', ['name' => __('customer')])"
                                  class="active" />
    </x-admin::breadcrumb>

    <x-admin::validation-errors />

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/customers.overview') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/customers.overview_description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="first_name"
                                              class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.first_name')"
                                              :error="$errors->first('first_name')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="first_name"
                                                  id="first_name"
                                                  type="text"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('first_name') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>
                        <x-admin::forms.group for="last_name"
                                              class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.last_name')"
                                              :error="$errors->first('last_name')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="last_name"
                                                  id="last_name"
                                                  type="text"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('last_name') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>
                        <x-admin::forms.group for="email"
                                              class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.email')"
                                              :error="$errors->first('email')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="email"
                                                  id="email"
                                                  type="email"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('email') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>
                        <div class="mb-3 col-md-12">
                            <div class="flex items-center justify-between">
                                <x-admin::label for="phone"
                                                :value="__('layout.forms.label.phone_number')" />
                                <span class="text-secondary-500 text-sm leading-5 dark:text-secondary-400">
                                    {{ __('layout.forms.label.optional') }}
                                </span>
                            </div>
                            <div class="mt-1 relative">
                                <x-admin::forms.input wire:model.defer="phone_number"
                                                      id="phone"
                                                      type="tel"
                                                      class="pr-10"
                                                      autocomplete="off"
                                                      class="{{ $errors->first('phone_number') ? 'is-invalid' : '' }}" />
                            </div>
                            @error('phone_number')
                                <p class="mt-1 text-sm text-danger-500 dark:text-danger-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator />


    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/customers.security_title') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/customers.security_description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <div x-data="{ show: false }"
                             class="mb-3 col-md-12">
                            <div class="flex items-center justify-between">
                                <x-admin::label for="password"
                                                class="form-label">
                                    {{ __('layout.forms.label.password') }} <span class="text-danger">*</span>
                                </x-admin::label>
                                <div class="flex items-center divide-x divide-secondary-200 dark:divide-secondary-600">
                                    <button wire:click="generate"
                                            type="button"
                                            class="pr-2 text-primary-600 text-sm font-medium leading-5 hover:text-primary-500 dark:text-primary-500/50">
                                        {{ __('words.generate') }}
                                    </button>
                                    <button @click="show = !show"
                                            x-text="show ? '{{ __('words.hide') }}' : '{{ __('words.show') }}'"
                                            type="button"
                                            class="pl-2 text-sm text-leading-5 text-primary-600 hover:text-primary-700 focus:outline-none focus:text-primary-700 hover:underline dark:text-primary-500/50">
                                    </button>
                                </div>
                            </div>
                            <div class="mt-1 relative rounded-md shadow-sm">
                                <x-admin::forms.input wire:model.defer="password"
                                                      id="password"
                                                      ::type="show ? 'text' : 'password'"
                                                      type="password"
                                                      autocomplete="off"
                                                      class="{{ $errors->first('password') ? 'pr-10 is-invalid' : '' }}"
                                                      data-bs-toggle="tooltip"
                                                      data-bs-placement="bottom"
                                                      data-bs-html="true"
                                                      data-bs-original-title="{!! __('pages/auth.account.password_helper_validation') !!}" />
                                @error('password')
                                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                        <x-heroicon-s-exclamation-circle class="h-5 w-5 text-danger-500" />
                                    </div>
                                @enderror
                            </div>
                            @error('password')
                                <p class="my-2 text-sm text-danger-500 dark:text-danger-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-2 text-sm text-secondary dark:text-secondary">{!! __('pages/auth.account.password_helper_validation') !!}</p>
                        </div>

                        <x-admin::forms.group for="password_confirmation"
                                              class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.confirm_password')"
                                              :error="$errors->first('password_confirmation')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="password_confirmation"
                                                  id="password_confirmation"
                                                  type="password"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('password_confirmation') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator />

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/customers.address_title') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/customers.address_description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="address_first_name"
                                              class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.first_name')"
                                              :error="$errors->first('address_first_name')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="address_first_name"
                                                  id="address_first_name"
                                                  type="text"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('address_first_name') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>

                        <x-admin::forms.group for="address_last_name"
                                              class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.last_name')"
                                              :error="$errors->first('address_last_name')"
                                              isRequired>
                            <x-admin::forms.input wire:model="address_last_name"
                                                  id="address_last_name"
                                                  type="text"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('address_last_name') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>

                        <x-admin::forms.group for="company_name"
                                              class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.company_name')"
                                              optional>
                            <x-admin::forms.input wire:model.defer="company_name"
                                                  id="company_name"
                                                  type="text"
                                                  autocomplete="off" />
                        </x-admin::forms.group>

                        <x-admin::forms.group for="street_address"
                                              class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.street_address')"
                                              :error="$errors->first('street_address')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="street_address"
                                                  id="street_address"
                                                  type="text"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('street_address') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>

                        <x-admin::forms.group for="street_address_plus"
                                              class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.street_address_plus')"
                                              optional>
                            <x-admin::forms.input wire:model.defer="street_address_plus"
                                                  id="street_address_plus"
                                                  type="text"
                                                  autocomplete="off" />
                        </x-admin::forms.group>

                        <x-admin::forms.group for="country_id"
                                              class="mb-3 col-md-8"
                                              :label="__('layout.forms.label.country')"
                                              :error="$errors->first('country_id')"
                                              isRequired>
                            <select wire:model.defer="country_id"
                                    id="country_id"
                                    required="required"
                                    data-placeholder="{{ __('layout.forms.label.country') }}"
                                    autocomplete="off"
                                    class="{{ $errors->first('country_id') ? 'is-invalid' : '' }}">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="city"
                                              class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.city')"
                                              :error="$errors->first('city')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="city"
                                                  id="city"
                                                  type="text"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('city') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>

                        <x-admin::forms.group for="zipcode"
                                              class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.postal_code')"
                                              :error="$errors->first('zipcode')"
                                              isRequired>
                            <x-admin::forms.input wire:model.defer="zipcode"
                                                  id="zipcode"
                                                  type="text"
                                                  autocomplete="off"
                                                  class="{{ $errors->first('zipcode') ? 'is-invalid' : '' }}" />
                        </x-admin::forms.group>

                        <div class="mb-2 col-md-12">
                            <div class="flex items-center justify-between">
                                <x-admin::label for="phone_number"
                                                :value="__('layout.forms.label.phone_number')" />
                            </div>
                            <div class="mt-1 relative">
                                <x-admin::forms.input wire:model.defer="address_phone_number"
                                                      id="phone_number"
                                                      type="tel"
                                                      class="pr-10"
                                                      autocomplete="off"
                                                      class="{{ $errors->first('address_phone_number') ? 'is-invalid' : '' }}" />
                            </div>
                            @error('address_phone_number')
                                <p class="mt-1 text-sm text-danger-500 dark:text-danger-400">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator />

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/customers.notification_title') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/customers.notification_description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="space-y-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <x-admin::forms.checkbox wire:model.defer="opt_in"
                                                         id="opt_in" />
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <x-admin::label for="opt_in"
                                                :value="__('pages/customers.marketing_email')" />
                                <p class="text-sm mt-1 leading-5 text-secondary-500 dark:text-secondary-400">
                                    {{ __('pages/customers.marketing_description') }}
                                </p>
                            </div>
                        </div>

                        <div class="flex items-start">
                            <div class="flex items-center h-5">
                                <x-admin::forms.checkbox wire:model.defer="send_mail"
                                                         id="send_mail" />
                            </div>
                            <div class="ml-3 text-sm leading-5">
                                <x-admin::label for="send_mail"
                                                :value="__('pages/customers.send_credentials')" />
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

    <div class="mt-6 pt-5 border-t border-secondary-200 dark:border-secondary-700">
        <div class="flex justify-end">
            <x-admin::buttons.primary wire:click="store"
                                      type="button"
                                      wire:loading.attr="disabled"
                                      style="display: inline-flex; align-items: center;">
                <x-admin::loader wire:loading
                                 wire:target="store"
                                 class="text-white me-2" />
                {{ __('layout.forms.actions.save') }}
            </x-admin::buttons.primary>
        </div>
    </div>

</div>
