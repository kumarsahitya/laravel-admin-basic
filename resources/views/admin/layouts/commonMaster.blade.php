<!DOCTYPE html>
<html class="light-style layout-menu-fixed scroll-smooth" data-theme="theme-default" data-assets-path="{{ asset('/assets') . '/' }}"
      lang="{{ str_replace('_', '-', app()->getLocale()) }}"
      data-base-url="{{url('/')}}" data-framework="laravel" data-template="vertical-menu-laravel-template-free">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="X-DNS-Prefetch-Control" content="on">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="locale" content="{{ str_replace('_', '-', app()->getLocale()) }}">
    <meta name="base-url" content="{{ config('app.url') }}">
    <meta name="dashboard-url" content="{{ config('app.url') }}">
    <meta name="viewport"
          content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"/>

    <title>@yield('title') | {{ config('app.name') }} </title>

    <!-- laravel CRUD token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}"/>

    <link rel="dns-prefetch" href="{{ config('app.url') }}"/>

    <!-- Include Styles -->
    @stack('styles')
    @include('admin/layouts/sections/styles')
    @livewireStyles

    @wireUiScripts
    @livewireScripts
    <!-- Include Scripts for customizer, helper, analytics, config -->
    @include('admin/layouts/sections/scriptsIncludes')
    @stack('scripts')
</head>

<body>
<!-- Layout Content -->
@yield('layoutContent')
<!--/ Layout Content -->

<x-admin::alert/>

@livewire('livewire-ui-modal')
@livewire('notifications')
<!-- Include Scripts -->
@include('admin/layouts/sections/scripts')

</body>

</html>
