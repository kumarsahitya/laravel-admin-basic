<x-admin::layouts.setting :title="__('pages/settings.roles_permissions.roles') . ' ~ ' . $role->display_name">

    <livewire:settings.management.role :role="$role" />

</x-admin::layouts.setting>
