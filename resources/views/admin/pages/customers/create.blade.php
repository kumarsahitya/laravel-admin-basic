@extends('admin/layouts/contentNavbarLayout')

@section('title', __('words.actions_label.add_new', ['name' => __('words.customer')]))

@section('vendor-style')
    <link rel="stylesheet"
          href="{{ asset('assets/vendor/libs/intl-tel-input/intlTelInput.css') }}">
@endsection

@section('vendor-script')
    <script src="{{ asset('assets/vendor/libs/intl-tel-input/intlTelInput.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/tom-select/tom-select.js') }}"></script>
@endsection

@section('page-script')
    <script src="{{ asset('assets/js/customer.js') }}"></script>
@endsection

@section('content')

    <livewire:admin.customers.create />

@endsection
