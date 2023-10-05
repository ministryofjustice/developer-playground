{{-- Define a summary for a form element; input textarea select --}}

<div {{ $attributes }} class="govuk-hint">
    {!! $value ?? $slot !!}
</div>
