<div>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"/>
        <x-admin::breadcrumb.view :title="__('pages/settings.roles_permissions.header_title')" class="active"/>
    </x-admin::breadcrumb>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-md">
                <div class="card-header d-flex align-items-center justify-content-between pb-0">
                    <div class="row">
                        <div class="card-title col-md-9">
                            <h5 class="m-0 me-2">{{ __('pages/settings.roles_permissions.role_available') }}</h5>
                            <p class="mt-3 text-base leading-6 text-secondary-500">
                                {{ __('pages/settings.roles_permissions.role_available_summary') }}
                            </p>
                        </div>
                        <div class="col-md-3 text-right">
                            <button
                                class="btn btn-primary"
                                type="button" wire:click="$emit('openModal', 'admin.modals.create-role')"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="bx bx-plus"></i>
                                {{ __('pages/settings.roles_permissions.new_role') }}
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body pt-4">
                    <div class="row">
                        @foreach($roles as $role)
                            <a href="{{ route('admin.settings.user.role', $role) }}"
                               class="col-lg-4 col-md-6 mb-4">
                                <div class="p-4 border border-secondary-200 rounded-md overflow-hidden hover:shadow-md">
                                    <div class="flex items-center justify-between">
                                        <span
                                            class="text-xs leading-4 text-secondary-400 dark:text-secondary-500 font-semibold uppercase tracking-wider">
                                            {{ $role->users->count() }} {{ str_plural(__('words.account'), $role->users->count()) }}
                                        </span>
                                        <div class="flex overflow-hidden ml-4">
                                            @foreach($role->users as $admin)
                                                <img
                                                    class="{{ $loop->first ? '' : '-ml-1' }} inline-block h-6 w-6 rounded-full shadow-solid"
                                                    src="{{ $admin->picture }}" alt="">
                                            @endforeach
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="mt-4 text-lg leading-6 font-medium text-secondary-900">
                                            {{ $role->display_name }}
                                        </h3>
                                        <p class="mt-1 text-sm text-primary-600">
                                            {{ __('words.view_details') }}
                                            <i class='bx bxs-right-arrow-alt'></i>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-10">
        <div class="row">
            <div class="col-md-12">
                <div class="card shadow-md">
                    <div class="card-header d-flex align-items-center justify-content-between pb-0">
                        <div class="row" style="width: 110% !important;">
                            <div class="card-title col-md-9">
                                <h5 class="m-0 me-2">{{ __('pages/settings.roles_permissions.admin_accounts') }}</h5>
                                <p class="mt-3 text-base leading-6 text-secondary-500">
                                    {{ __('pages/settings.roles_permissions.admin_accounts_summary') }}
                                </p>
                            </div>
                            <div class="col-md-3 text-right">
                                <x-admin::buttons.primary :link="route('admin.settings.user.new')">
                                    <i class='bx bx-user-plus'></i>
                                    {{ __('pages/settings.roles_permissions.add_admin') }}
                                </x-admin::buttons.primary>
                            </div>
                        </div>
                    </div>
                    <div class="card-body mt-4 border-t border-secondary-200">
                        <div class="mt-4 border border-secondary-200 rounded-md dark:border-secondary-700">
                            <div class="overflow-x-auto">
                                <div class="align-middle inline-block min-w-full">
                                    <table class="min-w-full">
                                        <thead>
                                        <tr class="border-b border-secondary-200 bg-secondary-50 dark:border-secondary-700 dark:bg-secondary-700">
                                            <x-admin::tables.table-head>
                                                <span class="lg:pl-2">{{ __('layout.forms.label.name') }}</span>
                                            </x-admin::tables.table-head>
                                            <x-admin::tables.table-head>
                                                {{ __('layout.forms.label.email') }}
                                            </x-admin::tables.table-head>
                                            <x-admin::tables.table-head class="hidden md:table-cell text-right">
                                                {{ __('layout.forms.label.role') }}
                                            </x-admin::tables.table-head>
                                            <x-admin::tables.table-head class="hidden md:table-cell text-right">
                                                {{ __('layout.forms.label.access') }}
                                            </x-admin::tables.table-head>
                                            <x-admin::tables.table-head class="pr-6"/>
                                        </tr>
                                        </thead>
                                        <tbody
                                            class="divide-y divide-secondary-100 bg-white dark:bg-secondary-800 dark:divide-secondary-700"
                                            x-max="1">
                                        @foreach($users as $user)
                                            <tr>
                                                <td class="px-6 py-3 whitespace-no-wrap text-sm leading-5 font-medium text-secondary-900 dark:text-white">
                                                    <div class="flex items-center">
                                                        <div class="shrink-0 h-10 w-10">
                                                            <img class="h-10 w-10 rounded-full"
                                                                 src="{{ $user->picture }}"
                                                                 alt="User avatar">
                                                        </div>
                                                        <div class="ml-4">
                                                            <div class="text-sm leading-5 font-medium">
                                                                {{ $user->full_name }}
                                                            </div>
                                                            <div
                                                                class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                                                {{ __('words.registered_on') }}
                                                                <time
                                                                    datetime="{{ $user->created_at->format('Y-m-d') }}"
                                                                    class="capitalize">
                                                                    {{ $user->created_at->formatLocalized('%d %B %Y') }}
                                                                </time>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td class="px-6 py-3 text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                                    <div class="flex items-center">
                                                        @if($user->email_verified_at)
                                                            <i class='bx bxs-check-shield text-green-500'></i>
                                                        @else
                                                            <i class='bx bxs-shield-x text-red-500'></i>
                                                        @endif
                                                        <span class="ml-1.5">{{ $user->email }}</span>
                                                    </div>
                                                </td>
                                                <td class="hidden md:table-cell px-6 py-3 whitespace-no-wrap text-sm leading-5 text-right">
                                                    <span
                                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-secondary-100 text-secondary-800 dark:bg-secondary-700 dark:text-secondary-400">
                                                        {{ $user->roles_label }}
                                                    </span>
                                                </td>
                                                <td class="hidden md:table-cell px-6 py-3 whitespace-no-wrap text-sm leading-5 text-secondary-500 dark:text-secondary-400 text-right">
                                                    {{ $user->hasRole(config('system.users.admin_role')) ? __('words.full') : __('words.limited') }}
                                                </td>
                                                <td class="pr-6 text-right">
                                                    @if($user->id === auth()->id())
                                                        <span
                                                            class="flex items-center text-sm leading-5 text-secondary-500 text-right dark:text-secondary-400">
                                                            <i class='bx bx-user-circle mr-1'></i>
                                                            {{ __('words.me') }}
                                                        </span>
                                                    @endif
                                                    @if(auth()->user()->isAdmin() && ! $user->isAdmin())
                                                        <x-admin::dropdown customAlignmentClasses="right-12 -bottom-1">
                                                            <x-slot name="trigger">
                                                                <button id="admin-options-menu" aria-has-popup="true"
                                                                        :aria-expanded="open" type="button"
                                                                        class="w-8 h-8 inline-flex items-center justify-center text-secondary-400 rounded-full bg-transparent hover:text-secondary-500 focus:outline-none focus:text-secondary-500 focus:bg-secondary-100 dark:focus:bg-secondary-700 transition ease-in-out duration-150">
                                                                    <i class='bx bx-dots-vertical-rounded'></i>
                                                                </button>
                                                            </x-slot>

                                                            <x-slot name="content">
                                                                <div class="py-1">
                                                                    <button wire:click="removeUser({{ $user->id }})"
                                                                            type="button"
                                                                            class="group flex w-full items-center px-4 py-2 text-sm leading-5 text-secondary-700 hover:bg-secondary-100 hover:text-secondary-900"
                                                                            role="menuitem">
                                                                        <i class='bx bx-trash text-secondary-700 mr-3'></i>
                                                                        {{ __('layout.forms.actions.delete') }}
                                                                    </button>
                                                                </div>
                                                            </x-slot>
                                                        </x-admin::dropdown>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="flex items-center justify-between px-4 py-3 sm:px-6 border-t border-secondary-200 rounded-b-md bg-white">
                                    <div class="flex-1 flex justify-between sm:hidden">
                                        {{ $users->links('admin.livewire.wire-mobile-pagination-links') }}
                                    </div>
                                    <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-between">
                                        <div>
                                            <p class="text-sm leading-5 text-secondary-700">
                                                {{ __('words.showing') }}
                                                <span
                                                    class="font-medium">{{ ($users->currentPage() - 1) * $users->perPage() + 1 }}</span>
                                                {{ __('words.to') }}
                                                <span
                                                    class="font-medium">{{ ($users->currentPage() - 1) * $users->perPage() + count($users->items()) }}</span>
                                                {{ __('words.of') }}
                                                <span class="font-medium"> {!! $users->total() !!}</span>
                                                {{ __('words.results') }}
                                            </p>
                                        </div>
                                        {{ $users->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
