@props(['value'])

<label {{ $attributes->merge(['class' => 'govuk-label']) }}>
    {{ $value ?? $slot }}
</label>
