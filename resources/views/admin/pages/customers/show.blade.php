<x-admin::layouts.app :title="__('words.actions_label.show', ['name' => $customer->full_name])">

    <livewire:customers.show :customer="$customer" />

</x-admin::layouts.app>
