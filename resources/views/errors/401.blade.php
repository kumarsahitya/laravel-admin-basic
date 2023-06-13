@extends('admin.layouts.blankLayout')

@section('title', 'Error - Pages')

@section('page-style')
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-misc.css')}}">
@endsection


@section('content')
    <!-- Error -->
    <div class="container-xxl container-p-y">
        <div class="misc-wrapper">
            <h2 class="mb-2 mx-2">Not Authenticated :(</h2>
            <p class="mb-4 mx-2">Oops! 😖 You are not authenticated yet. Please Login first.</p>
            <a href="{{url('/')}}" class="btn btn-primary">Back to home</a>
            <div class="mt-3">
                <img src="{{asset('assets/img/illustrations/boy-with-laptop-access-light.png')}}" alt="boy-with-laptop-access-light"
                     width="500" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- /Error -->
@endsection
