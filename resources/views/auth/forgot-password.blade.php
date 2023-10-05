<x-guest-layout>
    <x-auth-card>
        <x-slot name="title">
            Reset password
        </x-slot>

        <p class="govuk-body">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </p>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Email --}}
            <x-form-group
                id="email"
                label="Email"
                type="text"
                :required="true"
                :autofocus="true"
            />

            <div>
                <br>
                <x-button>
                    {{ __('Email Password Reset Link') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
