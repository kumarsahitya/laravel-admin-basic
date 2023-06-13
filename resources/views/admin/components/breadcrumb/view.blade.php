@props(['title'])

<li {{ $attributes->merge(['class' => 'breadcrumb-item']) }}>
    {{ $title }}
</li>
