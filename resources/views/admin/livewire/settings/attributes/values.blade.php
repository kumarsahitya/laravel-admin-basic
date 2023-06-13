@push('styles')
    @once
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/themes/nano.min.css"/>
    @endonce
@endpush

<div class="pb-10">
    <x-admin::separator/>

    <div class="mt-6 sm:mt-0">
        <h5 class="card-title font-semibold">
            {{ __('pages/attributes.values.title') }}
        </h5>
        <h6 class="mt-4 card-subtitle text-muted">
            {{ __('pages/attributes.values.description') }}
        </h6>
    </div>


    <section aria-labelledby="values_attributes_heading">

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 mt-5">
                    <div>
                        <div class="p-4">
                            <span class="shadow-sm rounded-md">
                                <x-admin::buttons.primary
                                    wire:click="$emit('openModal', 'modals.create-value', {{ json_encode([$attribute->id]) }})"
                                    type="button">
                                    {{ __('words.actions_label.add_new', ['name' => strtolower(__('layout.forms.label.value'))]) }}
                                </x-admin::buttons.primary>
                            </span>
                        </div>
                        <div class="flex flex-col">
                            <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
                                <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                                    <div
                                        class="overflow-hidden border-t border-secondary-200 dark:border-secondary-700">
                                        <table
                                            class="min-w-full divide-y divide-secondary-200 dark:divide-secondary-700">
                                            <thead>
                                            <tr class="bg-secondary-50 dark:bg-secondary-700">
                                                <th scope="col"
                                                    class="pl-6 py-3 text-left text-xs leading-4 font-medium text-secondary-500 uppercase tracking-wider dark:text-secondary-400"></th>
                                                <th scope="col"
                                                    class="pl-2 pr-6 py-3 text-left text-xs leading-4 font-medium text-secondary-500 uppercase tracking-wider dark:text-secondary-400">
                                                    {{ __('layout.forms.label.value') }}
                                                </th>
                                                <th scope="col"
                                                    class="px-6 py-3 text-left text-xs leading-4 font-medium text-secondary-500 uppercase tracking-wider dark:text-secondary-400">
                                                    {{ __('layout.forms.label.key') }}
                                                </th>
                                                <th scope="col"
                                                    class="relative text-right px-6 py-3 text-left text-xs leading-4 font-medium text-secondary-500 uppercase tracking-wider dark:text-secondary-400">
                                                    {{--<span class="sr-only">{{ __('words.actions') }}</span>--}}
                                                    {{ __('words.actions') }}
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody
                                                class="bg-white divide-y divide-secondary-200 dark:bg-secondary-800 dark:divide-secondary-700"
                                                x-max="1">
                                            @forelse($values as $v)
                                                <tr>
                                                    <td class="pl-6 py-4 whitespace-no-wrap text-sm leading-5 font-medium text-secondary-900">
                                                        <x-admin::forms.checkbox
                                                            aria-label="{{ __('pages/attributes.attribute_value') }}"
                                                            id="is_filterable_{{ $v->id }}" :value="$v->id"/>
                                                    </td>
                                                    <td class="pl-2 pr-6 py-4 whitespace-no-wrap text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                                        {{ $v->value }}
                                                    </td>
                                                    <td class="px-6 py-4 flex items-center space-x-3 whitespace-no-wrap text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                                        @if($v->attribute->type === 'colorpicker')
                                                            <div class="shrink-0 w-2.5 h-2.5 rounded-full"
                                                                 style="background-color: {{ $v->key }}"
                                                                 aria-hidden="true"></div>
                                                        @endif
                                                        <span>{{ $v->key }}</span>
                                                    </td>
                                                    <td class="px-6 py-4 whitespace-no-wrap text-right text-sm leading-5 font-medium">
                                                        <div class="flex-1 flex justify-end items-center space-x-4">
                                                            <button
                                                                wire:key="{{ $v->id }}"
                                                                wire:click="$emit('openModal', 'modals.update-value', {{ json_encode([$attribute->name, $type, $v->id]) }})"
                                                                type="button"
                                                                class="text-secondary-500 hover:text-secondary-600 dark:text-secondary-400 dark:hover:text-secondary-500"
                                                            >
                                                                <x-heroicon-o-pencil class="h-5 w-5"/>
                                                            </button>
                                                            <button wire:click="removeValue({{ $v->id }})" type="button"
                                                                    class="text-red-600 hover:text-red-700 dark:text-red-500">
                                                                <x-heroicon-o-trash class="h-5 w-5"/>
                                                            </button>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4"
                                                        class="px-6 py-3 whitespace-no-wrap text-sm leading-5 font-medium">
                                                        <div class="flex justify-center items-center space-x-2">
                                                            <svg class="h-8 w-8 text-secondary-400" fill="none"
                                                                 stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                      stroke-width="2"
                                                                      d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                                                            </svg>
                                                            <span
                                                                class="text-xl font-medium py-8 text-secondary-500 dark:text-secondary-400">
                                                        {{ __('words.no_values') }}
                                                    </span>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforelse
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

@push('scripts')
    @once
        <script src="https://cdn.jsdelivr.net/npm/@simonwep/pickr/dist/pickr.min.js"></script>
    @endonce
@endpush
