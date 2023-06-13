<div>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"
                                  class="text-muted"/>
        <x-admin::breadcrumb.view :title="__('words.analytics')" class="active"/>
    </x-admin::breadcrumb>

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <div class="shrink-0 bg-white w-10 h-10 rounded flex items-center justify-center dark:bg-secondary-800">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15.75 7.5h-7.5a.75.75 0 0 0-.75.75v15c0 .414.336.75.75.75h7.5a.75.75 0 0 0 .75-.75v-15a.75.75 0 0 0-.75-.75z"
                            fill="#FFC107"/>
                        <path
                            d="M8.25 15H.75a.75.75 0 0 0-.75.75v7.5c0 .414.336.75.75.75h7.5a.75.75 0 0 0 .75-.75v-7.5a.75.75 0 0 0-.75-.75z"
                            fill="#FFC107"/>
                        <path
                            d="M23.25 0h-7.5a.75.75 0 0 0-.75.75v22.5c0 .414.336.75.75.75h7.5a.75.75 0 0 0 .75-.75V.75a.75.75 0 0 0-.75-.75z"
                            fill="#FFA000"/>
                    </svg>
                </div>
                <h5 class="mt-2 card-title font-semibold">
                    {{ __('pages/settings.analytics.google') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.analytics.google_description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class='bx bxs-x-circle'></i>
                            <div class="ms-sm-1">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="row">

                        <x-admin::forms.group :label="__('layout.forms.label.ga_tracking_id')" for="google_tracking_id"
                                              class="mb-3 col-md-12" :error="$errors->first('google_tracking_id')">
                            <x-admin::forms.input wire:model.defer="google_analytics_tracking_id"
                                                  id="google_tracking_id"
                                                  type="text" autocomplete="off"
                                                  placeholder="UA-XXX"
                                                  class="{{($errors->first('google_tracking_id') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group :label="__('layout.forms.label.ga_view_id')" for="google_view_id"
                                              class="mb-3 col-md-12" :error="$errors->first('google_view_id')">
                            <x-admin::forms.input wire:model.defer="google_analytics_view_id"
                                                  id="google_view_id"
                                                  type="text" autocomplete="off"
                                                  placeholder="123456789"
                                                  class="{{($errors->first('google_view_id') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group :label="__('layout.forms.label.ga_additional_script')"
                                              for="analytic_script"
                                              class="mb-3 col-md-12" :error="$errors->first('analytic_script')">
                            <x-admin::forms.textarea wire:model.defer="google_analytics_add_js"
                                                     id="analytic_script"
                                                     class="{{($errors->first('analytic_script') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <div class="mt-6">
                            <label
                                class="inline-flex items-center text-sm leading-5 font-medium text-secondary-700 dark:text-secondary-300">
                                {{ __('layout.forms.label.ga_json') }}
                                <a href="https://github.com/spatie/laravel-analytics#how-to-obtain-the-credentials-to-communicate-with-google-analytics"
                                   target="_blank"
                                   class="ml-3 text-secondary-400 hover:text-secondary-500 outline-none focus:outline-none leading-4 transition duration-200 ease-in-out">
                                    <i class='bx bxs-help-circle'></i>
                                </a>
                            </label>
                            <div class="mt-2 flex items-center">
                                <div x-data="{ focused: false }">
                                    <span>
                                        <input @focus="focused = true" @blur="focused = false" class="sr-only"
                                               type="file" id="json_file" wire:model="json_file">
                                        <label for="json_file"
                                               :class="{ 'outline-none border-primary-300 shadow-outline-primary': focused }"
                                               class="cursor-pointer inline-flex items-center py-2 px-3 border border-secondary-300 rounded-md text-sm leading-4 font-medium text-secondary-700 hover:text-secondary-500 shadow-sm dark:border-secondary-700 dark:text-secondary-400 dark:hover:text-white">
                                            <i class='bx bx-download mr-1.5' ></i>
                                            {{ __('layout.forms.actions.upload') }}
                                        </label>
                                    </span>
                                </div>
                                @if($credentials_json)
                                    <a class="ml-4 text-sm leading-5 text-secondary-500 underline hover:text-secondary-400 dark:text-secondary-400 dark:hover:text-secondary-200"
                                       href="{{ Storage::url('analytics/service-account-credentials.json') }}">{{ __('View json.') }}</a>
                                @endif
                                @if(! $json_file && ! $credentials_json)
                                    <span class="ml-4 text-sm leading-5 text-secondary-400 dark:text-secondary-500">
                                        {{ __('pages/settings.analytics.no_json') }}
                                    </span>
                                @endif
                            </div>
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
                <div class="shrink-0 bg-white w-10 h-10 rounded flex items-center justify-center dark:bg-secondary-800">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14.089 23.09l-4.167-4.172 8.95-9.043 4.245 4.243-9.028 8.972z" fill="#8AB4F8"/>
                        <path
                            d="M14.119 5.122L9.876.878.88 9.875a2.998 2.998 0 0 0-.002 4.24l.002.003 8.997 8.996 4.162-4.181-6.798-6.93 6.879-6.88z"
                            fill="#4285F4"/>
                        <path
                            d="M23.116 9.875L14.119.878a3 3 0 0 0-4.244 4.243l9.002 8.997a3 3 0 1 0 4.242-4.243h-.003z"
                            fill="#8AB4F8"/>
                        <path d="M11.964 24.002a2.974 2.974 0 1 0 0-5.948 2.974 2.974 0 0 0 0 5.948z"
                              fill="#246FDB"/>
                    </svg>
                </div>
                <h5 class="mt-2 card-title font-semibold">
                    {{ __('pages/settings.analytics.gtag') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.analytics.gtag_description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class='bx bxs-x-circle'></i>
                            <div class="ms-sm-1">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <x-admin::forms.group :label="__('layout.forms.label.gtag')" for="google_tag_id"
                                              class="col-md-12" :error="$errors->first('google_tag_id')">
                            <x-admin::forms.input wire:model.defer="google_tag_manager_account_id"
                                                  id="google_tag_id"
                                                  type="text" autocomplete="off"
                                                  placeholder="GTM-XXX"
                                                  class="{{($errors->first('google_tag_id') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <p class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
                            {{ __('components.learn_more') }}
                            <a href="https://marketingplatform.google.com/about/tag-manager" target="_blank"
                               class="text-primary-500 hover:text-primary-400">
                                {{ __('pages/settings.analytics.gtag') }}
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <x-admin::separator/>

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <div class="shrink-0 bg-white w-10 h-10 rounded flex items-center justify-center dark:bg-secondary-800">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M15 4h3a.5.5 0 0 0 .5-.5v-3A.5.5 0 0 0 18 0h-3a5.506 5.506 0 0 0-5.5 5.5V9H6a.5.5 0 0 0-.5.5v3a.5.5 0 0 0 .5.5h3.5v10.5a.5.5 0 0 0 .5.5h3a.5.5 0 0 0 .5-.5V13H17a.5.5 0 0 0 .474-.342l1-3A.5.5 0 0 0 18 9h-4.5V5.5A1.5 1.5 0 0 1 15 4z"
                            fill="#2196F3"/>
                    </svg>
                </div>
                <h5 class="mt-2 card-title font-semibold">
                    {{ __('pages/settings.analytics.pixel') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.analytics.pixel_description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    @if (session()->has('error'))
                        <div class="alert alert-danger d-flex align-items-center" role="alert">
                            <i class='bx bxs-x-circle'></i>
                            <div class="ms-sm-1">
                                {{ session('error') }}
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        <x-admin::forms.group :label="__('layout.forms.label.pixel_id')" for="pixel_facebook_id"
                                              class="col-md-12" :error="$errors->first('pixel_facebook_id')">
                            <x-admin::forms.input wire:model.defer="facebook_pixel_account_id"
                                                  id="pixel_facebook_id"
                                                  type="text" autocomplete="off"
                                                  placeholder="12345678"
                                                  class="{{($errors->first('pixel_facebook_id') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <p class="mt-2 text-sm text-secondary-500 dark:text-secondary-400">
                            {{ __('components.learn_more') }}
                            <a href="https://www.facebook.com/business/learn/facebook-ads-pixel" target="_blank"
                               class="text-primary-500 hover:text-primary-400">
                                {{ __('pages/settings.analytics.pixel') }}
                            </a>.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-6 pt-5 pb-10 border-t border-secondary-200 dark:border-secondary-700">
        <div class="text-right">
            <x-admin::buttons.primary wire:click="store" type="button" wire:loading.attr="disabled"
                                      style="display: inline-flex; align-items: center;">
                <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
                {{ __('layout.forms.actions.save') }}
            </x-admin::buttons.primary>
        </div>
    </div>
</div>
