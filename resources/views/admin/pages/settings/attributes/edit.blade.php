<x-admin::layouts.setting :title="__('pages/attributes.update', ['attribute' => $attribute->name])">

    <livewire:settings.attributes.edit :attribute="$attribute" />

</x-admin::layouts.setting>
