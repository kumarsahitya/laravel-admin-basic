<div class="row">
    <div class="col-md-4">
        <div class="px-4 sm:px-0">
            <h5 class="card-title font-semibold">
                {{ __('pages/auth.account.profile_title') }}
            </h5>
            <h6 class="mt-4 card-subtitle text-muted">
                {{ __('pages/auth.account.profile_description') }}
            </h6>
        </div>
    </div>
    <div class="col-md-8">
        <form wire:submit.prevent="save">
            <div class="card mb-4 mt-4">
                <div class="card-body">
                    <div class="d-flex align-items-start align-items-sm-center gap-4">
                        <div class="button-wrapper">
                            <x-admin::forms.group
                                for="picture"
                                :label="__('layout.forms.label.photo')"
                                :error="$errors->first('picture')"
                                noShadow>
                                <x-admin::forms.avatar-upload
                                    wire:model.defer="picture" id="picture"
                                    class="account-file-input" hidden
                                    accept="image/png, image/jpeg"
                                    :resetClass="('account-image-reset')"
                                    :helpText="__('components.files.type_size_kb', ['size' => '800'])"
                                >
                                    @if($picture)
                                        <img class="d-block rounded"
                                             height="100" width="100" id="uploadedAvatar"
                                             src="{{ $picture->temporaryUrl() }}" alt="">
                                    @else
                                        <img class="d-block rounded"
                                             height="100" width="100" id="uploadedAvatar"
                                             src="{{ $logged_in_user->picture }}"
                                             alt="{{ $logged_in_user->email }}">
                                    @endif
                                </x-admin::forms.avatar-upload>
                            </x-admin::forms.group>
                        </div>
                    </div>
                </div>

                <hr class="my-0">
                <div class="card-body">
                    <div class="row">
                        <x-admin::forms.group for="first_name" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.first_name')"
                                              :error="$errors->first('first_name')" isRequired noShadow>
                            <x-admin::forms.input type='text' wire:model.defer='first_name' autocomplete='off'
                                                  id='first_name'
                                                  class="{{($errors->first('first_name') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="last_name" class="mb-3 col-md-6"
                                              :label="__('layout.forms.label.last_name')"
                                              :error="$errors->first('last_name')" isRequired noShadow>
                            <x-admin::forms.input type='text' wire:model.defer='last_name' autocomplete='off'
                                                  id='last_name' value="{{ $last_name }}"
                                                  class="{{($errors->first('last_name') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <x-admin::forms.group for="email" class="mb-3 col-md-6" :label="__('layout.forms.label.email')"
                                              :error="$errors->first('email')" isRequired noShadow>
                            <x-admin::forms.input wire:model='email' id='email' type='email'
                                                  autocomplete='email-address'
                                                  class="{{($errors->first('email') ?  'is-invalid' : '')}}"/>
                        </x-admin::forms.group>

                        <div wire:ignore class="mb-3 col-md-6">
                            <div>
                                <x-admin::label for="phone_number" class="form-label"
                                                :value="__('layout.forms.label.phone_number')"/>
                                <span class="text-muted">
                                    ({{ __('layout.forms.label.optional') }})
                                </span>
                            </div>
                            <div class="mt-1 relative">
                                <x-admin::forms.input wire:model.defer="phone_number" id="phone_number" type="tel"
                                                      autocomplete="off"
                                                      class="pr-10 {{($errors->first('phone_number') ?  'is-invalid' : '')}}"/>
                                @error('phone_number')
                                <span class="mt-1 text-danger">{{ $errors->first('phone_number') }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="mt-2">
                        <x-admin::buttons.primary type="submit" class="me-2" wire:loading.attr="disabled"
                                                  style="display: inline-flex; align-items: center;">
                            <x-admin::loader wire:loading wire:target="save" class="text-white me-2"/>
                            {{ __('layout.forms.actions.save') }}
                        </x-admin::buttons.primary>
                        <x-admin::buttons.secondary class="btn-outline-secondary" type="button"
                        :link="route('admin.dashboard')">
                            {{ __('layout.forms.actions.cancel') }}
                        </x-admin::buttons.secondary>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

