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
        <form method="POST" action="{{ route('tools-add-contact') }}">
            @csrf
            <div class="govuk-form-group">
                <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
                    <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
                        <h2 class="govuk-fieldset__heading">
                            Are you the main contact for {{ $tooling['name'] ?? 'this tool' }}?
                        </h2>
                    </legend>
                    <div id="contact-hint" class="govuk-hint">
                        Select yes or no.
                    </div>
                    <div class="govuk-radios govuk-radios--conditional" data-module="govuk-radios">
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input" id="contact-yes" name="contact" type="radio" value="yes"
                                   data-aria-controls="conditional-contact-2">
                            <label class="govuk-label govuk-radios__label" for="contact-2">
                                Yes
                            </label>
                        </div>
                        <div class="govuk-radios__item">
                            <input class="govuk-radios__input" id="contact-no" name="contact" type="radio" value="no"
                                   data-aria-controls="conditional-contact-no">
                            <label class="govuk-label govuk-radios__label" for="contact-no">
                                No
                            </label>
                        </div>
                        <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                             id="conditional-contact-no">
                            {{-- State a name --}}
                            <x-form-group
                                id="name"
                                label="Full name"
                                summary="What is the contacts name?"
                                type="text"
                            />

                            {{-- email --}}
                            <x-form-group
                                id="email"
                                label="Email"
                                summary="Please enter the contacts email address here."
                                type="text"
                            />

                            {{-- Slack --}}
                            <x-form-group
                                id="slack"
                                label="Slack ID"
                                summary="Enter a Slack member ID for this contact."
                                type="text"
                            />
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
