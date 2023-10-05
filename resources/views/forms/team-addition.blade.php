<x-guest-layout>
    <x-form-card>
        <x-slot name="title">
            Request a team addition
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <p class="govuk-body govuk-!-width-two-thirds">
            Use this form to request that your team is selectable from the create an account page. Requests via this method typically take a couple of hours to process.
        </p>
        <form method="POST" action="{{ route('request-team-addition') }}">
            @csrf

            {{-- Name --}}
            <x-form-group
                id="name"
                label="Name"
                summary="Please tell us your name."
                type="text"
                :required="true"
                :autofocus="true"
            />

            {{-- Email --}}
            <x-form-group
                id="email"
                label="Email"
                summary="What is your email address?"
                type="text"
                :required="true"
                :autofocus="true"
            />

            {{-- Select a team --}}
            <x-form-group
                id="team"
                label="Team name"
                summary="What is the name of the team you would like to add?"
                type="text"
                :required="true"
                :autofocus="true"
            />

            <x-label>
                Organisation
            </x-label>
            <x-summary>Please indicate the organisation under which the team exists.</x-summary>
            <div class="govuk-radios" data-module="govuk-radios">
                @foreach($organisations as $organisation)
                    <div class="govuk-radios__item">
                        <input class="govuk-radios__input" id="organisation-{{ $loop->index }}" name="organisation" type="radio"
                               value="{{$organisation->id}}">
                        <label class="govuk-label govuk-radios__label" for="organisation-{{ $loop->index }}">
                            {{ $organisation->name }}
                        </label>
                    </div>
                @endforeach
            </div>
            <hr class="govuk-section-break govuk-section-break--xl govuk-section-break--visible">
            <p class="govuk-body govuk-!-width-two-thirds">
                If you are happy with your entries you may complete your request by clicking the button below.
            </p>
            <div>
                <x-button>
                    {{ __('Add my team') }}
                </x-button>
            </div>
        </form>
    </x-form-card>
</x-guest-layout>
