@isset($link)
    <a
        href="{{ $link }}"
        {{ $attributes->merge(['class' => 'btn btn-success']) }}
    >
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['class' => 'btn btn-success']) }}>
        {{ $slot }}
    </button>
@endisset
