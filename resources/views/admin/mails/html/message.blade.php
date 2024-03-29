@component('admin.mails.html.layout')
    {{-- Header --}}
    @slot('header')
        @component('admin.mails.html.header', ['url' => config('app.url'), 'description' => __('Online Shopping Tool')])
            {{ app_name() }}
        @endcomponent
    @endslot

    {{-- Body --}}
    {{ $slot }}

    {{-- Subcopy --}}
    @isset($subcopy)
        @slot('subcopy')
            @component('admin.mails.html.subcopy')
                {{ $subcopy }}
            @endcomponent
        @endslot
    @endisset

    {{-- Footer --}}
    @slot('footer')
        @component('admin.mails.html.footer')
            © {{ date('Y') }} {{ app_name() }}. @lang('All rights reserved.')
        @endcomponent
    @endslot
@endcomponent
