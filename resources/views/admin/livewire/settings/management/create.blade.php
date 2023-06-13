<div>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.users')"
                                  :title="__('pages/settings.roles_permissions.users_role')"/>
        <x-admin::breadcrumb.view :title="__('pages/settings.roles_permissions.add_admin')" class="active"/>
    </x-admin::breadcrumb>

    <div class="row">
        <div class="col-md-12">
            <div>
                <h3 class="text-lg leading-6 font-medium text-secondary-900 dark:text-white">
                    {{ __('pages/settings.roles_permissions.login_information') }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                    {{ __('pages/settings.roles_permissions.login_information_summary') }}
                </p>
            </div>
            <div class="card mb-4 shadow-md overflow-hidden">
                <div class="card-body">

                    <div class="row mb-3 sm:pt-5">
                        <x-admin::label for="email" class="col-sm-4 col-form-label">
                            {{ __('layout.forms.label.email') }} <span class="text-danger-500">*</span>
                        </x-admin::label>
                        <div class="col-sm-8">
                            <div class="max-w-lg relative rounded-md shadow-sm">
                                <x-admin::forms.input wire:model.lazy="email" id="email" type="email"
                                                      autocomplete="off"
                                                      class="form-control {{($errors->first('email') ?  'is-invalid' : '')}}"/>
                            </div>
                            @error('email')
                            <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 mt-6 sm:mt-5 sm:pt-5 sm:border-t sm:border-secondary-200">
                        <x-admin::label for="password" class="col-sm-4 col-form-label">
                            {{ __('layout.forms.label.password') }} <span class="text-danger-500">*</span>
                        </x-admin::label>
                        <div class="col-sm-8" x-data="{ show: false }">
                            <div class="flex items-center justify-between max-w-lg">
                                <button wire:click="generate" type="button"
                                        class="text-sm font-medium leading-5 text-primary-500 hover:text-primary-400">
                                    {{ __('words.generate') }}
                                </button>
                                <button
                                    @click="show = !show"
                                    x-text="show ? '{{ __('words.hide') }}' : '{{ __('words.show') }}'"
                                    type="button"
                                    class="text-sm text-leading-5 text-primary-600 hover:text-primary-500 focus:outline-none focus:text-primary-700 hover:underline">
                                </button>
                            </div>
                            <div class="mt-2 max-w-lg relative rounded-md shadow-sm">
                                <x-admin::forms.input wire:model.defer="password" id="password"
                                                      ::type="show ? 'text' : 'password'" type="password"
                                                      autocomplete="off"
                                                      class="{{($errors->first('password') ?  'is-invalid pr-10' : '')}}"/>
                                @error('password')
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <x-heroicon-s-exclamation-circle class="h-5 w-5 text-danger-500"/>
                                </div>
                                @enderror
                            </div>
                            @error('password')
                            <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 mt-6 sm:mt-5 sm:pt-5 sm:border-t sm:border-secondary-200">
                        <x-admin::label for="about" class="col-sm-4 col-form-label">
                            {{ __('words.invitation') }}
                        </x-admin::label>
                        <div class="col-sm-8">
                            <div class="relative flex items-start">
                                <div class="flex items-center h-5">
                                    <span wire:model="send_mail" role="checkbox" tabindex="0"
                                          x-on:click="$dispatch('input', !on); on = !on"
                                          @keydown.space.prevent="on = !on"
                                          :aria-checked="on.toString()" aria-checked="false" x-data="{ on: false }"
                                          x-bind:class="{ 'bg-secondary-200 dark:bg-secondary-700': !on, 'bg-primary-600': on }"
                                          class="bg-secondary-200 relative inline-flex shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors  dark:bg-secondary-700">
                                        <input type="hidden" x-ref="input" aria-label="Visible" x-model="on"/>
                                        <span aria-hidden="true"
                                              x-bind:class="{ 'translate-x-5': on, 'translate-x-0': !on }"
                                              class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform"></span>
                                    </span>
                                </div>
                                <div class="ml-3 text-sm leading-5">
                                    <x-admin::label for="send_mail"
                                                    :value="__('pages/settings.roles_permissions.send_invite')"/>
                                    <p class="max-w-lg text-sm text-secondary-500 dark:text-secondary-400">
                                        {{ __('pages/settings.roles_permissions.send_invite_summary') }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="mt-4">
                <h3 class="text-lg leading-6 font-medium text-secondary-900 dark:text-white">
                    {{ __('pages/settings.roles_permissions.personal_information') }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                    {{ __('pages/settings.roles_permissions.personal_information_summary') }}
                </p>
            </div>
            <div class="card mb-4 shadow-md overflow-hidden">
                <div class="card-body">
                    <div class="row mb-3 sm:pt-5">
                        <x-admin::label for="first_name" class="col-sm-4 col-form-label">
                            {{ __('layout.forms.label.first_name') }} <span class="text-danger-500">*</span>
                        </x-admin::label>
                        <div class="col-sm-8">
                            <div class="max-w-lg relative rounded-md shadow-sm">
                                <x-admin::forms.input wire:model.lazy="first_name" id="first_name" type="text"
                                                      autocomplete="off"
                                                      class="form-control {{($errors->first('first_name') ?  'is-invalid' : '')}}"/>
                            </div>
                            @error('first_name')
                            <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 mt-6 sm:mt-5 sm:pt-5 sm:border-t sm:border-secondary-200">
                        <x-admin::label for="last_name" class="col-sm-4 col-form-label">
                            {{ __('layout.forms.label.last_name') }} <span class="text-danger-500">*</span>
                        </x-admin::label>
                        <div class="col-sm-8">
                            <div class="max-w-lg relative rounded-md shadow-sm">
                                <x-admin::forms.input wire:model.lazy="last_name" id="last_name" type="text"
                                                      autocomplete="off"
                                                      class="form-control {{($errors->first('last_name') ?  'is-invalid' : '')}}"/>
                            </div>
                            @error('last_name')
                            <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3 mt-6 sm:mt-5 sm:pt-5 sm:border-t sm:border-secondary-200">
                        <x-admin::label for="gender" class="col-sm-4 col-form-label">
                            {{ __('layout.forms.label.gender') }}
                        </x-admin::label>
                        <div class="col-sm-8">
                            <div class="max-w-lg relative rounded-md shadow-sm">
                                <x-admin::forms.select wire:model.lazy="gender" id="gender">
                                    <option value="male">{{ __('words.male') }}</option>
                                    <option value="female">{{ __('words.female') }}</option>
                                </x-admin::forms.select>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3 mt-6 sm:mt-5 sm:pt-5 sm:border-t sm:border-secondary-200">
                        <x-admin::label for="phone_number" class="col-sm-4 col-form-label">
                            {{ __('layout.forms.label.phone_number') }}
                        </x-admin::label>
                        <div class="col-sm-8">
                            <div class="max-w-lg rounded-md shadow-sm">
                                <x-admin::forms.input wire:model.lazy="phone_number" type="tel" id="phone_number"
                                                      autocomplete="off"
                                                      class="form-control {{($errors->first('last_name') ?  'is-invalid' : '')}}"/>
                            </div>
                            @error('phone_number')
                            <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="mt-4">
                <h3 class="text-lg leading-6 font-medium text-secondary-900 dark:text-white">
                    {{ __('pages/settings.roles_permissions.role_information') }}
                </h3>
                <p class="mt-1 max-w-2xl text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                    {{ __('pages/settings.roles_permissions.personal_information_summary') }}
                </p>
            </div>
            <div class="card mb-4 shadow-md overflow-hidden">
                <div class="card-body">
                    <div>
                        <div role="group" aria-labelledby="roles-lists">
                            <div class="sm:grid sm:grid-cols-3 sm:gap-4 sm:items-baseline">
                                <div>
                                    <div
                                        class="text-base col-form-label leading-6 font-medium text-secondary-900 sm:text-sm sm:leading-5 dark:text-white"
                                        id="roles-lists">
                                        {{ __('pages/settings.roles_permissions.roles') }}
                                    </div>
                                </div>
                                <div class="sm:col-span-2">
                                    <div class="max-w-lg">
                                        <p class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                            {{ __('pages/settings.roles_permissions.choose_role') }}
                                        </p>
                                        <div class="mt-4 space-y-4">
                                            @foreach($roles as $role)
                                                <div class="flex items-center">
                                                    <x-admin::forms.radio wire:model.lazy="role_id"
                                                                          id="role_{{ $role->id }}"
                                                                          name="role_id" value="{{ $role->id }}"/>
                                                    <label for="role_{{ $role->id }}" class="ml-3 cursor-pointer">
                                                <span
                                                    class="block text-sm leading-5 font-medium text-secondary-700 dark:text-secondary-400">
                                                    {{ $role->display_name ?? $role->name }}
                                                </span>
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                        @error('role_id')
                                        <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                                        @enderror

                                        @if($is_admin)
                                            <div class="rounded-md bg-yellow-50 p-4 mt-6">
                                                <div class="flex">
                                                    <div class="shrink-0">
                                                        <x-heroicon-s-exclamation class="h-5 w-5 text-yellow-400"/>
                                                    </div>
                                                    <div class="ml-3">
                                                        <h3 class="text-sm leading-5 font-medium text-yellow-800">
                                                            {{ __('words.attention_needed') }}
                                                        </h3>
                                                        <div class="mt-2 text-sm leading-5 text-yellow-700">
                                                            <p>
                                                                {{ __('words.attention_description') }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="mt-6 pb-10">
        <div class="mt-5 pt-5 border-t border-secondary-200 dark:border-secondary-700">
            <div class="text-right">
                <x-admin::buttons.secondary class="mr-2" :link="route('admin.settings.users')">
                    {{ __('layout.forms.actions.cancel') }}
                </x-admin::buttons.secondary>
                <x-admin::buttons.primary wire:click="store" type="button" wire:loading.attr="disabled"
                                          style="display: inline-flex; align-items: center;">
                    <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
                    {{ __('layout.forms.actions.save') }}
                    </x-shopper::buttons.primary>
            </div>
        </div>
    </div>
</div>
