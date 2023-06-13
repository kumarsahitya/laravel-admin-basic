@extends('admin/layouts/contentNavbarLayout')

@section('title', __('words.settings'))

@section('content')
    <x-admin::breadcrumb>
        <x-admin::breadcrumb.link :link="route('admin.dashboard')" :title="__('words.dashboard')" class="text-muted"/>
        <x-admin::breadcrumb.view :title="__('words.settings')" class="active"/>
    </x-admin::breadcrumb>

    <div class="row">
        <div class="col-md-12">
            <div class="card shadow-md">
                <div class="card-body">
                    <div class="row">
                        @foreach(config('settings.items') as $menu)
                            @if($menu['permission'])
                                @can($menu['permission'])
                                    <x-admin::menu.setting :menu="$menu"/>
                                @endcan
                            @else
                                <x-admin::menu.setting :menu="$menu"/>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
