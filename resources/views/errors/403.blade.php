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
            <h2 class="mb-2 mx-2">Not Authorized :(</h2>
            <p class="mb-4 mx-2">Oops! 😖 The requested URL was not authorized for you.</p>
            <a href="{{url('/')}}" class="btn btn-primary">Back to home</a>
            <div class="mt-3">
                <img src="{{asset('assets/img/illustrations/exhausted-woman-sitting-table-working.png')}}" alt="exhausted-woman-sitting-table-working"
                     width="500" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- /Error -->
@endsection
