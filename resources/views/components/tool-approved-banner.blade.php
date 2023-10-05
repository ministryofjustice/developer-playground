@php
    // 4 states: REVIEW = 3; NEW = 2; APPROVED = 1; REJECTED = 0
    switch($approved) {
        case 'new':
            $class = ' govuk-notification-banner--new';
            $input_value = '1';
            $button = 'govuk-button--warning';
            $button_text = 'Approve';
            $text_main = $name . ' is newly added.';
            $text_sub = '';
            break;
        case 'approved':
            $class = ' govuk-notification-banner--success';
            $input_value = '0';
            $button = '';
            $button_text = 'Remove approval';
            $text_main = $name . ' has been evaluated and approved.';
            $text_sub = 'View <a href="#licences" class="govuk-link govuk-link--no-visited-state">licences</a> below for further information';
            break;
        case 'rejected':
            $class = '';
            $input_value = '1';
            $button = 'govuk-button--warning';
            $button_text = 'Approve';
            $text_main = $name . ' has been evaluated and rejected.';
            $text_sub = 'Please <a href="#timeline" class="govuk-link govuk-link--no-visited-state">review the timeline</a> for further detail.';
            break;
    }
@endphp
<div class="govuk-notification-banner{{ $class }} tooling-approve-banner" role="region" aria-labelledby="govuk-notification-banner-title"
     data-module="govuk-notification-banner">
    <div class="govuk-notification-banner__header">
        <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
            {{ strtoupper($approved) }}
        </h2>
    </div>
    <div class="govuk-notification-banner__content">
        <div class="tooling-approve">
            <form method="post" action="{{route('tools-approve', $toolId)}}">
                @csrf
                <div class="govuk-form-group">
                    <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
                        <div class="govuk-checkboxes" data-module="govuk-checkboxes">
                            <div class="govuk-checkboxes__item">
                                <input class="govuk-checkboxes__input" id="approved" name="approved" type="checkbox"
                                       value="{{ $input_value }}" data-aria-controls="conditional-approved" />
                                <label class="govuk-label govuk-checkboxes__label" for="approved">
                                    {{ $button_text }}
                                </label>
                            </div>
                            <div class="govuk-checkboxes__conditional govuk-checkboxes__conditional--hidden"
                                 id="conditional-approved">

                                <x-form-group
                                    id="approved_reason"
                                    label="Your reason?"
                                    type="textarea"
                                    class="govuk-grid-column-full"
                                    :required="true"
                                />

                                <x-button type="submit" class="{{ $button }}">
                                    {{ $button_text }}
                                </x-button>
                            </div>
                        </div>
                    </fieldset>
                </div>
            </form>
        </div>
        <h3 class="govuk-notification-banner__heading">
            {!! $text_main !!}
        </h3>
        <p class="govuk-body">
            {!! $text_sub !!}
        </p>
    </div>
</div>
