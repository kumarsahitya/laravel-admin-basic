@extends('admin/layouts/blankLayout')

@section('title', __('pages/auth.two_factor.title'))

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="container-xxl" x-data="{ recovery: false }">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        <x-admin::validation-errors/>

                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <span class="app-brand-logo demo">
                                    @include('admin._partials.macros',["width"=>25,"withbg"=>'#696cff'])
                                </span>
                                <span class="app-brand-text demo text-body fw-bolder">
                                    {{app_name()}}
                                </span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">
                            <i class='bx bx-check-shield bx-md text-primary'></i>
                            {{ __('pages/auth.two_factor.subtitle') }}
                        </h4>
                        <p class="mb-4" x-show="! recovery">
                            {{ __('pages/auth.two_factor.authentication_code') }}
                        </p>
                        <p class="mb-4" x-show="recovery" style="display: none">
                            {{ __('pages/auth.two_factor.recovery_code') }}
                        </p>

                        <form class="mb-3" action="{{ route('admin.two-factor.post-login') }}" method="POST">
                            @csrf
                            <x-admin::forms.group x-show="! recovery" :label="__('layout.forms.label.code')"
                                                  for="code" noShadow>
                                <x-admin::forms.input id="code" type="text" name="code" autofocus x-ref="code"
                                                      autocomplete="one-time-code"/>
                            </x-admin::forms.group>

                            <x-admin::forms.group x-show="recovery" :label="__('Recovery Code')" for="recovery_code"
                                                  style="display: none" noShadow>
                                <x-admin::forms.input id="recovery_code" name="recovery_code" type="text"
                                                      x-ref="recovery_code" autocomplete="one-time-code"/>
                            </x-admin::forms.group>

                            <div class="my-3">
                                <p>
                                    {{ __('pages/auth.two_factor.remember') }}
                                </p>
                                <p>
                                    <button
                                        class="underline cursor-pointer"
                                        type="button"
                                        x-show="! recovery"
                                        x-on:click="
                                    recovery = true;
                                    $nextTick(() => { $refs.recovery_code.focus() })
                                "
                                    >
                                        {{ __('pages/auth.two_factor.use_recovery_code') }}
                                    </button>

                                    <button
                                        x-show="recovery"
                                        type="button"
                                        class="underline cursor-pointer"
                                        style="display: none"
                                        x-on:click="
                                    recovery = false;
                                    $nextTick(() => { $refs.code.focus() })
                                "
                                    >
                                        {{ __('pages/auth.two_factor.use_authentication_code') }}
                                    </button>
                                </p>
                            </div>
                            <div class="my-3">
                                <x-admin::buttons.primary type="submit" class="w-100">
                                    <span class="tf-icons bx bxs-lock-alt"></span>&nbsp;
                                    {{ __('pages/auth.two_factor.action') }}
                                </x-admin::buttons.primary>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>

@endsection

