<x-admin::layouts.setting :title="__('pages/settings.legal.title')">

    <div
        x-data="{
            options: ['refund', 'privacy', 'terms', 'shipping'],
            words: {
                'refund': '{{ __('pages/settings.legal.refund') }}',
                'privacy': '{{ __('pages/settings.legal.privacy') }}',
                'terms': '{{ __('pages/settings.legal.terms_of_use') }}',
                'shipping': '{{ __('pages/settings.legal.shipping') }}'
            },
            currentTab: 'refund'
        }"
    >
        <x-admin::breadcrumb>
            <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')"
                                      class="text-muted"/>
            <x-admin::breadcrumb.link :link="route('admin.settings.index')" :title="__('words.settings')"
                                      class="text-muted"/>
            <x-admin::breadcrumb.view :title="__('pages/settings.legal.title')" class="active"/>
        </x-admin::breadcrumb>

        <div class="row">
            <div class="col-md-12">
                <ul class="nav nav-pills flex-column flex-md-row mb-3">
                    <li class="nav-item">
                        <button @click="currentTab = 'refund'" type="button" class="nav-link" aria-current="page"
                                :class="{ 'active': currentTab === 'refund' }">
                            {{ __('pages/settings.legal.refund') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button @click="currentTab = 'privacy'" type="button" class="nav-link"
                                :class="{ 'active': currentTab === 'privacy' }">
                            {{ __('pages/settings.legal.privacy') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button @click="currentTab = 'terms'" type="button" class="nav-link" aria-current="page"
                                :class="{ 'active': currentTab === 'terms' }">
                            {{ __('pages/settings.legal.terms_of_use') }}
                        </button>
                    </li>
                    <li class="nav-item">
                        <button @click="currentTab = 'shipping'" type="button" class="nav-link"
                                :class="{ 'active': currentTab === 'shipping' }">
                            {{ __('pages/settings.legal.shipping') }}
                        </button>
                    </li>
                </ul>
            </div>
        </div>

        <div class="mt-6">
            <div x-show="currentTab === 'refund'">
                <livewire:settings.legal.refund/>
            </div>
            <div x-cloak x-show="currentTab === 'privacy'">
                <livewire:settings.legal.privacy/>
            </div>
            <div x-cloak x-show="currentTab === 'terms'">
                <livewire:settings.legal.terms/>
            </div>
            <div x-cloak x-show="currentTab === 'shipping'">
                <livewire:settings.legal.shipping/>
            </div>
        </div>

    </div>

</x-admin::layouts.setting>
