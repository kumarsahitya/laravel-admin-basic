<div>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.attributes.index')" :title="__('words.attributes')" class="text-muted"/>
        <x-admin::breadcrumb.view
            :title="__('words.actions_label.add_new', ['name' => strtolower(__('words.attribute'))])" class="active"/>
    </x-admin::breadcrumb>

    <div class="text-right space-x-3">
        <x-admin::buttons.primary wire:click="store" wire.loading.attr="disabled" type="button"
                                  style="display: inline-flex; align-items: center;">
            <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
            {{ __('layout.forms.actions.save') }}
        </x-admin::buttons.primary>
    </div>
    <div class="mt-6">
        <div class="row">
            <div class="col-md-8 mb-4">
                <div class="card shadow-md">
                    <div class="card-body">
                        <div class="row">
                            <x-admin::forms.group :label="__('layout.forms.label.name')" for="name"
                                                  class="mb-3 col-md-6"
                                                  :error="$errors->first('name')" isRequired>
                                <x-admin::forms.input wire:model="name" id="name" type="text" autocomplete="off"
                                                      class="form-control {{($errors->first('name') ?  'is-invalid' : '')}}"/>
                            </x-admin::forms.group>
                            <x-admin::forms.group for="type" :label="__('layout.forms.label.type')"
                                                  class="mb-3 col-md-6">
                                <x-admin::forms.select wire:model="type" id="type">
                                    @foreach($fields as $key => $field)
                                        <option value="{{ $key }}">{{ $field }}</option>
                                    @endforeach
                                </x-admin::forms.select>
                            </x-admin::forms.group>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <div class="flex items-center justify-between">
                                    <x-admin::label class="form-label" :value="__('layout.forms.label.description')"
                                                    for="description"/>
                                    <span class="ml-4 text-sm text-secondary-500 leading-5 dark:text-secondary-400">
                                        {{ __('layout.forms.label.optional') }}
                                    </span>
                                </div>
                                <div class="mt-1 rounded-md shadow-sm">
                                    <x-admin::forms.textarea wire:model="description" id="description"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <x-admin::forms.checkbox wire:model="isSearchable" id="is_searchable"/>
                                    </div>
                                    <div class="ml-3 text-sm leading-5">
                                        <x-admin::label for="is_searchable"
                                                        :value="__('layout.forms.label.is_searchable')"/>
                                        <p class="text-secondary-500 dark:text-secondary-400">
                                            {{ __('pages/attributes.searchable_description') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="relative flex items-start">
                                    <div class="flex items-center h-5">
                                        <x-admin::forms.checkbox wire:model="isFilterable" id="is_filterable"/>
                                    </div>
                                    <div class="ml-3 text-sm leading-5">
                                        <x-admin::label for="is_filterable"
                                                        :value="__('layout.forms.label.is_filterable')"/>
                                        <p class="text-secondary-500 dark:text-secondary-400">
                                            {{ __('pages/attributes.filtrable_description') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <aside class="sticky top-6 space-y-5">
                    <div class="card shadow-md overflow-hidden">
                        <div class="card-body">
                            <div class="row">
                                <x-admin::forms.group :label="__('layout.forms.label.slug')" for="slug"
                                                      class="mb-3 col-md-12"
                                                      :error="$errors->first('slug')" isRequired>
                                    <x-admin::forms.input wire:model="slug" id="slug" type="text" autocomplete="off"
                                                          class="form-control {{($errors->first('slug') ?  'is-invalid' : '')}}"/>
                                </x-admin::forms.group>
                            </div>
                            <div class="row">
                                <div class="col-md-12 pt-3 border-t">
                                    <div class="relative flex items-start">
                                        <div class="flex items-center h-5">
                                                <span wire:model="isEnabled" role="checkbox" tabindex="0"
                                                      x-on:click="$dispatch('input', !on); on = !on"
                                                      @keydown.space.prevent="on = !on"
                                                      x-data="{ on: @entangle('isEnabled') }"
                                                      :aria-checked="on.toString()"
                                                      aria-checked="false"
                                                      x-bind:class="{ 'bg-secondary-200 dark:bg-secondary-700': !on, 'bg-primary-600': on }"
                                                      class="bg-secondary-200 relative inline-flex shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline-brand">
                                                    <input type="hidden" x-ref="input" aria-label="Visible"
                                                           x-model="on"/>
                                                    <span aria-hidden="true"
                                                          x-bind:class="{ 'translate-x-5': on, 'translate-x-0': !on }"
                                                          class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                                </span>
                                        </div>
                                        <div class="ml-3 text-sm leading-5">
                                            <x-admin::label for="online" class="form-label"
                                                            :value="__('layout.forms.actions.enabled')"/>
                                            <p class="text-sm text-secondary-500 dark:text-secondary-400">
                                                {{ __('pages/attributes.attribute_visibility') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
