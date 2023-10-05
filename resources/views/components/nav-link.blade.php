@props([
    'active',
    'no_visit'
])

@php
$classes = ($active ?? false)
            ? 'govuk-link active'
            : 'govuk-link';

$classes = ($no_visit ?? false)
            ? $classes . ' govuk-link--no-visited-state'
            : $classes;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>{{ $slot }}</a>
