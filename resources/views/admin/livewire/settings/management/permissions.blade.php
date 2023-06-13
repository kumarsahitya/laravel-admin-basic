<div class="card">
    <div class="card-header d-flex align-items-center">
        <h5 class="mb-0">
            {{ __('pages/settings.roles_permissions.permissions') }}
        </h5>
        <small class="ml-2 text-muted float-end">
            {{ __('pages/settings.roles_permissions.permissions_in_role', ['name' => $role->display_name]) }}
        </small>
    </div>
    <div
        class="border-t border-secondary-200 overflow-x-auto divide-y divide-secondary-200 dark:border-secondary-700 dark:divide-secondary-700">
        @foreach($groupPermissions as $group => $permissions)
            <div>
                <div class="w-full py-1.5 px-4 bg-secondary-100 dark:bg-secondary-700">
                    <span
                        class="text-sm font-bold leading-5 capitalize tracking-wide text-secondary-900 sm:text-base sm:leading-6 dark:text-white">
                        {{ ! empty($group) ? $group : __('pages/settings.roles_permissions.custom_permission') }}
                    </span>
                </div>
                <div class="px-4 py-1 divide-y divide-secondary-200 dark:divide-secondary-700">
                    @foreach($permissions as $permission)
                        <div class="flex items-center justify-between py-2">
                            <div class="flex items-center space-x-3">
                                <input
                                    id="permission_{{ $permission->id }}"
                                    name="permissions"
                                    type="checkbox"
                                    class="form-check-input"
                                    wire:key="{{ $permission->id }}"
                                    value="{{ $permission->id }}"
                                    aria-label="permission_{{ $permission->id }}"
                                    @click="togglePermission({{ $permission->id }})"
                                    @checked($role->hasPermissionTo($permission->name))
                                />
                                <x-admin::label for="permission_{{ $permission->id }}"
                                                :value="__($permission->display_name)"/>
                            </div>
                            <div class="flex items-center space-x-3">
                                @if($permission->can_be_removed)
                                    <button wire:click="removePermission({{ $permission->id }})" type="button"
                                            class="inline-flex items-center text-sm leading-5 text-medium text-secondary-500 hover:text-red-500 focus:text-red-700 focus:outline-none focus:shadow-none dark:text-secondary-400 dark:hover:text-red-500">
                                        <x-heroicon-o-trash class="w-5 h-5"/>
                                    </button>
                                @endif
                                @if($permission->users->count() > 0)
                                    <div class="flex items-center space-x-2">
                                        <div class="flex shrink-0 -space-x-1">
                                            @foreach($permission->users->limit(3) as $user)
                                                <img class="max-w-none h-6 w-6 rounded-full shadow-solid"
                                                     src="{{ $user->picture }}" alt="">
                                            @endforeach
                                        </div>
                                        @if($permission->users->count() - 3 > 0)
                                            <span
                                                class="shrink-0 text-xs leading-5 font-medium text-secondary-500 dark:text-secondary-400">
                                                +{{ $permission->users->count() - 3 }}
                                            </span>
                                        @endif
                                    </div>
                                @endif
                                <time datetime="{{ $permission->created_at->format('Y-m-d') }}"
                                      class="capitalize text-xs font-medium leading-5 text-secondary-400 dark:text-secondary-500">
                                    {{ $permission->created_at->formatLocalized('%b %d') }}
                                </time>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
</div>

@push('scripts')
    <script>
        function togglePermission(id) {
            window.livewire.emit('togglePermission', id)
        }
    </script>
@endpush
