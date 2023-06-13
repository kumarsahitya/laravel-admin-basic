<div>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"
                                  class="text-muted"/>
        <x-admin::breadcrumb.view :title="__('words.locations')" class="active"/>
    </x-admin::breadcrumb>

    @can('add_inventories')
        <div class="text-right space-x-3">
            <span class="shadow-sm rounded-md">
                <x-admin::buttons.primary :link="route('admin.settings.inventories.create')">
                    {{ __('words.actions_label.add_new', ['name' => strtolower(__('words.location'))]) }}
                </x-admin::buttons.primary>
            </span>
        </div>
    @endcan

    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('words.locations') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.location.description') }}
                </h6>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.location.count', ['count' => $inventories->count()]) }}
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <ul class="divide-y divide-secondary-200 dark:divide-secondary-700">
                            @foreach($inventories as $inventory)
                                <li>
                                    <a href="{{ route('admin.settings.inventories.edit', $inventory) }}"
                                       class="block hover:bg-secondary-50 focus:outline-none dark:hover:bg-secondary-700">
                                        <div class="p-4 sm:p-6">
                                            <div class="flex items-center">
                                                <div class="shrink-0 hidden lg:block">
                                                <span
                                                    class="flex items-center justify-center h-12 w-12 bg-secondary-100 text-secondary-400 rounded-md dark:bg-secondary-700 dark:text-secondary-500">
                                                    <x-heroicon-o-location-marker class="w-6 h-6"/>
                                                </span>
                                                </div>
                                                <div class="flex-1 lg:ml-4">
                                                    <div class="flex items-center justify-between">
                                                        <div
                                                            class="text-sm leading-5 font-medium text-primary-600 truncate dark:text-primary-500/50">
                                                            {{ $inventory->name }}
                                                        </div>
                                                        @if($inventory->is_default)
                                                            <div class="ml-2 shrink-0 flex">
                                                            <span
                                                                class="px-2 inline-flex text-xs leading-5 font-medium rounded-full bg-secondary-100 text-secondary-800 border-2 border-white dark:bg-secondary-700 dark:text-secondary-300 dark:border-secondary-800">
                                                                {{ __('words.default') }}
                                                            </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <div class="mt-2 sm:flex sm:justify-between">
                                                        <div class="sm:flex sm:space-x-4">
                                                            <div
                                                                class="flex items-center text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                                                <x-heroicon-s-flag
                                                                    class="shrink-0 mr-1.5 h-5 w-5 text-secondary-400 "/>
                                                                {{ $inventory->country->name }}
                                                            </div>
                                                            <div
                                                                class="mt-2 flex items-center text-sm leading-5 text-secondary-500 sm:mt-0 dark:text-secondary-400">
                                                                <x-heroicon-s-location-marker
                                                                    class="shrink-0 mr-1.5 h-5 w-5 text-secondary-400 dark:text-secondary-500"/>
                                                                {{ $inventory->city }}
                                                            </div>
                                                            <div
                                                                class="mt-2 flex items-center text-sm leading-5 text-secondary-500 sm:mt-0">
                                                                <x-heroicon-s-phone
                                                                    class="shrink-0 mr-1.5 h-5 w-5 text-secondary-400 dark:text-secondary-500"/>
                                                                {{ $inventory->phone_number ?? __('words.number_not_set') }}
                                                            </div>
                                                        </div>
                                                        <div
                                                            class="mt-2 flex items-center text-sm leading-5 text-secondary-500 sm:mt-0 dark:text-secondary-400">
                                                            <x-heroicon-s-calendar
                                                                class="shrink-0 mr-1.5 h-5 w-5 text-secondary-400 dark:text-secondary-500"/>
                                                            <span>
                                                            {{ __('words.added_on') }}
                                                            <time
                                                                datetime="{{ $inventory->created_at->format('d-m-Y') }}">
                                                                {{ $inventory->created_at->formatLocalized('%d %B %G') }}
                                                            </time>
                                                        </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
