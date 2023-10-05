<div class="govuk-form-group govuk-!-margin-top-6">
    <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
        @if(isset($showTitle))
        <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
            <h2 class="govuk-fieldset__heading">
                Cost Centre
            </h2>
        </legend>
        @endif
        <x-summary>{{ $summary ?? 'When purchases are made, where are the costs allocated?' }}</x-summary>
        <div class="govuk-radios" data-module="govuk-radios">
            @foreach($costCentres as $cost_centre)
                <div class="govuk-radios__item">
                    <input class="govuk-radios__input" id="cost-centre-{{ $loop->index }}"
                           name="cost_centre_id" type="radio"
                           value="{{ $cost_centre->id }}"
                           {{ $selected == $cost_centre->id ? 'checked="checked"' : '' }}
                           required>
                    <label class="govuk-label govuk-radios__label"
                           for="cost-centre-{{ $loop->index }}">
                        {{ $cost_centre->name }} &nbsp;&nbsp;
                        <small>{{ $cost_centre->number }}</small>
                    </label>
                </div>
            @endforeach
        </div>
    </fieldset>
</div>
