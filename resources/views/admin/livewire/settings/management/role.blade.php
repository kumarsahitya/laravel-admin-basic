<div
    x-data="{
        options: ['role', 'users', 'permissions'],
        words: {
            'role': '{{ __('layout.forms.label.role') }}',
            'users': '{{ __('words.users') }}',
            'permissions': '{{ __('pages/settings.roles_permissions.permissions') }}'
        },
        currentTab: 'role'
    }"
>
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"/>
        <x-admin::breadcrumb.link :link="route('admin.settings.users')"
                                  :title="__('pages/settings.roles_permissions.users_role')"/>
        <x-admin::breadcrumb.view :title="__($display_name)" class="active"/>
    </x-admin::breadcrumb>

    <div class="mt-3 text-right">
        @if($role->can_be_removed)
            <span class="shadow-sm rounded-md">
                <x-admin::buttons.danger
                    wire:click="$emit('openModal', 'admin.modals.delete-role', {{ json_encode(['id' => $role->id]) }})"
                    type="button">
                    <x-heroicon-o-trash class="w-5 h-5 -ml-1 mr-2"/>
                    {{ __('layout.forms.actions.delete') }}
                </x-admin::buttons.danger>
            </span>
        @endif
        <span class="shadow-sm rounded-md">
            <x-admin::buttons.primary
                wire:click="$emit('openModal', 'admin.modals.create-permission', {{ json_encode(['id' => $role->id]) }})"
                type="button">
                <x-heroicon-o-key class="w-5 h-5 -ml-1 mr-2"/>
                {{ __('pages/settings.roles_permissions.create_permission') }}
            </x-admin::buttons.primary>
        </span>
    </div>

    <div class="row">
        <div class="col-md-12">
            <ul class="nav nav-pills flex-column flex-md-row mb-3">
                <li class="nav-item">
                    <button @click="currentTab = 'role'" type="button" class="nav-link" aria-current="page"
                            :class="{ 'active': currentTab === 'role' }">
                        {{ __('layout.forms.label.role') }}
                    </button>
                </li>
                <li class="nav-item">
                    <button @click="currentTab = 'users'" type="button" class="nav-link"
                            :class="{ 'active': currentTab === 'users' }">
                        {{ __('words.users') }}
                    </button>
                </li>
                <li class="nav-item">
                    <button @click="currentTab = 'permissions'" type="button" class="nav-link"
                            :class="{ 'active': currentTab === 'permissions' }">
                        {{ __('pages/settings.roles_permissions.permissions') }}
                    </button>
                </li>
            </ul>
            <div class="card" x-show="currentTab === 'role'">
                <h5 class="card-header">{{ $display_name }}</h5>
                <div class="card-body">
                    @if(config('system.users.admin_role') === $role->name)
                        <div class="alert alert-info d-flex border-light-info align-items-center p-4" role="alert">
                            <i class="bx bxs-info-circle"></i>
                            <div class="ms-sm-2">
                                {{ __('pages/settings.roles_permissions.role_alert_msg') }}
                                <a href="#" target="_blank" class="alert-link">
                                    <u>
                                        {{ __('components.learn_more') }} &rarr;
                                    </u>
                                </a>
                            </div>
                        </div>
                    @endif
                    <div class="row">

                        <x-admin::forms.group for="name" class="mb-3 col-md-6" :label="__('layout.forms.label.name')"
                                              :error="$errors->first('name')" isRequired>
                            <x-admin::forms.input wire:model.lazy='name' id='name' type='text'
                                                  placeholder="manager"
                                                  class="{{($errors->first('name') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="display_name" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.display_name')"
                                              :error="$errors->first('display_name')">
                            <x-admin::forms.input wire:model.lazy='display_name' id='display_name' type='text'
                                                  placeholder="Manager"
                                                  class="{{($errors->first('display_name') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="description" class="mb-3 col-md-12"
                                              :label="__('layout.forms.label.description')"
                                              :error="$errors->first('description')">
                            <x-admin::forms.textarea wire:model.lazy='description' id='description'
                                                     class="{{($errors->first('description') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>
                        <div class="mt-2 text-right">
                            <x-admin::buttons.primary wire:click="save" wire:loading.attr="disabled" type="button"
                                                      style="display: inline-flex; align-items: center;">
                                <x-admin::loader wire:loading wire:target="save" class="text-white me-2"/>
                                {{ __('layout.forms.actions.update') }}
                            </x-admin::buttons.primary>
                        </div>
                    </div>
                </div>
            </div>
            <div x-cloak x-show="currentTab === 'users'" class="card">
                <livewire:admin.settings.management.users-role :role="$role"/>
            </div>
            <div x-cloak x-show="currentTab === 'permissions'" class="card">
                <livewire:admin.settings.management.permissions :role="$role"/>
            </div>

        </div>
    </div>
</div>
