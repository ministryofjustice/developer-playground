<x-app-layout>
    <x-slot name="backlink">
        <a href="{{ route('teams') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Create a team
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="{{ route('teams-add') }}">
            @csrf

            <div class="govuk-!-width-two-thirds">
                {{-- Select a team --}}
                <x-form-group
                    id="name"
                    label="Team"
                    summary="What is the team name?"
                    type="text"
                    :required="true"
                    :autofocus="true"
                />

                {{-- comms_url --}}
                <x-form-group
                    id="comms_url"
                    label="Comms URL"
                    summary="Used to deliver important messages about tooling or licences.<br>Currently supported: Slack channel handle in the form of; #the-channel"
                    type="text"
                />
            </div>

            @php
                $column_width = (isset($cost_centres) && count($cost_centres) > 0 ? 'one-half' : 'full')
            @endphp
            <div class="govuk-grid-row">
                <div class="govuk-grid-column-{{$column_width}}">
                    <div class="govuk-form-group govuk-!-margin-top-6">
                        <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
                            <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
                                <h2 class="govuk-fieldset__heading">
                                    Organisation
                                </h2>
                            </legend>
                            <x-summary>Select the organisation in which the team operates</x-summary>
                            <div class="govuk-radios" data-module="govuk-radios">
                                @foreach($organisations as $organisation)
                                    <div class="govuk-radios__item">
                                        <input class="govuk-radios__input" id="organisation-{{ $loop->index }}"
                                               name="organisation_id" type="radio"
                                               value="{{$organisation->id}}" required>
                                        <label class="govuk-label govuk-radios__label"
                                               for="organisation-{{ $loop->index }}">
                                            {{ $organisation->name }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </fieldset>
                    </div>
                </div>
                @if(isset($cost_centres) && count($cost_centres) > 0)
                    <div class="govuk-grid-column-one-half">
                        <x-cost-centres
                            showTitle="true"
                            summary="When purchases are made by this team, where are the costs allocated?"
                            :costCentres="$cost_centres"
                            selected=""
                        ></x-cost-centres>
                    </div>
                @endif
            </div>
            <hr class="govuk-section-break govuk-section-break--xl govuk-section-break--visible">
            <div>
                <x-button>
                    {{ __('Save team') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-app-layout>
