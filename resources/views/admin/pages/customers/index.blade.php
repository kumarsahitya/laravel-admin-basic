@extends('admin/layouts/contentNavbarLayout')

@section('title', __('layout.sidebar.customers'))

@section('content')

    <livewire:admin.customers.browse />

@endsection
