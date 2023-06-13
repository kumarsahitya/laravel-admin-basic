@props(['link', 'title'])

<li class="breadcrumb-item">
    <a {{ $attributes->merge(['class' => 'fw-light']) }} href="{{ $link }}">{{ $title }}</a>
</li>
