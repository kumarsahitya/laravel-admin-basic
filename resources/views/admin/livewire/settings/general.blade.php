<div>

    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"
                                  class="text-muted"/>
        <x-admin::breadcrumb.view :title="__('pages/settings.settings.title')" class="active"/>
    </x-admin::breadcrumb>

    <x-admin::validation-errors/>

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/settings.settings.store_details') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.settings.store_detail_summary') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="shop_name" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.store_name')"
                                              :error="$errors->first('shop_name')" isRequired>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bx-store-alt"></i>
                                </span>
                                <x-admin::forms.input type='text' wire:model.defer='shop_name'
                                                      id='shop_name' autocomplete='off'
                                                      class="{{($errors->first('shop_name') ?  'is-invalid' : '')}}"/>
                            </div>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="shop_email" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.email')"
                                              :error="$errors->first('shop_email')"
                                              :helpText="__('pages/settings.settings.email_helper')"
                                              isRequired>
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bxs-envelope"></i>
                                </span>
                                <x-admin::forms.input type='email' wire:model.defer='shop_email'
                                                      id='shop_email' autocomplete='off'
                                                      class="{{($errors->first('shop_name') ?  'is-invalid' : '')}}"/>
                            </div>
                        </x-admin::forms.group>

                        <div wire:ignore class="mb-3 col-md-6">
                            <x-admin::forms.group
                                for="phone_number"
                                :label="__('layout.forms.label.phone_number')"
                                :error="$errors->first('shop_phone_number')"
                                :helpText="__('pages/settings.settings.phone_number_helper')"
                            >
                                <x-admin::forms.input type="tel" wire:model.defer="shop_phone_number"
                                                      id="phone_number" autocomplete="off"
                                                      class="{{($errors->first('shop_name') ?  'is-invalid' : '')}}"/>
                            </x-admin::forms.group>
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
                    {{ __('pages/settings.settings.assets') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.settings.assets_summary') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <x-admin::forms.group :label="__('layout.forms.label.logo')" for="logo"
                                                  :error="$errors->first('logo')" noShadow>
                                <x-admin::forms.avatar-upload wire:model.debounce.550ms="logo" id="photo"
                                                              class="setting-logo-input" hidden
                                                              :resetClass="('setting-logo-reset')"
                                                              :resetClick="('removeLogo')"
                                                              accept="image/png, image/jpeg"
                                                              :helpText="__('components.files.type_size_kb', ['size' => '300'])">
                                <span
                                    class="flex items-center justify-center w-24 h-24 overflow-hidden rounded-full bg-secondary-100 dark:bg-secondary-700">
                                    @if ($logo)
                                        <img class="h-full w-full bg-center" src="{{ $logo->temporaryUrl() }}"
                                             alt="Store logo">
                                    @elseif($shop_logo)
                                        <img class="h-full w-full bg-center" src="{{ load_asset($shop_logo) }}"
                                             alt="Store logo">
                                    @else
                                        <svg class="w-16 h-16 text-secondary-300 dark:text-secondary-400" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-li necap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    @endif
                                </span>
                                </x-admin::forms.avatar-upload>
                            </x-admin::forms.group>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-6">
                                <x-admin::forms.group :label="__('layout.forms.label.favicon')" for="favicon"
                                                      :error="$errors->first('favicon')" noShadow>
                                    <x-admin::forms.avatar-upload wire:model.debounce.550ms="favicon" id="favicon"
                                                                  class="setting-favicon-input" hidden
                                                                  :resetClass="('setting-favicon-reset')"
                                                                  :resetClick="('removeFavicon')"
                                                                  accept="image/png, image/jpeg, image/x-icon"
                                                                  :helpText="__('components.files.fix_type_size_kb', ['type' => 'PNG, JPG, ICO', 'size' => '50'])">
                                <span
                                    class="flex items-center justify-center w-12 h-12 overflow-hidden rounded-full bg-secondary-100 dark:bg-secondary-700">
                                    @if ($favicon)
                                        <img class="h-full w-full bg-center" src="{{ $favicon->temporaryUrl() }}"
                                             alt="Store favicon">
                                    @elseif($shop_favicon)
                                        <img class="h-full w-full bg-center" src="{{ load_asset($shop_favicon) }}"
                                             alt="Store favicon">
                                    @else
                                        <svg class="w-8 h-8 text-secondary-300 dark:text-secondary-400" fill="none"
                                             stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-li necap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                    @endif
                                </span>
                                    </x-admin::forms.avatar-upload>
                                </x-admin::forms.group>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mt-6">
                                <x-admin::label value="{{ __('layout.forms.label.cover_photo') }}"/>
                                <div class="mt-1">
                                    @if($cover)
                                        <div>
                                            <div class="overflow-hidden rounded-md shadow shrink-0">
                                                <img class="object-cover w-full h-40" src="{{ $cover->temporaryUrl() }}"
                                                     alt="">
                                            </div>
                                            <div class="flex items-center mt-1">
                                                <x-admin::buttons.danger wire:click="removeCover" type="button">
                                                    <span class="tf-icons bx bx-trash"></span>&nbsp;
                                                    {{ __('layout.forms.actions.remove') }}
                                                </x-admin::buttons.danger>
                                            </div>
                                        </div>
                                    @elseif($shop_cover)
                                        <div>
                                            <div class="overflow-hidden rounded-md shadow shrink-0">
                                                <img class="object-cover w-full h-40"
                                                     src="{{ load_asset($shop_cover) }}"
                                                     alt="Store Cover image">
                                            </div>
                                            <div class="flex items-center mt-1">
                                                <x-admin::buttons.danger wire:click="removeCover" type="button">
                                                    <span class="tf-icons bx bx-trash"></span>&nbsp;
                                                    {{ __('layout.forms.actions.remove') }}
                                                </x-admin::buttons.danger>
                                            </div>
                                        </div>
                                    @else
                                        <div class="w-full">
                                            <label for="shop_cover"
                                                   class="flex justify-center px-6 pt-5 pb-6 mt-2 border-2 border-dashed rounded-md cursor-pointer group border-secondary-300 dark:border-secondary-700">
                                                <div class="text-center">
                                                    <svg class="w-12 h-12 mx-auto text-secondary-400"
                                                         stroke="currentColor"
                                                         fill="none" viewBox="0 0 48 48">
                                                        <path
                                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"/>
                                                    </svg>
                                                    <p class="mt-1 text-sm text-secondary-500 dark:text-secondary-400">
                                                    <span
                                                        class="font-medium transition duration-150 ease-in-out text-primary-600 group-hover:text-primary-500 focus:outline-none focus:underline">
                                                        {{ __('components.files.file') }}
                                                    </span>
                                                        {{ __('components.files.drag_n_drop') }}
                                                    </p>
                                                    <p class="mt-1 text-xs text-secondary-500 dark:text-secondary-400">
                                                        {{ __('components.files.type_size', ['size' => 1]) }}
                                                    </p>
                                                    <input id="shop_cover" type="file" wire:model.defer="cover"
                                                           class="sr-only">
                                                </div>
                                            </label>
                                        </div>
                                    @endif
                                </div>
                                @error('cover')
                                <p class="mt-2 text-sm text-danger-500">{{ $message }}</p>
                                @enderror
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
                <h5 class="card-title font-semibold">
                    {{ __('pages/settings.seo.title') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.seo.description') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="seo_title" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.title')"
                                              :error="$errors->first('seo_title')">
                            <x-admin::forms.input wire:model.defer="seo_title" id="seo_title"
                                                  type="text" autocomplete="off"
                                                  :placeholder="__('layout.forms.label.title')"
                                                  class="{{($errors->first('seo_title') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <div class="mb-3 col-md-12">
                            <div class="flex items-center justify-between">
                                <x-admin::label for="seo_description" class="form-label"
                                                :value="__('layout.forms.label.description')"/>
                                <span
                                    class="ml-4 text-sm leading-5 text-secondary-500 dark:text-secondary-400">{{ __('components.seo.characters') }}</span>
                            </div>
                            <div class="mt-1 rounded-md shadow-sm">
                                <x-admin::forms.textarea wire:model.defer="seo_description"
                                                         id="seo_description"
                                                         autocomplete="off"
                                                         class="{{($errors->first('seo_description') ?  'is-invalid' : '')}}"/>
                            </div>
                            @error('seo_description')
                            <span class="mt-n2 text-danger">{{ $errors->first('seo_description') }}</span>
                            @enderror
                        </div>
                        <x-admin::forms.group for="seo_keyword" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.keyword')"
                                              :error="$errors->first('seo_keyword')">
                            <x-admin::forms.input wire:model.defer="seo_keyword" id="seo_keyword"
                                                  type="text" autocomplete="off"
                                                  :placeholder="__('layout.forms.label.keyword')"
                                                  class="{{($errors->first('seo_keyword') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
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
                    {{ __('pages/settings.settings.store_address') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.settings.store_address_summary') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="shop_legal_name" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.legal_name')"
                                              :error="$errors->first('shop_legal_name')" isRequired>
                            <x-admin::forms.input wire:model.defer="shop_legal_name" id="shop_legal_name"
                                                  type="text" autocomplete="off"
                                                  :placeholder="__('ShopStation LLC')"
                                                  class="{{($errors->first('shop_legal_name') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <div class="mb-3 col-md-12">
                            <x-admin::forms.group :label="__('layout.forms.label.about')" for="about">
                                <livewire:forms.trix :value="$shop_about"/>
                            </x-admin::forms.group>
                        </div>

                        <x-admin::forms.group for="shop_street_address" class="mb-3 col-md-12"
                                              :label=" __('layout.forms.label.street_address')"
                                              :error="$errors->first('shop_street_address')" isRequired>
                            <x-admin::forms.input wire:model.defer="shop_street_address"
                                                  id="shop_street_address" type="text" autocomplete="off"
                                                  :placeholder="__('layout.forms.label.street_address')"
                                                  class="{{($errors->first('shop_street_address') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="shop_country_id" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.country')"
                                              wire:ignore isRequired
                                              :error="$errors->first('shop_country_id')">
                            <select wire:model.defer="shop_country_id"
                                    id="shop_country_id" autocomplete="off"
                                    x-data="{}">
                                @foreach($countries as $country)
                                    <option
                                        value="{{ $country->id }}" @selected($shop_country_id === $country->id)>
                                        {{ $country->name }}
                                    </option>
                                @endforeach
                            </select>
                        </x-admin::forms.group>
                        @error('shop_country_id')
                        <span class="mt-n2 text-danger">{{ $errors->first('shop_country_id') }}</span>
                        @enderror
                        <x-admin::forms.group for="shop_city" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.city')"
                                              :error="$errors->first('shop_city')" isRequired>
                            <x-admin::forms.input wire:model.defer="shop_city"
                                                  id="shop_city" type="text" autocomplete="off"
                                                  :placeholder="__('layout.forms.label.city')"
                                                  class="{{($errors->first('shop_city') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <x-admin::forms.group for="shop_zipcode" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.postal_code')"
                                              :error="$errors->first('shop_zipcode')" isRequired>
                            <x-admin::forms.input wire:model.defer="shop_zipcode"
                                                  id="shop_zipcode" type="text" autocomplete="off"
                                                  :placeholder="__('layout.forms.label.postal_code')"
                                                  class="{{($errors->first('shop_zipcode') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
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
                    {{ __('pages/settings.settings.store_currency') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.settings.store_currency_summary') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="shop_currency_id" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.currency')"
                                              wire:ignore isRequired
                                              :error="$errors->first('shop_currency_id')">
                            <select
                                wire:model.defer="shop_currency_id"
                                id="shop_currency_id"
                                x-data="{}"
                                autocomplete="off">
                                @foreach($currencies as $currency)
                                    <option
                                        value="{{ $currency->id }}" @selected($currency->id === $shop_currency_id)>{{ $currency->name . ' (' . $currency->code . ')' }}</option>
                                @endforeach
                            </select>
                        </x-admin::forms.group>
                        @error('shop_currency_id')
                        <span class="mt-2 text-danger">{{ $errors->first('shop_currency_id') }}</span>
                        @enderror
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
                    {{ __('pages/settings.settings.social_links') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.settings.social_links_summary') }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="shop_whatsapp_link" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.whatsapp')"
                                              :error="$errors->first('shop_whatsapp_link')"
                                              :helpText="__('https://wa.me/91XXXXXXXXXX?text=I\'m%20interested%20in%20your%20car%20for%20sale')">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bxl-whatsapp"></i>
                                </span>
                                <x-admin::forms.input type='text' wire:model.defer='shop_whatsapp_link'
                                                      id='shop_whatsapp_link' autocomplete='off'
                                                      placeholder="('https://wa.me/91XXXXXXXXXX?text=I\\'m%20interested%20in%20your%20car%20for%20sale')"
                                                      class="{{($errors->first('shop_whatsapp_link') ?  'is-invalid' : '')}}"/>
                            </div>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="shop_facebook_link" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.facebook')"
                                              :error="$errors->first('shop_facebook_link')">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bxl-facebook-circle"></i>
                                </span>
                                <x-admin::forms.input type='text' wire:model.defer='shop_facebook_link'
                                                      id='shop_facebook_link' autocomplete='off'
                                                      placeholder="https://facebook.com/"
                                                      class="{{($errors->first('shop_facebook_link') ?  'is-invalid' : '')}}"/>
                            </div>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="shop_instagram_link" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.instagram')"
                                              :error="$errors->first('shop_instagram_link')">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bxl-instagram"></i>
                                </span>
                                <x-admin::forms.input type='text' wire:model.defer='shop_instagram_link'
                                                      id='shop_instagram_link' autocomplete='off'
                                                      placeholder="https://instagram.com/"
                                                      class="{{($errors->first('shop_instagram_link') ?  'is-invalid' : '')}}"/>
                            </div>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="shop_twitter_link" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.twitter')"
                                              :error="$errors->first('shop_twitter_link')">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bxl-twitter"></i>
                                </span>
                                <x-admin::forms.input type='text' wire:model.defer='shop_twitter_link'
                                                      id='shop_twitter_link' autocomplete='off'
                                                      placeholder="https://twitter.com/"
                                                      class="{{($errors->first('shop_twitter_link') ?  'is-invalid' : '')}}"/>
                            </div>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="shop_youtube_link" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.youtube')"
                                              :error="$errors->first('shop_youtube_link')">
                            <div class="input-group input-group-merge">
                                <span class="input-group-text">
                                    <i class="bx bxl-youtube"></i>
                                </span>
                                <x-admin::forms.input type='text' wire:model.defer='shop_youtube_link'
                                                      id='shop_youtube_link' autocomplete='off'
                                                      placeholder="https://youtube.com/"
                                                      class="{{($errors->first('shop_youtube_link') ?  'is-invalid' : '')}}"/>
                            </div>
                        </x-admin::forms.group>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="pt-5 pb-10 mt-6 border-t border-secondary-200 dark:border-secondary-700">
        <div class="text-right">
            <x-admin::buttons.primary wire:click="store" type="button" wire:loading.attr="disabled"
                                      style="display: inline-flex; align-items: center;">
                <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
                {{ __('pages/settings.settings.update_information') }}
            </x-admin::buttons.primary>
        </div>
    </div>

</div>
