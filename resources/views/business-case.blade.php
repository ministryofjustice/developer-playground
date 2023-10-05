<x-app-layout>
    <div class="govuk-grid-row">
        <div class="govuk-grid-column-three-quarters">
            <span class="govuk-caption-l">
                Created for <strong>{{ $business_case->licence->tool->name }}</strong>
                under licence #{{ $business_case->licence->id }}
                @if($business_case->licence->costCentre)
                    and cost centre <span title="{{ $business_case->licence->costCentre->name }}">
                        {{ $business_case->licence->costCentre->number }}
                    </span>
                @endif
            </span>
            <h1 class="govuk-heading-xl">{{ $business_case->name }}</h1>
        </div>
        <div class="govuk-grid-column-one-quarter">
            <div class="govuk-notification-banner tooling-approve-banner" role="region"
                 aria-labelledby="govuk-notification-banner-title"
                 data-module="govuk-notification-banner">
                <div class="govuk-notification-banner__header">
                    <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
                        Copy to a different licence and/or tool
                    </h2>
                </div>
                <div class="govuk-notification-banner__content">
                    <x-auth-validation-errors class="govuk-body" :errors="$errors"/>
                    <form method="post" action="{{route('business-cases-clone', $business_case->id)}}">
                        @csrf
                        <x-button class="govuk-button govuk-!-width-full govuk-!-margin-bottom-0">Clone</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
