<div class="govuk-summary-list__row">
    <dt class="govuk-summary-list__key">
        {{ $title }}
    </dt>
    <dd class="govuk-summary-list__value">
        {{ $value }}
    </dd>
    <dd class="govuk-summary-list__actions">
        @if($route ?? null)
        <a class="govuk-link" href="{{ $route }}">
            Change<span class="govuk-visually-hidden"> {{ strtolower($title) }}</span>
        </a>
        @endif
    </dd>
</div>
