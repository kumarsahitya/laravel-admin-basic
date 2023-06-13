@isset($link)
    <a
        href="{{ $link }}"
        {{ $attributes->merge(['class' => 'btn btn-info']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn-info']) }}>
        {{ $slot }}
    </button>
@endisset
