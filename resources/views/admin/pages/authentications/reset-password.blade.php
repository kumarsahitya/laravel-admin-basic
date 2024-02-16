@extends('admin/layouts/blankLayout')

@section('title', __('pages/auth.reset.title'))

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}">
@endsection

@section('content')
    <div class="container-xxl">
        <div class="authentication-wrapper authentication-basic container-p-y">
            <div class="authentication-inner py-4">

                <!-- Forgot Password -->
                <div class="card">
                    <div class="card-body">
                        @if(session()->has('success'))
                            <div class="alert alert-success d-flex align-items-center" role="alert">
                                <i class='bx bxs-check-circle'></i>
                                <div class="ms-sm-1">
                                    {{ session()->get('success') }}
                                </div>
                            </div>
                        @endif
                        <!-- Logo -->
                        <div class="app-brand justify-content-center">
                            <a href="{{url('/')}}" class="app-brand-link gap-2">
                                <span
                                    class="app-brand-logo demo">@include('admin._partials.macros',['width'=>25,'withbg' => "#696cff"])</span>
                                <span
                                    class="app-brand-text demo text-body fw-bolder">{{ app_name() }}</span>
                            </a>
                        </div>
                        <!-- /Logo -->
                        <h4 class="mb-2">{{ __('pages/auth.email.title') }} 🔒</h4>
                        <p class="mb-4">{{ __('pages/auth.email.message') }}</p>
                        <form id="formAuthentication" class="mb-3" action="{{ route('admin.password.update') }}"
                              method="POST">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input
                                    name="email"
                                    type="email"
                                    required
                                    autofocus
                                    class="form-control @error('email') is-invalid @enderror" id="email"
                                    name="email"
                                    placeholder="{{ __('layout.forms.label.email') }}"
                                    value="{{ $email ?? old('email') }}">

                                @error('email')
                                <p class="mt-1 text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3 form-password-toggle">
                                <div class="d-flex justify-content-between">
                                    <label class="form-label"
                                           for="password">{{ __('layout.forms.label.password') }}</label>
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
                            <x-admin::buttons.primary type="submit" class="w-100">
                                {{ __('pages/auth.reset.action') }}
                            </x-admin::buttons.primary>
                        </form>
                    </div>
                </div>
            </div>
            <!-- /Forgot Password -->
        </div>
    </div>
    </div>
@endsection
