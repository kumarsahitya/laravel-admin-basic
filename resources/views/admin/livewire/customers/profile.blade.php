<div class="mt-6 card shadow-md">
    <div class="card-header d-flex align-items-center justify-content-between">
        <div>
            <h5 class="card-title mb-0">{{ __('pages/customers.profile.title') }}</h5>
            <small class="card-subtitle">{{ __('pages/customers.profile.description') }}</small>
        </div>
    </div>
    <div class="card-body">
        <dl
            class="border-t border-secondary-200 dark:border-secondary-700 divide-y divide-secondary-200 dark:divide-secondary-700">
            <div x-data="{ open: @entangle('firstNameUpdate') }"
                 class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('layout.forms.label.first_name') }}
                </dt>
                <dd
                    class="flex space-x-4 text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <div class="grow">
                        <span x-show="!open">{{ $firstName }}</span>
                        <div x-show="open"
                             style="display: none">
                            <div class="w-full sm:max-w-xs">
                                <x-admin::forms.group :error="$errors->first('firstName')">
                                    <x-admin::forms.input wire:model.lazy="firstName"
                                                          id="firstName"
                                                          type="text"
                                                          autocomplete="off" />
                                </x-admin::forms.group>
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 ml-4 my-auto">
                        <span x-show="!open">
                            <button @click="open = true"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.update') }}
                            </button>
                        </span>
                        <span x-show="open"
                              class="flex items-start space-x-4"
                              style="display: none">
                            <button wire:click="saveFirstName"
                                    type="button"
                                    class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500">
                                <x-admin::loader wire:loading
                                                 wire:target="saveFirstName"
                                                 class="text-primary-600" />
                                <span class="ml-1.5">{{ __('layout.forms.actions.save') }}</span>
                            </button>
                            <span class="text-secondary-300 dark:text-secondary-700"
                                  aria-hidden="true">|</span>
                            <button x-on:click="open = false"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.cancel') }}
                            </button>
                        </span>
                    </div>
                </dd>
            </div>
            <div x-data="{ open: @entangle('lastNameUpdate') }"
                 class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('layout.forms.label.last_name') }}
                </dt>
                <dd
                    class="flex space-x-4 text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <div class="grow">
                        <span x-show="!open">{{ $lastName }}</span>
                        <div x-show="open"
                             style="display: none">
                            <div class="w-full sm:max-w-xs">
                                <x-admin::forms.group :error="$errors->first('lastName')">
                                    <x-admin::forms.input wire:model.lazy="lastName"
                                                          id="lastName"
                                                          type="text"
                                                          autocomplete="off" />
                                </x-admin::forms.group>
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 ml-4 my-auto">
                        <span x-show="!open">
                            <button @click="open = true"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.update') }}
                            </button>
                        </span>
                        <span x-show="open"
                              class="flex items-start space-x-4"
                              style="display: none">
                            <button wire:click="saveLastName"
                                    type="button"
                                    class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500">
                                <x-admin::loader wire:loading
                                                 wire:target="saveLastName"
                                                 class="text-primary-600" />
                                <span class="ml-1.5">{{ __('layout.forms.actions.save') }}</span>
                            </button>
                            <span class="text-secondary-300 dark:text-secondary-700"
                                  aria-hidden="true">|</span>
                            <button x-on:click="open = false"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.cancel') }}
                            </button>
                        </span>
                    </div>
                </dd>
            </div>
            <div class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('layout.forms.label.photo') }}
                </dt>
                <dd
                    class="flex space-x-4 text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <span class="grow">
                        <img class="h-8 w-8 rounded-full"
                             src="{{ $customer->picture }}"
                             alt="">
                    </span>
                </dd>
            </div>
            <div x-data="{ open: @entangle('emailUpdate') }"
                 class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('layout.forms.label.email') }}
                </dt>
                <dd
                    class="flex space-x-4 text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <div class="grow">
                        <span x-show="!open">{{ $email }}</span>
                        <div x-show="open"
                             style="display: none">
                            <div class="w-full sm:max-w-xs">
                                <x-admin::forms.group :error="$errors->first('email')">
                                    <x-admin::forms.input wire:model.debounce.350ms="email"
                                                          id="email"
                                                          type="text"
                                                          autocomplete="off" />
                                </x-admin::forms.group>
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 ml-4 my-auto">
                        <span x-show="!open">
                            <button @click="open = true"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.update') }}
                            </button>
                        </span>
                        <span x-show="open"
                              class="flex items-start space-x-4"
                              style="display: none">
                            <button wire:click="saveEmail"
                                    type="button"
                                    class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500">
                                <x-admin::loader wire:loading
                                                 wire:target="saveEmail"
                                                 class="text-primary-600" />
                                <span class="ml-1.5">{{ __('layout.forms.actions.save') }}</span>
                            </button>
                            <span class="text-secondary-300 dark:text-secondary-700"
                                  aria-hidden="true">|</span>
                            <button x-on:click="$wire.cancelEmail()"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.cancel') }}
                            </button>
                        </span>
                    </div>
                </dd>
            </div>

            <div x-data="{ open: @entangle('phoneNumberUpdate') }"
                 class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('layout.forms.label.phone_number') }}
                </dt>
                <dd
                    class="flex space-x-4 text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <div class="grow">
                        <p x-show="!open"
                           class="flex items-center mb-0">
                            <span>{{ $phoneNumber }}</span>
                        </p>
                        <div x-show="open"
                             style="display: none">
                            <div class="w-full sm:max-w-xs relative rounded-md shadow-sm">
                                <x-admin::forms.input wire:model.lazy="phoneNumber"
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
                    <div class="shrink-0 ml-4 my-auto">
                        <span x-show="!open">
                            <button @click="open = true"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.update') }}
                            </button>
                        </span>
                        <span x-show="open"
                              class="flex items-start space-x-4"
                              style="display: none">
                            <button wire:click="savePhoneNumber"
                                    type="button"
                                    class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500">
                                <x-admin::loader wire:loading
                                                 wire:target="savePhoneNumber"
                                                 class="text-primary-600" />
                                <span class="ml-1.5">{{ __('layout.forms.actions.save') }}</span>
                            </button>
                            <span class="text-secondary-300 dark:text-secondary-700"
                                  aria-hidden="true">|</span>
                            <button @click="open = false"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.cancel') }}
                            </button>
                        </span>
                    </div>
                </dd>
            </div>
            <div x-data="{ open: @entangle('birthDateUpdate') }"
                 class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('layout.forms.label.birth_date') }}
                </dt>
                <dd
                    class="flex space-x-4 text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <div class="grow">
                        <p x-show="!open"
                           class="flex items-center mb-0">
                            <i class="bx bx-cake -ml-1 mr-2.5 text-secondary-500 dark:text-secondary-400"></i>
                            <span>{{ $birthDateFormatted }}</span>
                        </p>
                        <div x-show="open"
                             style="display: none">
                            <div class="w-full sm:max-w-xs relative rounded-md shadow-sm">
                                <x-datetime-picker :placeholder="__('1970-01-01')"
                                                   wire:model.lazy="birthDate"
                                                   parse-format="YYYY-MM-DD"
                                                   :without-time="true" />
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 ml-4 my-auto">
                        <span x-show="!open">
                            <button @click="open = true"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.update') }}
                            </button>
                        </span>
                        <span x-show="open"
                              class="flex items-start space-x-4"
                              style="display: none">
                            <button wire:click="saveBirthDate"
                                    type="button"
                                    class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500">
                                <x-admin::loader wire:loading
                                                 wire:target="saveBirthDate"
                                                 class="text-primary-600" />
                                <span class="ml-1.5">{{ __('layout.forms.actions.save') }}</span>
                            </button>
                            <span class="text-secondary-300 dark:text-secondary-700"
                                  aria-hidden="true">|</span>
                            <button @click="open = false"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.cancel') }}
                            </button>
                        </span>
                    </div>
                </dd>
            </div>
            <div x-data="{ open: @entangle('genderUpdate') }"
                 class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('layout.forms.label.gender') }}
                </dt>
                <dd
                    class="flex space-x-4 text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <div class="grow">
                        <span x-show="!open"
                              class="capitalize">{{ in_array($gender, ['male', 'female']) ? $gender : $otherGender }}</span>
                        <div x-show="open"
                             style="display: none">
                            <div class="w-full sm:max-w-xs">
                                <x-admin::forms.select wire:model.lazy="gender"
                                                       aria-label="{{ __('layout.forms.label.gender') }}">
                                    <option value="">{{ __('words.select') }}</option>
                                    <option value="male">{{ __('words.male') }}</option>
                                    <option value="female">{{ __('words.female') }}</option>
                                    <option value="other">{{ __('words.other') }}</option>
                                </x-admin::forms.select>

                                @if ($gender === 'other')
                                    <x-admin::forms.group :error="$errors->first('otherGender')"
                                                          class="my-3">
                                        <x-admin::forms.input wire:model.debounce.350ms="otherGender"
                                                              type="text"
                                                              autocomplete="off" />
                                    </x-admin::forms.group>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="shrink-0 ml-4 my-auto">
                        <span x-show="!open">
                            <button @click="open = true"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.update') }}
                            </button>
                        </span>
                        <span x-show="open"
                              class="flex items-start space-x-4"
                              style="display: none">
                            <button wire:click="saveGender"
                                    type="button"
                                    class="inline-flex items-center font-medium text-primary-600 hover:text-primary-500">
                                <x-admin::loader wire:loading
                                                 wire:target="saveGender"
                                                 class="text-primary-600" />
                                <span class="ml-1.5">{{ __('layout.forms.actions.save') }}</span>
                            </button>
                            <span class="text-secondary-300 dark:text-secondary-700"
                                  aria-hidden="true">|</span>
                            <button @click="open = false"
                                    type="button"
                                    class="font-medium text-primary-600 hover:text-primary-500">
                                {{ __('layout.forms.actions.cancel') }}
                            </button>
                        </span>
                    </div>
                </dd>
            </div>
        </dl>
    </div>
    <div class="card-header d-flex align-items-center justify-content-between pt-0">
        <div>
            <h5 class="card-title mb-0">{{ __('pages/customers.profile.account') }}</h5>
            <small class="card-subtitle">{{ __('pages/customers.profile.account_description') }}</small>
        </div>
    </div>
    <div class="card-body">
        <dl class="divide-y divide-secondary-200 dark:divide-secondary-700 mb-0">
            <div class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('pages/customers.profile.marketing') }}
                </dt>
                <dd class="flex text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 col-sm-8">
                    <span role="checkbox"
                          x-data="{ on: @entangle('optIn') }"
                          x-on:click="on = !on"
                          @keydown.space.prevent="on = !on"
                          x-bind:class="{ 'bg-secondary-200 dark:bg-secondary-700': !on, 'bg-primary-600': on }"
                          :aria-checked="on.toString()"
                          aria-checked="true"
                          tabindex="0"
                          class="relative inline-flex shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline sm:ml-auto bg-primary-600">
                        <span aria-hidden="true"
                              x-bind:class="{ 'translate-x-5': on, 'translate-x-0': !on }"
                              class="inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200 translate-x-5"></span>
                    </span>
                </dd>
            </div>
            <div class="py-3 space-y-1 row">
                <dt class="text-sm leading-5 font-medium text-secondary-500 dark:text-secondary-400 col-sm-4">
                    {{ __('pages/customers.profile.two_factor') }}
                </dt>
                <dd class="flex text-sm leading-5 text-secondary-900 sm:mt-0 sm:col-span-2 dark:text-white col-sm-8">
                    <span
                          class="px-2 inline-flex text-xs leading-5 font-semibold sm:ml-auto rounded-full {{ $hasEnabledTwoFactor ? 'bg-green-100 text-green-800' : 'bg-secondary-100 text-secondary-800 dark:bg-secondary-700 dark:text-secondary-300' }}">
                        {{ $hasEnabledTwoFactor ? __('layout.forms.actions.enabled') : __('layout.forms.actions.disabled') }}
                    </span>
                </dd>
            </div>
        </dl>
    </div>
</div>
