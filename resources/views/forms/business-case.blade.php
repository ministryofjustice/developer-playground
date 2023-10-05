<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('tools-create') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Add a business case
        </x-slot>

        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <div class="govuk-grid-row">
            <div class="govuk-grid-column-three-quarters">
                <p class="govuk-body">
                    All business cases should be prepared in an external word document (or presentation) and referenced
                    here. You will be able to define detail, add media such as supporting images and video much more
                    easily in an external file.
                </p>
                <br>
                <form method="POST" action="{{ route('business-cases-add') }}">
                    @csrf
                    <div class="govuk-form-group">
                        <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
                            <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
                                <h2 class="govuk-fieldset__heading">
                                    Provide business case information for {{ $tool->name ?? 'this tool' }}.
                                </h2>
                            </legend>
                            {{-- State a name --}}
                            <x-form-group
                                id="name"
                                label="Name"
                                summary="Give your case a concise and compelling name."
                                type="text"
                            />
                            {{-- Business Case --}}
                            <x-form-group
                                id="link"
                                label="Business Case (URL)"
                                summary="Please write your case in an external document, store in the cloud and paste the link to it here. Be detailed and include supporting documentation where possible."
                                type="text"
                            />
                        </fieldset>
                    </div>

                    <div>
                        <x-button>
                            {{ __('Continue') }}
                        </x-button>
                    </div>
                </form>
            </div>
        </div>
    </x-form-card>
</x-app-layout>
