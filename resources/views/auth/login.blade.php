<x-guest-layout>
    <x-auth-card>
        <x-slot name="title">
            Log in
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')"/>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors"/>

        <form method="POST" action="{{ route('login') }}" class="govuk-!-width-two-thirds">
            @csrf

            {{-- Email --}}
            <x-form-group
                id="email"
                label="Email"
                type="text"
                :required="true"
                :autofocus="true"
            />

            {{-- Password --}}
            <x-form-group
                id="password"
                label="Password"
                type="password"
                :required="true"
                :autocomplete="'current-password'"
            />

            {{-- Remember Me --}}
            <div class="govuk-checkboxes" data-module="govuk-checkboxes">
                <div class="govuk-checkboxes__item">
                    <input class="govuk-checkboxes__input" id="remember_me" name="remember" type="checkbox">
                    <label class="govuk-label govuk-checkboxes__label" for="remember_me">
                        {{ __('Remember me') }}
                    </label>
                </div>
            </div>
            <br>
            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="govuk-link"
                       href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <br><br>
                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
