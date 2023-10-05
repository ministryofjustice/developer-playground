<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('tools-create') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Procure a tool
        </x-slot>

        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>
        <form method="POST" action="{{ route('tools-add-business-case') }}">
            @csrf
            <div class="govuk-form-group">
                <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
                    <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
                        <h2 class="govuk-fieldset__heading">
                            Do you have a business case prepared for {{ $tooling['name'] ?? 'this tool' }}?
                        </h2>
                        <x-summary>
                            You can add a business case at a later date if necessary.
                        </x-summary>
                    </legend>
                    <div id="business-case-hint" class="govuk-hint">
                        Select yes or no.
                    </div>
                    <div class="govuk-radios govuk-radios--conditional" data-module="govuk-radios">
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input" id="business-case-yes" name="business-case" type="radio"
                                   value="yes"
                                   data-aria-controls="conditional-business-case-yes">
                            <label class="govuk-label govuk-radios__label" for="business-case-yes">
                                Yes
                            </label>
                        </div>
                        <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                             id="conditional-business-case-yes">
                            {{-- State a name --}}
                            <x-form-group
                                id="name"
                                label="Name"
                                summary="Give your case a concise and compelling name."
                                type="text"
                            />
                            {{-- Business Case --}}
                            <x-form-group
                                id="text"
                                label="Business Case"
                                summary="When writing the case, be detailed and include supporting documentation where possible."
                                type="textarea"
                            />
                        </div>
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input" id="contact-no" name="business-case" type="radio" value="no">
                            <label class="govuk-label govuk-radios__label" for="contact-no">
                                No
                            </label>
                        </div>
                    </div>
                </fieldset>
            </div>

            <div>
                <x-button>
                    {{ __('Continue') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
