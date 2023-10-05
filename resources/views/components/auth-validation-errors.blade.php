@props(['errors'])

@if ($errors->any())
    <div class="govuk-error-summary" aria-labelledby="error-summary-title" role="alert" tabindex="-1" data-module="govuk-error-summary">
        <h2 class="govuk-error-summary__title" id="error-summary-title">
            {{ __('Whoops! Something went wrong.') }}
        </h2>
        <div class="govuk-error-summary__body">
            <ul class="govuk-list govuk-error-summary__list">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif
