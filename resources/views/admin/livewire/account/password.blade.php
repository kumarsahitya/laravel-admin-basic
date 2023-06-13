<div class="row">
    <div class="col-md-4">
        <div class="px-4 sm:px-0">
            <h5 class="card-title font-semibold">
                {{ __('pages/auth.account.password_title') }}
            </h5>
            <h6 class="mt-4 card-subtitle text-muted">
                {{ __('pages/auth.account.password_description') }}
            </h6>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card mb-4 mt-4">
            <div class="card-body">
                @if (session()->has('error'))
                    <div class="alert alert-danger d-flex align-items-center" role="alert">
                        <i class='bx bxs-x-circle'></i>
                        <div class="ms-sm-1">
                            {{ session('error') }}
                        </div>
                    </div>
                @endif
                <div class="row">
                    <x-admin::forms.group :label="__('layout.forms.label.current_password')" for="current_password"
                                          class="mb-3 col-md-12" :error="$errors->first('current_password')"
                                          isRequired noShadow>
                        <x-admin::forms.input wire:model.defer="current_password" id="current_password" type="password"
                                              autocomplete="off"
                                              class="{{($errors->first('current_password') ?  'is-invalid' : '')}}"/>
                    </x-admin::forms.group>

                    <x-admin::forms.group :label="__('layout.forms.label.new_password')" for="password"
                                          class="mb-3 col-md-12" :error="$errors->first('password')"
                                          :helpText="__('pages/auth.account.password_helper_validation')" isRequired
                                          noShadow>
                        <x-admin::forms.input wire:model.defer="password" id="password" type="password"
                                              autocomplete="off"
                                              class="{{($errors->first('password') ?  'is-invalid' : '')}}"
                                              data-bs-toggle="tooltip"
                                              data-bs-placement="bottom" data-bs-html="true"
                                              data-bs-original-title="{!! __('pages/auth.account.password_helper_validation') !!}"/>
                    </x-admin::forms.group>

                    <x-admin::forms.group :label="__('layout.forms.label.confirm_password')" for="password_confirmation"
                                          class="mb-3 col-md-12" :error="$errors->first('password_confirmation')"
                                          isRequired noShadow>
                        <x-admin::forms.input wire:model.defer="password_confirmation" id="password_confirmation"
                                              type="password" autocomplete="off"
                                              class="{{($errors->first('password_confirmation') ?  'is-invalid' : '')}}"/>
                    </x-admin::forms.group>
                </div>
                <div class="mt-2">
                    <x-admin::buttons.primary wire:click="save" wire:loading.attr="disabled" type="button"
                                              style="display: inline-flex; align-items: center;">
                        <x-admin::loader wire:loading wire:target="save" class="text-white me-2"/>
                        {{ __('layout.forms.actions.update') }}
                    </x-admin::buttons.primary>
                </div>
            </div>
        </div>
    </div>
</div>
