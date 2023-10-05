<x-guest-layout>
    <x-auth-card>
        <x-slot name="title">
            Create an account
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <x-summary>
            An account will be created for you within the {{ $data['organisation'] }} organisation. Please check the
            following is correct before continuing:
        </x-summary>

        <dl class="govuk-summary-list govuk-!-width-two-thirds">
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    Organisation
                </dt>
                <dd class="govuk-summary-list__value">
                    {{ $data['organisation'] }}
                </dd>
                <dd class="govuk-summary-list__actions">
                    <a class="govuk-link" href="{{ route('create-an-account') }}">
                        Change<span class="govuk-visually-hidden"> name</span>
                    </a>
                </dd>
            </div>
            <div class="govuk-summary-list__row">
                <dt class="govuk-summary-list__key">
                    Team
                </dt>
                <dd class="govuk-summary-list__value">
                    {{ $data['team'] }}
                </dd>
                <dd class="govuk-summary-list__actions">
                    <a class="govuk-link" href="{{ route('create-an-account') }}">
                        Change<span class="govuk-visually-hidden"> name</span>
                    </a>
                </dd>
            </div>
        </dl>

        <div class="govuk-!-width-two-thirds">
            <p class="govuk-body">
                If you are happy, fill in the following fields and click Submit to complete your account set up.
            </p>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                {{-- Name --}}
                <x-form-group
                    id="name"
                    label="Name"
                    type="text"
                    :required="true"
                    :autofocus="true"
                />

                {{-- Email --}}
                <x-form-group
                    id="email"
                    label="Email"
                    type="text"
                    :required="true"
                />

                {{-- Password --}}
                <x-form-group
                    id="password"
                    label="Password"
                    type="password"
                    :required="true"
                    :autocomplete="'new-password'"
                />

                {{-- Password Confirmation--}}
                <x-form-group
                    id="password_confirmation"
                    label="Confirm Password"
                    type="password"
                    :required="true"
                    :autocomplete="'new-password'"
                />

                <div>
                    <a class="govuk-link" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <br>
                    <br>
                    <x-button class="ml-4">
                        {{ __('Submit') }}
                    </x-button>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
