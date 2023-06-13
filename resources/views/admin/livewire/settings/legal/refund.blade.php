<div>
    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('pages/settings.legal.refund') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.legal.summary', ['policy' => __('pages/settings.legal.refund')]) }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <div class="flex items-center justify-between">
                                <p class="grow flex flex-col" id="toggleLabel">
                                    <span class="text-sm leading-5 font-medium text-secondary-900 dark:text-white">
                                        {{ __('layout.forms.actions.enabled') }}
                                    </span>
                                    <span class="text-sm leading-normal text-secondary-500 dark:text-secondary-400">
                                        {{ __('words.set_global_visibility') }}
                                    </span>
                                </p>
                                <span role="checkbox" tabindex="0" @click="on = !on" @keydown.space.prevent="on = !on"
                                      :aria-checked="on.toString()" aria-checked="false" aria-labelledby="toggleLabel"
                                      x-data="{ on: @entangle('isEnabled') }"
                                      x-bind:class="{ 'bg-secondary-200 dark:bg-secondary-700': !on, 'bg-primary-600': on }"
                                      class="bg-secondary-200 relative inline-flex shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:shadow-outline-primary">
                                    <span aria-hidden="true"
                                          x-bind:class="{ 'translate-x-5': on, 'translate-x-0': !on }"
                                          class="translate-x-0 inline-block h-5 w-5 rounded-full bg-white shadow transform transition ease-in-out duration-200"></span>
                                </span>
                            </div>
                        </div>
                        <x-admin::forms.group :label="__('layout.forms.label.content')" for="content"
                                              class="mb-3 col-md-12">
                            <livewire:forms.trix :value="$content"/>
                        </x-admin::forms.group>
                    </div>
                    <div class="mt-2 text-right">
                        <x-admin::buttons.primary type="button" wire:click="store" wire:loading.attr="disabled"
                                                  style="display: inline-flex; align-items: center;">
                            <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
                            {{ __('layout.forms.actions.save') }}
                        </x-admin::buttons.primary>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
