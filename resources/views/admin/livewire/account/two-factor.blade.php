<div class="row">
    <div class="col-md-4">
        <div class="px-4 sm:px-0">
            <h5 class="card-title font-semibold">
                {{ __('pages/auth.account.two_factor_title') }}
            </h5>
            <h6 class="mt-4 card-subtitle text-muted">
                {{ __('pages/auth.account.two_factor_description') }}
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
                    {{ __('pages/auth.account.two_factor_enabled') }}
                @else
                    {{ __('pages/auth.account.two_factor_disabled') }}
                @endif
            </h5>
            <div class="card-body">
                @if (! $this->enabled)
                    <div class="alert alert-info d-flex border-light-info align-items-center p-4" role="alert">
                        <i class='bx bxs-info-circle'></i>
                        <div class="ms-sm-2">
                            {{ __('pages/auth.account.two_factor_install_message') }}
                            <a href="https://support.google.com/accounts/answer/1066447" target="_blank"
                               class="alert-link">
                                <u>
                                    {{ __('components.learn_more') }} &rarr;
                                </u>
                            </a>
                        </div>
                    </div>
                @endif

                <div class="d-flex align-items-center">
                    <i class='bx bx-check-shield text-primary bx-lg'></i>
                    <div class="ms-4">
                        <p class="mb-0">{{ __('pages/auth.account.two_factor_secure') }}</p>
                        @if($this->enabled)
                            <p class="mt-3">{{ __('pages/auth.account.two_factor_activation_message') }}</p>
                        @endif
                    </div>
                </div>
                <div class="p-3">
                    @if ($this->enabled)
                        @if ($showingQrCode)
                            <p>{{ __('pages/auth.account.two_factor_is_enabled') }}</p>
                            <div class="mt-4">
                                {!! $this->user->twoFactorQrCodeSvg() !!}
                            </div>
                        @endif

                        @if ($showingRecoveryCodes)
                            <div class="mt-4">
                                <p class="font-bold">
                                    {{ __('pages/auth.account.two_factor_store_recovery_codes') }}
                                </p>
                            </div>

                            <div
                                class="grid gap-1 mt-4 p-4  bg-secondary-100 rounded-lg">
                                @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                                    <div>{{ $code }}</div>
                                @endforeach
                            </div>
                        @endif
                    @endif
                </div>
                <div class="p-3 sm:px-6 text-right">
                    @if(! $this->enabled)
                        <x-admin::confirms-password wire:then="enableTwoFactorAuthentication">
                            <x-admin::buttons.primary type="button" wire:loading.attr="disabled">
                                {{ __('layout.forms.actions.enabled_two_factor') }}
                            </x-admin::buttons.primary>
                        </x-admin::confirms-password>
                    @else
                        <div class="sm:flex sm:flex-row-reverse">
                            <x-admin::confirms-password wire:then="disableTwoFactorAuthentication">
                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                    <x-admin::buttons.danger wire:loading.attr="disabled" type="button">
                                        {{ __('layout.forms.actions.disabled') }}
                                    </x-admin::buttons.danger>
                                </span>
                            </x-admin::confirms-password>
                            @if ($showingRecoveryCodes)
                                <x-admin::confirms-password wire:then="regenerateRecoveryCodes">
                                    <span class="flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                        <x-admin::buttons.primary wire:loading.attr="disabled" type="button">
                                            {{ __('layout.forms.actions.regenerate') }}
                                        </x-admin::buttons.primary>
                                    </span>
                                </x-admin::confirms-password>
                            @else
                                <x-admin::confirms-password wire:then="showRecoveryCodes">
                                    <span class="flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                                        <x-admin::buttons.secondary wire:loading.attr="disabled" type="button"
                                                                    class="justify-center w-full">
                                            {{ __('layout.forms.actions.show_recovery_code') }}
                                        </x-admin::buttons.secondary>
                                    </span>
                                </x-admin::confirms-password>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
