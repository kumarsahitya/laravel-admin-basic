@isset($link)
    <a
        href="{{ $link }}"
        {{ $attributes->merge(['class' => 'btn btn-secondary']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn-secondary']) }}>
        {{ $slot }}
    </button>
@endisset
