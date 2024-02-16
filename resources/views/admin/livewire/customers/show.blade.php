<div x-data="{
    open: false,
    options: ['profile', 'address', 'orders'],
    words: {
        'profile': '{{ __('pages/customers.profile.title') }}',
        'address': '{{ __('pages/customers.addresses.title') }}',
        'orders': '{{ __('layout.sidebar.orders') }}'
    },
    currentTab: 'profile'
}">
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.customers.index')"
                                  :title="__('layout.sidebar.customers')"
                                  class="text-muted" />
    </x-admin::breadcrumb>

    <div class="mt-5 md:flex md:items-center md:justify-between relative z-20">
        <div class="flex-1 min-w-0">
            <div class="flex items-start">
                <div class="shrink-0 h-12 w-12">
                    <img class="h-12 w-12 rounded-lg"
                         src="{{ $picture }}"
                         alt="">
                </div>
                <div class="ml-4">
                    <h3 class="mb-0 text-2xl font-bold leading-6 text-secondary-900 sm:truncate dark:text-white">
                        {{ $customer->full_name }}
                    </h3>
                    <div class="mt-1 flex items-center divide-x divide-secondary-200 dark:divide-secondary-700">
                        <div class="flex items-center pr-2">
                            @if ($customer->email_verified_at)
                                <i class='bx bxs-check-shield text-green-500'></i>
                            @else
                                <i class='bx bxs-shield-x text-red-500'></i>
                            @endif
                            <span class="ml-1.5 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                {{ $customer->email }}
                            </span>
                        </div>
                        <p class="mb-0 pl-2 text-sm text-secondary-500 leading-5 dark:text-secondary-400">
                            {{ __('pages/customers.period', ['period' => $customer->created_at->diffForHumans()]) }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden md:flex mt-4 flex md:mt-0 md:ml-4 space-x-2">
            <div @keydown.escape="open = false"
                 @click.away="open = false"
                 class="relative inline-block text-left">
                <div>
                    <button @click="open = !open"
                            class="flex items-center text-secondary-400 hover:text-secondary-500 focus:outline-none focus:text-secondary-500"
                            aria-label="Options"
                            id="options-menu"
                            aria-haspopup="true"
                            x-bind:aria-expanded="open">
                        <i class='bx bx-dots-horizontal-rounded bx-sm'></i>
                    </button>
                </div>

                <div x-cloak
                     x-show="open"
                     x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg">
                    <div class="rounded-md bg-white shadow-xs dark:bg-secondary-800">
                        <div class="py-1"
                             role="menu"
                             aria-orientation="vertical"
                             aria-labelledby="options-menu">
                            <button wire:click="$emit('openModal', 'admin.modals.delete-customer', {{ json_encode([$customer->id]) }})"
                                    type="button"
                                    class="block w-full px-4 py-2 text-sm leading-5 text-left text-secondary-700 hover:bg-secondary-100 hover:text-secondary-900 focus:outline-none dark:text-secondary-300 dark:hover:text-white dark:hover:bg-secondary-700"
                                    role="menuitem">
                                {{ __('layout.forms.actions.delete') }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-12">
            <div class="sm:hidden">
                <x-admin::forms.select x-model="currentTab"
                                       aria-label="{{ __('words.selected_tab') }}"
                                       class="block w-full py-2 pl-3 pr-10">
                    <template x-for="option in options"
                              :key="option">
                        <option x-bind:value="option"
                                x-text="words[option]"
                                x-bind:selected="option === currentTab"></option>
                    </template>
                </x-admin::forms.select>
            </div>

            <div class="hidden sm:block">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <button @click="currentTab = 'profile'"
                                type="button"
                                class="nav-link"
                                aria-current="page"
                                :class="{ 'active': currentTab === 'profile' }">
                            {{ __('pages/customers.profile.title') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button @click="currentTab = 'address'"
                                type="button"
                                class="nav-link"
                                :class="{ 'active': currentTab === 'address' }">
                            {{ __('pages/customers.addresses.title') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button @click="currentTab = 'orders'"
                                type="button"
                                class="nav-link"
                                :class="{ 'active': currentTab === 'orders' }">
                            {{ __('layout.sidebar.orders') }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="pb-10 mt-6">
        <div x-show="currentTab === 'profile'">
            <livewire:admin.customers.profile :customer="$customer" />
        </div>
        <div x-cloak
             x-show="currentTab === 'address'">
            <livewire:admin.customers.addresses :adresses="$customer->addresses" />
        </div>
        <div x-cloak
             x-show="currentTab === 'orders'">
            <livewire:admin.customers.orders :customer="$customer" />
        </div>
    </div>
</div>
