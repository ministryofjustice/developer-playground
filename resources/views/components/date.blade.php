<fieldset class="govuk-fieldset" role="group" aria-describedby="{{ $id }}-hint">
    <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
        <h1 class="govuk-fieldset__heading">
            {!! $label !!}
        </h1>
    </legend>
    <div id="{{ $id }}-hint" class="govuk-hint">
        For example, 27 3 2007
    </div>
    <div class="govuk-date-input" id="{{ $id }}">
        <div class="govuk-date-input__item">
            <div class="govuk-form-group">
                <x-label for="{{ $id }}_day"> Day </x-label>
                <x-input
                    id="{{ $id }}_day"
                    name="{{ $id }}_day"
                    type="text"
                    value="{{ $value['day'] ?? '' }}"
                    class="govuk-date-input__input govuk-input--width-2"
                    pattern="[0-9]*"
                    inputmode="numeric"
                    :required="true"
                />
            </div>
        </div>
        <div class="govuk-date-input__item">
            <div class="govuk-form-group">
                <x-label for="{{ $id }}_month"> Month </x-label>
                <x-input
                    id="{{ $id }}_month"
                    name="{{ $id }}_month"
                    type="text"
                    value="{{ $value['month'] ?? '' }}"
                    class="govuk-date-input__input govuk-input--width-2"
                    pattern="[0-9]*"
                    inputmode="numeric"
                    :required="true"
                />
            </div>
        </div>
        <div class="govuk-date-input__item">
            <div class="govuk-form-group">
                <x-label for="{{ $id }}_year"> Year </x-label>
                <x-input
                    id="{{ $id }}_year"
                    name="{{ $id }}_year"
                    type="text"
                    value="{{ $value['year'] ?? '' }}"
                    class="govuk-date-input__input govuk-input--width-4"
                    pattern="[0-9]*"
                    inputmode="numeric"
                    :required="true"
                />
            </div>
        </div>
    </div>
</fieldset>
