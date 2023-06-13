@isset($link)
    <a
        href="{{ $link }}"
        {{ $attributes->merge(['class' => 'btn btn-dark']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn-dark']) }}>
        {{ $slot }}
    </button>
@endisset
