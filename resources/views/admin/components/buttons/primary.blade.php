@isset($link)
    <a
        href="{{ $link }}"
        {{ $attributes->merge(['class' => 'btn btn-primary']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn-primary']) }}>
        {{ $slot }}
    </button>
@endisset
