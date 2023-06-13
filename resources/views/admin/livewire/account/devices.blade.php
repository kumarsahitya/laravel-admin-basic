<div class="row">
    <div class="col-md-4">
        <div class="px-4 sm:px-0">
            <h5 class="card-title font-semibold">
                {{ __('pages/auth.account.device_title') }}
            </h5>
            <h6 class="mt-4 card-subtitle text-muted">
                {{ __('pages/auth.account.device_description') }}
            </h6>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4 mt-4">
            <div class="card-body">
                @if (count($this->sessions) > 0)
                    <p class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                        {{ __('pages/auth.account.empty_device') }}
                    </p>
                    <div class="mt-2 divide-y divide-secondary-200 dark:divide-secondary-700">
                        @foreach($this->sessions as $session)
                            <div class="py-4 flex items-center justify-between">
                                <div class="flex items-center space-x-3">
                                    <div class="shrink-0">
                                        @if ($session->agent->isDesktop())
                                            <x-heroicon-o-desktop-computer class="w-8 h-8 text-secondary-500"/>
                                        @else
                                            <x-heroicon-o-device-mobile class="w-8 h-8 text-secondary-500"/>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="flex items-center">
                                            <h4 class="text-sm leading-5 text-secondary-500 dark:text-secondary-400">
                                                    <span class="text-green-500">
                                                        {{ __('words.browser_platform', [
                                                            'browser' => $session->agent->browser(),
                                                            'platform' => $session->agent->platform()
                                                       ]) }}
                                                    </span>
                                                - {{ $session->ip_address }}
                                            </h4>
                                            @if ($session->is_current_device)
                                                <span
                                                    class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium leading-4 bg-green-100 text-green-800">
                                                        {{ __('pages/auth.account.current_device') }}
                                                    </span>
                                            @else
                                                <span class="ml-2 text-xs text-secondary-400 dark:text-secondary-500">
                                                        {{ __('pages/auth.account.device_last_activity') }} {{ $session->last_active }}
                                                    </span>
                                            @endif
                                        </div>
                                        <p class="mt-0.5 text-sm leading-4 text-secondary-500 dark:text-secondary-400">
                                            @if($session->location)
                                                {{ $session->location->cityName }}, {{ $session->location->regionName }}
                                                , {{ $session->location->countryName }}
                                            @else
                                                {{ __('pages/auth.account.device_location') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                @if (!$session->is_current_device)
                                    <div class="ml-4">
                                            <span class="inline-flex rounded-md shadow-sm">
                                                <x-admin::buttons.primary
                                                    wire:click="$emit('openModal', 'modals.logout-others-browser')"
                                                    wire:loading.attr="disabled" type="button">
                                                    {{ __('words.log_out') }}
                                                </x-admin::buttons.primary>
                                            </span>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="alert alert-warning d-flex border-light-warning align-items-center p-4" role="alert">
                        <i class='bx bxs-info-circle'></i>
                        <div class="ms-sm-2">
                            {{ __('pages/auth.account.device_enabled_feature') }}
                            <a href="https://laravel.com/docs/session" target="_blank"
                               class="alert-link">
                                <u>
                                    {{ __('components.learn_more') }} &rarr;
                                </u>
                            </a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

