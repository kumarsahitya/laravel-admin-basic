@extends('admin/layouts/contentNavbarLayout')

@section('title', __('pages/auth.account.title'))

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/intl-tel-input/intlTelInput.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/intl-tel-input/intlTelInput.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/pages-account-settings-account.js')}}"></script>
@endsection

@section('content')

    <x-admin::breadcrumb>
        {{-- <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted" /> --}}
        <x-admin::breadcrumb.view :title="__('layout.account_dropdown.personal_account')" class="active"/>
    </x-admin::breadcrumb>

    <livewire:account.profile/>

    <x-admin::separator/>

    <livewire:account.password/>

    @if (config('auth.2fa_enabled'))
        <x-admin::separator/>
        <livewire:account.two-factor/>
    @endif

    <x-admin::separator/>

    <livewire:account.devices/>

@endsection
