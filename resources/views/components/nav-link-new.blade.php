@props(['active'])

@php
$classes = ($active ?? false)
            ? 'nav_link active'
            : 'nav_link';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
