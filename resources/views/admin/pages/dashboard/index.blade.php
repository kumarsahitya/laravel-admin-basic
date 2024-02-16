@extends('admin/layouts/contentNavbarLayout')

@section('title', __('layout.sidebar.dashboard'))


@section('vendor-style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
    <script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@section('page-script')
    <script src="{{asset('assets/js/dashboards-analytics.js')}}"></script>
@endsection

@section('content')
    <livewire:admin.dashboard />
@endsection
