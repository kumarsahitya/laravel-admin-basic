@extends('admin.layouts.blankLayout')

@section('title', __('pages/auth.login.title'))

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner">
                <!-- Register -->
                <div class="card">
                    <div class="card-body">

                        <x-admin::validation-errors/>

                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <span
                                        class="app-brand-logo demo">
                                    @include('admin._partials.macros',["width"=>25,"withbg"=>'#696cff'])
                                </span>

                                <span
                                        class="app-brand-text demo text-body fw-bolder">{{app_name()}}</span>
                            </a>
                        </div>

                        <!-- /Logo -->
                        <h4 class="mb-2">{{ __('pages/auth.login.title') }} 👋</h4>
                        <p class="mb-4">{{ __('pages/auth.login.message') }}</p>

                        <form id="formAuthentication" class="mb-3" action="{{  url('/admin/authenticate') }}"
                              method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('layout.forms.label.email') }}</label>
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                                       name="email" placeholder="{{ __('layout.forms.label.email') }}" autofocus
                                       value="{{ old('email') }}">
                                @error('email')
                                <span class="mt-2 text-danger">{{ $errors->first('email') }}</span>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label"
                                           for="password">{{ __('layout.forms.label.password') }}</label>
                                    <a href="{{url('admin/password/reset')}}">
                                        <small>{{ __('pages/auth.login.forgot_password') }}</small>
                                    </a>
                                </div>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password"
                                           class="form-control @error('password') is-invalid @enderror" name="password"
                                           placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                           aria-describedby="password"/>
                                    <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                </div>
                                @error('password')
                                <span class="mt-1 text-danger">{{ $errors->first('password') }}</span>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember-me">
                                    <label class="form-check-label" for="remember-me">
                                        {{ __('layout.forms.label.remember') }}
                                    </label>
                                </div>
                            </div>
                            <div class="mb-3">
                                <x-admin::buttons.primary type="submit" class="w-100">
                                    <span class="tf-icons bx bxs-lock-alt"></span>&nbsp;
                                    {{ __('pages/auth.login.action') }}
                                </x-admin::buttons.primary>
                            </div>
                        </form>

                        {{--                        <p class="text-center">--}}
                        {{--                            <span>New on our platform?</span>--}}
                        {{--                            <a href="{{url('auth/register-basic')}}">--}}
                        {{--                                <span>Create an account</span>--}}
                        {{--                            </a>--}}
                        {{--                        </p>--}}
                    </div>
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
    </div>
@endsection
