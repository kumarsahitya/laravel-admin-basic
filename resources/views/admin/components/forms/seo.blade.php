@props(['slug', 'title', 'description', 'url', 'canUpdate', 'keyword'])

<div class="card shadow-md mb-4">
    <div class="card-header d-flex align-items-center justify-content-between pb-0">
        <div class="card-title mb-0">
            <h5 class="m-0 me-2">{{ __('components.seo.title') }}</h5>
        </div>
        <div class="dropdown">
            @if(! $canUpdate)
                <button wire:click="updateSeo" type="button"
                        class="inline-flex items-center mt-2 lg:mt-0 text-sm leading-5 bg-transparent outline-none focus:outline-none text-primary-600 hover:text-primary-700 dark:text-primary-500/50">
                    {{ __('components.seo.edit_action') }}
                </button>
            @endif
        </div>
    </div>
    <div class="card-body pt-4">
        @if(! $canUpdate)
            <p class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                {{ __('components.seo.description') }}
            </p>
        @else
            <div class="flex flex-col">
                <h3 class="text-base text-primary-800 font-medium leading-6 dark:text-primary-500/50">
                    {{ $title }}
                </h3>
                <div class="my-1 items-center">
                    <span
                        class="mr-2 inline-flex items-center py-1 px-2 bg-secondary-100 dark:bg-secondary-700 text-sm rounded-full leading-5 text-secondary-500 dark:text-secondary-400">
                        {{ __('Recommended link') }}
                    </span>
                    <span class="text-green-600 text-sm leading-5 dark:text-green-500/50">
                        {{ config('app.url') }}/{{ $slug }}/{{ $url }}</span>
                </div>
                <h5 class="mt-2 mb-1 text-muted font-medium leading-6 dark:text-primary-500/50">
                    {{ $keyword }}
                </h5>
                <p class="mt-1 text-secondary-500 text-sm leading-5 dark:text-secondary-400">
                    {{ str_limit($description, 160) }}
                </p>
            </div>
            <div class="row">
                <x-admin::forms.group for="seo_title" :label="__('layout.forms.label.title')"
                                      class="mb-3 col-md-12">
                    <x-admin::forms.input wire:model.debounce.500ms="seoTitle" id="seo_title" type="text"
                                          autocomplete="off" placeholder="{{  __('layout.forms.label.title') }}"
                                          class="form-control"/>
                </x-admin::forms.group>

                <x-admin::forms.group for="seo_keyword" :label="__('layout.forms.label.keyword')"
                                      class="mb-3 col-md-12">
                    <x-admin::forms.input wire:model.debounce.500ms="seoKeyword" id="seo_keyword" type="text"
                                          autocomplete="off" placeholder="{{ __('layout.forms.label.keyword')}} "
                                          class="form-control"/>
                </x-admin::forms.group>
                <div>
                    <div class="flex items-center justify-between">
                        <x-admin::label for="seo_description" :value="__('layout.forms.label.description')"/>
                        <span
                            class="ml-4 text-sm leading-5 text-secondary-500 dark:text-secondary-400">{{ __('components.seo.characters') }}</span>
                    </div>
                    <div class="mt-1 rounded-md shadow-sm">
                        <x-admin::forms.textarea wire:model.debounce.500ms="seoDescription" id="seo_description"/>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
