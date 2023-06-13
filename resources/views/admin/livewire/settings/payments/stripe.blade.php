<div class="row">
    <div class="col-md-4">
        <div class="px-4 sm:px-0">
            <h5 class="card-title font-semibold">
                {{ __('Stripe') }}
            </h5>
            <h6 class="mt-4 card-subtitle text-muted">
                {{ __('pages/settings.payment.stripe_description') }}
            </h6>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4 mt-4">
            <h5 class="card-header">
                <i @class([
                            'bx bxs-circle',
                            'text-success' => $this->enabled,
                        ])></i>
                @if ($this->enabled)
                    {{ __('pages/settings.payment.stripe_enabled') }}
                @else
                    {{ __('pages/settings.payment.stripe_disabled') }}
                @endif
            </h5>
            <div class="card-body pt-4">
                <div class="shrink-0">
                    <svg class="h-12 w-auto" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 95.779 40.164">
                        <g transform="translate(24.946 -325.034)">
                            <g transform="translate(-38.97 315.774) scale(.26458)">
                                <path
                                    d="M414 113.4c0-25.6-12.4-45.8-36.1-45.8-23.8 0-38.2 20.2-38.2 45.6 0 30.1 17 45.3 41.4 45.3 11.9 0 20.9-2.7 27.7-6.5v-20c-6.8 3.4-14.6 5.5-24.5 5.5-9.7 0-18.3-3.4-19.4-15.2h48.9c0-1.3.2-6.5.2-8.9zm-49.4-9.5c0-11.3 6.9-16 13.2-16 6.1 0 12.6 4.7 12.6 16z"
                                    class="st0" clip-rule="evenodd" fill="#6772e5" fill-rule="evenodd"/>
                                <path
                                    d="M301.1 67.6c-9.8 0-16.1 4.6-19.6 7.8l-1.3-6.2h-22v116.6l25-5.3.1-28.3c3.6 2.6 8.9 6.3 17.7 6.3 17.9 0 34.2-14.4 34.2-46.1-.1-29-16.6-44.8-34.1-44.8zm-6 68.9c-5.9 0-9.4-2.1-11.8-4.7l-.1-37.1c2.6-2.9 6.2-4.9 11.9-4.9 9.1 0 15.4 10.2 15.4 23.3 0 13.4-6.2 23.4-15.4 23.4z"
                                    class="st0" clip-rule="evenodd" fill="#6772e5" fill-rule="evenodd"/>
                                <path clip-rule="evenodd" fill="#6772e5" fill-rule="evenodd"
                                      d="M248.9 56.3V36l-25.1 5.3v20.4z"/>
                                <path class="st0" clip-rule="evenodd" fill="#6772e5" fill-rule="evenodd"
                                      d="M223.8 69.3h25.1v87.5h-25.1z"/>
                                <path
                                    d="M196.9 76.7l-1.6-7.4h-21.6v87.5h25V97.5c5.9-7.7 15.9-6.3 19-5.2v-23c-3.2-1.2-14.9-3.4-20.8 7.4z"
                                    class="st0" clip-rule="evenodd" fill="#6772e5" fill-rule="evenodd"/>
                                <path
                                    d="M146.9 47.6l-24.4 5.2-.1 80.1c0 14.8 11.1 25.7 25.9 25.7 8.2 0 14.2-1.5 17.5-3.3V135c-3.2 1.3-19 5.9-19-8.9V90.6h19V69.3h-19z"
                                    class="st0" clip-rule="evenodd" fill="#6772e5" fill-rule="evenodd"/>
                                <path
                                    d="M79.3 94.7c0-3.9 3.2-5.4 8.5-5.4 7.6 0 17.2 2.3 24.8 6.4V72.2c-8.3-3.3-16.5-4.6-24.8-4.6C67.5 67.6 54 78.2 54 95.9c0 27.6 38 23.2 38 35.1 0 4.6-4 6.1-9.6 6.1-8.3 0-18.9-3.4-27.3-8v23.8c9.3 4 18.7 5.7 27.3 5.7 20.8 0 35.1-10.3 35.1-28.2-.1-29.8-38.2-24.5-38.2-35.7z"
                                    class="st0" clip-rule="evenodd" fill="#6772e5" fill-rule="evenodd"/>
                            </g>
                        </g>
                    </svg>
                </div>
                <div class="mt-4">
                    <p class="text-secondary-500 text-sm leading-5 dark:text-secondary-400">
                        {{ __('pages/settings.payment.stripe_provider') }}
                        <a href="https://github.com/stripe/stripe-php" target="_blank"
                           class="text-primary-600 hover:text-primary-500">{{ __('pages/settings.payment.stripe_about') }}</a>
                    </p>
                    @if(! $this->enabled)
                        <span class="mt-4 rounded-md shadow-sm">
                            <x-admin::buttons.secondary wire:click="enabledStripe" wire.loading.attr="disabled"
                                                        type="button"
                                                        style="display: inline-flex; align-items: center;">
                                <x-admin::loader wire:loading wire:target="enabledStripe"
                                                 class="text-secondary-600 dark:text-secondary-300 me-2"/>
                                {{ __('pages/settings.payment.stripe_actions') }}
                            </x-admin::buttons.secondary>
                        </span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@if($this->enabled)
    <x-admin::separator/>
    <div class="row">
        <div class="col-md-4">
            <div class="px-4 sm:px-0">
                <h5 class="card-title font-semibold">
                    {{ __('words.environment') }}
                </h5>
                <h6 class="mt-4 card-subtitle text-muted">
                    {{ __('pages/settings.payment.stripe_environment') }}
                    {{ __('pages/settings.payment.stripe_dashboard') }}
                    <a href="https://dashboard.stripe.com/account/apikeys" target="_blank"
                       class="text-primary-600 dark:text-primary-500/50">
                        https://dashboard.stripe.com/account/apikeys
                    </a>
                </h6>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group :label="__('layout.forms.label.public_key')" for="public_key"
                                              class="mb-3 col-md-6">
                            <x-admin::forms.input wire:model.lazy="stripe_key" id="public_key" type="text"
                                                  autocomplete="off"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group :label="__('layout.forms.label.secret_key')" for="secret_key"
                                              class="mb-3 col-md-6">
                            <x-admin::forms.input wire:model.lazy="stripe_secret" id="secret_key" type="text"/>
                        </x-admin::forms.group>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="mt-6 pt-5 border-t border-secondary-200 dark:border-secondary-700">
        <div class="text-right">
            <x-admin::buttons.primary wire:click="store" type="button" wire:loading.attr="disabled"
                                      style="display: inline-flex; align-items: center;">
                <x-admin::loader wire:loading wire:target="store" class="text-white me-2"/>
                {{ __('layout.forms.actions.update') }}
            </x-admin::buttons.primary>
        </div>
    </div>
@endif

