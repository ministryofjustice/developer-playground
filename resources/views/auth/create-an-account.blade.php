<x-guest-layout>
    <x-slot name="backlink">
        <a href="{{ route('dashboard') }}" class="govuk-back-link">Back</a>
    </x-slot>
    <x-form-card>
        <x-slot name="title">
            Create an account
        </x-slot>
        {{-- Validation Errors --}}
        <x-auth-validation-errors class="govuk-body" :errors="$errors"/>

        <form method="POST" action="/create-an-account/org-team">
            @csrf

            <div class="govuk-form-group">
                <fieldset class="govuk-fieldset" aria-describedby="contact-hint">
                    <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
                        <h2 class="govuk-fieldset__heading">
                            Organisation and team
                        </h2>
                    </legend>
                    <div id="contact-hint" class="govuk-hint">
                        Please select your organisation
                    </div>

                    <div class="govuk-radios govuk-radios--conditional" data-module="govuk-radios">
                        @foreach($organisations as $organisation)

                            <div class="govuk-radios__item">
                                <input class="govuk-radios__input" id="organisation_{{ $loop->index }}"
                                       name="organisation" type="radio"
                                       value="{{ $organisation->id }}"
                                       data-aria-controls="conditional-organisation-{{ $loop->index }}" required>
                                <label class="govuk-label govuk-radios__label" for="organisation_{{ $loop->index }}">
                                    {{ $organisation->name }}
                                </label>
                            </div>

                            @if($organisation->teams)

                                <div class="govuk-radios__conditional govuk-radios__conditional--hidden"
                                     id="conditional-organisation-{{ $loop->index }}">
                                    <h4 class="govuk-heading-s">Now select your team</h4>

                                    @foreach($organisation->teams as $team)

                                        <div class="govuk-radios">
                                            <div class="govuk-radios__item">
                                                <input class="govuk-radios__input"
                                                       id="team_{{ $loop->parent->index . $loop->index }}"
                                                       name="team" type="radio" value="{{ $team->id }}" required/>
                                                <label class="govuk-label govuk-radios__label"
                                                       for="team_{{ $loop->parent->index . $loop->index }}">
                                                    {{ $team->name }}
                                                </label>
                                            </div>
                                        </div><br>

                                    @endforeach

                                    <br>
                                    <p class="govuk-body">
                                        <x-nav-link href="{{ route('request-team-addition') }}">
                                            My team isn't listed here
                                        </x-nav-link>
                                    </p>
                                </div>

                            @endif
                        @endforeach

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
</x-guest-layout>
