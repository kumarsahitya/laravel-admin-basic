@extends('admin/layouts/contentNavbarLayout')

@section('title', $title ?? null)

@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/intl-tel-input/intlTelInput.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/intl-tel-input/intlTelInput.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/choices/choices.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/tom-select/tom-select.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/store-settings.js')}}"></script>
@endsection

@section('content')
    {{ $slot }}
@endsection
