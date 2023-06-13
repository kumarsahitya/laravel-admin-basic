<div
    x-data="{
        options: ['general', 'stripe'],
        words: {'general': '{{ __('General') }}', 'stripe': '{{ __('Stripe') }}'},
        currentTab: 'stripe'
    }"
>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"
                                  class="text-muted"/>
        <x-admin::breadcrumb.view :title="__('pages/settings.payment.title')" class="active"/>
    </x-admin::breadcrumb>

    <div class="text-right space-x-3 my-3">
        <span class="shadow-sm rounded-md">
            <x-admin::buttons.primary wire:click="$emit('openModal', 'modals.create-payment-method')"
                                      type="button">
                {{ __('pages/settings.payment.create_payment') }}
            </x-admin::buttons.primary>
        </span>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <button @click="currentTab = 'general'" type="button" class="nav-link" aria-current="page"
                            :class="{ 'active': currentTab === 'general' }">
                        {{ __('General') }}
                    </button>
                </li>
                <li class="nav-item">
                    <button @click="currentTab = 'stripe'" type="button" class="nav-link"
                            :class="{ 'active': currentTab === 'stripe' }">
                        {{ __('Stripe') }}
                    </button>
                </li>
            </ul>
            <div class="card" x-show="currentTab === 'general'">
                <div class="p-4 sm:p-6 sm:pb-4">
                    <x-admin::forms.search label="Search payments"
                                           :placeholder="__('layout.forms.placeholder.search_payment')"/>
                </div>
                <div class="hidden sm:block">
                    <div class="align-middle inline-block min-w-full">
                        <table class="min-w-full">
                            <thead>
                            <tr class="border-t border-secondary-200 bg-secondary-50 dark:border-secondary-700 dark:bg-secondary-700">
                                <x-admin::tables.table-head>
                                    <span class="lg:pl-2">{{ __('layout.forms.label.title') }}</span>
                                </x-admin::tables.table-head>
                                <x-admin::tables.table-head>
                                    {{ __('layout.forms.label.status') }}
                                </x-admin::tables.table-head>
                                <x-admin::tables.table-head>
                                    {{ __('layout.forms.label.website') }}
                                </x-admin::tables.table-head>
                                <x-admin::tables.table-head class="hidden md:table-cell text-right">
                                    {{ __('layout.forms.label.updated_at') }}
                                </x-admin::tables.table-head>
                                <x-admin::tables.table-head class="pr-6 text-right"/>
                            </tr>
                            </thead>
                            <tbody class="divide-y divide-secondary-100 dark:divide-secondary-700" x-max="1">
                            @forelse($methods as $method)
                                <tr>
                                    <td class="px-6 py-3 whitespace-no-wrap text-sm leading-5 font-medium text-secondary-900 dark:text-white">
                                        <div class="flex items-center space-x-3 lg:pl-2">
                                            <div
                                                class="shrink-0 w-2.5 h-2.5 rounded-full {{ $method->is_enabled ? 'bg-green-600': 'bg-secondary-400' }}"></div>
                                            <div class="flex items-center">
                                                @if($method->logo_url)
                                                    <img class="h-8 w-8 rounded object-cover object-center"
                                                         src="{{ $method->logo_url }}" alt="">
                                                @else
                                                    <div
                                                        class="flex items-center justify-center h-8 w-8 bg-secondary-200 rounded dark:bg-secondary-700">
                                                        <i class='bx bx-image text-secondary-400 dark:text-secondary-500'></i>
                                                    </div>
                                                @endif
                                                <span class="ml-2 truncate">
                                                        <span>{{ $method->title }} </span>
                                                    </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                        <div class="flex items-center">
                                            <span x-data="{ on: @if($method->is_enabled) true @else false @endif }"
                                                  role="checkbox" tabindex="0"
                                                  wire:click="toggleStatus({{ $method->id }}, {{ $method->is_enabled ? 1 : 0 }})"
                                                  x-on:toggle-saved-{{ $method->id }}.window="on = !on"
                                                  @keydown.space.prevent="on = !on" :aria-checked="on.toString()"
                                                  aria-checked="false" @focus="focused = true"
                                                  @blur="focused = false"
                                                  class="group relative inline-flex items-center justify-center shrink-0 h-5 w-10 cursor-pointer focus:outline-none">
                                                <span aria-hidden="true"
                                                      :class="{ 'bg-primary-600': on, 'bg-secondary-200 dark:bg-secondary-700': !on }"
                                                      class="absolute h-4 w-9 mx-auto rounded-full transition-colors ease-in-out duration-200 bg-secondary-200"></span>
                                                <span aria-hidden="true"
                                                      :class="{ 'translate-x-5': on, 'translate-x-0': !on }"
                                                      class="absolute left-0 inline-block h-5 w-5 border border-secondary-200 rounded-full bg-white shadow transform group-focus:shadow-outline group-focus:border-primary-300 transition-transform ease-in-out duration-200 translate-x-0"></span>
                                            </span>
                                        </div>
                                    </td>
                                    <td class="hidden md:table-cell px-6 py-3 whitespace-no-wrap text-sm leading-5">
                                        @if($method->link_url)
                                            <a href="{!! starts_with($method->link_url, ['http://', 'https://']) ? $method->link_url : "https://{$method->link_url}" !!}"
                                               target="_blank"
                                               class="inline-flex items-center text-secondary-500 dark:text-secondary-400 hover:text-secondary-400 dark:hover:text-secondary-300 font-medium text-sm leading-5">
                                                {{ $method->link_url }}
                                                <svg class="w-5 h-5 -mr-1 ml-2" fill="none" stroke="currentColor"
                                                     viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          stroke-width="2"
                                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                                </svg>
                                            </a>
                                        @else
                                            <span
                                                class="inline-flex h-0.5 rounded w-6 bg-secondary-700 dark:bg-secondary-500"></span>
                                        @endif
                                    </td>
                                    <td class="hidden md:table-cell px-6 py-3 whitespace-no-wrap text-sm leading-5 text-secondary-500 text-right dark:text-secondary-400">
                                        <time datetime="{{ $method->created_at->format('Y-m-d') }}"
                                              class="capitalize">{{ $method->created_at->formatLocalized('%d %B, %Y') }}</time>
                                    </td>
                                    <td class="pr-6">
                                        <x-admin::dropdown customAlignmentClasses="right-12 -bottom-1">
                                            <x-slot name="trigger">
                                                <button id="payment-options-menu-{{ $method->id }}"
                                                        aria-has-popup="true" :aria-expanded="open" type="button"
                                                        class="w-8 h-8 inline-flex items-center justify-center text-secondary-400 rounded-full bg-transparent hover:text-secondary-500 focus:outline-none focus:text-secondary-500 focus:bg-secondary-100 dark:focus:bg-secondary-700 transition ease-in-out duration-150">
                                                    <i class='bx bx-dots-vertical-rounded'></i>
                                                </button>
                                            </x-slot>

                                            <x-slot name="content">
                                                <div class="py-1">
                                                    <button
                                                        wire:click="$emit('openModal', 'modals.update-payment-method', {{ json_encode([$method->id]) }})"
                                                        wire:key="{{ $method->id }}" type="button"
                                                        class="group flex w-full items-center px-4 py-2 text-sm leading-5 text-secondary-700 dark:text-secondary-400 hover:bg-secondary-100 dark:hover:bg-secondary-600 hover:text-secondary-900 dark:hover:text-white"
                                                        role="menuitem">
                                                        <i class='bx bx-pencil me-1 text-secondary-400 group-hover:text-secondary-500'></i>
                                                        {{ __('layout.forms.actions.edit') }}
                                                    </button>
                                                </div>
                                                <div
                                                    class="border-t border-secondary-100 dark:border-secondary-600"></div>
                                                <div class="py-1">
                                                    <button wire:click="removePayment({{ $method->id }})"
                                                            type="button"
                                                            class="group flex w-full items-center px-4 py-2 text-sm leading-5 text-secondary-700 dark:text-secondary-400 hover:bg-secondary-100 dark:hover:bg-secondary-600 hover:text-secondary-900 dark:hover:text-white"
                                                            role="menuitem">
                                                        <i class='bx bx-trash me-1 text-secondary-400 group-hover:text-secondary-500'></i>
                                                        {{ __('layout.forms.actions.delete') }}
                                                    </button>
                                                </div>
                                            </x-slot>
                                        </x-admin::dropdown>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5"
                                        class="px-6 py-3 whitespace-no-wrap text-sm leading-5 font-medium text-secondary-900 dark:text-white">
                                        <div class="flex justify-center items-center space-x-2">
                                            <i class='bx bx-credit-card bx-md text-secondary-400'></i>
                                            <span class="font-medium py-8 text-secondary-400 text-xl">
                                                {{ __('pages/settings.payment.no_method') }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div
                    class="px-4 py-3 flex items-center rounded-b-md justify-between border-t border-secondary-200 sm:px-6 dark:border-secondary-700">
                    <div class="flex-1 flex justify-between sm:hidden">
                        {{ $methods->links('admin.livewire.wire-mobile-pagination-links') }}
                    </div>
                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                        <div>
                            <p class="text-sm leading-5 text-secondary-700 dark:text-secondary-300">
                                {{ __('words.showing') }}
                                <span
                                    class="font-medium">{{ ($methods->currentPage() - 1) * $methods->perPage() + 1 }}</span>
                                {{ __('words.to') }}
                                <span
                                    class="font-medium">{{ ($methods->currentPage() - 1) * $methods->perPage() + count($methods->items()) }}</span>
                                {{ __('words.of') }}
                                <span class="font-medium"> {!! $methods->total() !!}</span>
                                {{ __('words.results') }}
                            </p>
                        </div>
                        {{ $methods->links() }}
                    </div>
                </div>
            </div>
            <div x-cloak x-show="currentTab === 'stripe'">
                <livewire:settings.payments.stripe/>
            </div>
        </div>
    </div>

</div>
