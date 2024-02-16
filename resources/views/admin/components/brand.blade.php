@if (filled($brand = config('system.brand')))
    <img {{ $attributes }} src="{{ asset($brand) }}" alt="{{ app_name() }}" />
@else
    <img {{ $attributes }} src="{{ asset('assets/img/shopper-icon.svg') }}" alt="Web Wireframe" />
@endif
